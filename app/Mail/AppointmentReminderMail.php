<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Appointment $appointment,
        public readonly string $type = '24h'
    ) {}

    public function envelope(): Envelope
    {
        $hours = $this->type === '24h' ? '24 hours' : '1 hour';
        return new Envelope(
            subject: "Reminder: Your appointment is in {$hours}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment_reminder',
            with: [
                'appointment' => $this->appointment,
                'type'        => $this->type,
            ],
        );
    }
}
