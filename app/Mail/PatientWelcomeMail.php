<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatientWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->user->email,
            subject: 'Welcome to MedTourism - Your account is ready',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.patient_welcome',
            with: ['user' => $this->user],
        );
    }
}
