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
        // Expire stale quotations daily at midnight
        $schedule->job(new CheckQuotationExpiry)->daily();

        // Check for upcoming appointments and send reminders hourly
        $schedule->call(function () {
            // 24h reminders: appointments tomorrow that haven't been reminded
            Appointment::where('status', 'scheduled')
                ->where('reminder_sent_24h', false)
                ->whereDate('appointment_date', now()->addDay()->toDateString())
                ->each(fn ($appt) => SendAppointmentReminder::dispatch($appt, '24h'));

            // 1h reminders: appointments within the next 2 hours
            Appointment::where('status', 'scheduled')
                ->where('reminder_sent_1h', false)
                ->whereDate('appointment_date', now()->toDateString())
                ->each(function (Appointment $appt) {
                    $apptTime = \Carbon\Carbon::parse(
                        $appt->appointment_date->format('Y-m-d') . ' ' . $appt->appointment_time
                    );
                    if ($apptTime->diffInMinutes(now(), false) <= 0 && $apptTime->diffInMinutes(now(), false) >= -120) {
                        SendAppointmentReminder::dispatch($appt, '1h');
                    }
                });
        })->hourly()->name('appointment-reminders')->withoutOverlapping();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
