<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Appointment $appointment) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Confirmed - ' . ($this->appointment->reference_number ?: 'Ref #' . $this->appointment->id),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment_confirmation',
            with: [
                'appointment'   => $this->appointment,
                'site_name'     => config('app.name'),
                'support_email' => config('mail.from.address'),
                'dashboard_url' => route('patient.appointments.index'),
            ],
        );
    }
}
