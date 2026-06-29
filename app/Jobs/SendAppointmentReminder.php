<?php

namespace App\Jobs;

use App\Mail\AppointmentReminderMail;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly Appointment $appointment,
        public readonly string $type = '24h'
    ) {}

    public function handle(): void
    {
        // Prefer the inquiry's submitted email (matches the carer/agent who booked on the
        // patient's behalf), falling back to the linked patient profile user email.
        $recipientEmail = $this->appointment->inquiry?->email
            ?? $this->appointment->patientProfile?->user?->email;

        if (!$recipientEmail) {
            return;
        }

        Mail::to($recipientEmail)->send(new AppointmentReminderMail($this->appointment, $this->type));

        if ($this->type === '24h') {
            $this->appointment->update(['reminder_sent_24h' => true]);
        } else {
            $this->appointment->update(['reminder_sent_1h' => true]);
        }
    }
}
