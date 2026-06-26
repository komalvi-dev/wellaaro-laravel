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
        $subject = match ($this->type) {
            '24h'  => 'Reminder: Your appointment is tomorrow',
            '72h'  => 'Reminder: Your appointment is in 3 days',
            default => 'Reminder: Your appointment is tomorrow',
        };
        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment_reminder',
            with: [
                'appointment'   => $this->appointment,
                'type'          => $this->type,
                'site_name'     => config('app.name'),
                'support_email' => config('mail.from.address'),
                'dashboard_url' => route('patient.appointments.index'),
            ],
        );
    }
}
