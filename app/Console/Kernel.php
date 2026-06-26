<?php

namespace App\Console;

use App\Jobs\CheckQuotationExpiry;
use App\Models\Appointment;
use App\Jobs\SendAppointmentReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Expire stale quotations daily at midnight (Asia/Dubai business timezone)
        $schedule->job(new CheckQuotationExpiry)->daily()->timezone(env('APP_TIMEZONE', 'Asia/Dubai'));

        // Check for upcoming appointments and send reminders hourly
        $schedule->call(function () {
            // 24h reminders: appointments tomorrow that haven't been reminded
            Appointment::whereIn('status', ['scheduled', 'confirmed'])
                ->where('reminder_sent_24h', false)
                ->whereDate('appointment_date', now()->addDay()->toDateString())
                ->each(fn ($appt) => SendAppointmentReminder::dispatch($appt, '24h'));

            // 1h reminders: online consultations within the next 1-2 hours
            Appointment::whereIn('status', ['scheduled', 'confirmed'])
                ->where('reminder_sent_1h', false)
                ->where('appointment_type', 'online_consultation')
                ->whereDate('appointment_date', now()->toDateString())
                ->whereBetween('appointment_time', [
                    now()->addHour()->format('H:i:s'),
                    now()->addHours(2)->format('H:i:s'),
                ])
                ->each(fn ($appt) => SendAppointmentReminder::dispatch($appt, '1h'));
        })->hourly()->name('appointment-reminders')->withoutOverlapping();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
