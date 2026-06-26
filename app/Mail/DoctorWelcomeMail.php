<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;

class DoctorWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly string $doctorName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->user->email,
            subject: 'Welcome — Your ' . config('app.name') . ' doctor account has been created',
        );
    }

    public function content(): Content
    {
        $resetUrl = URL::temporarySignedRoute(
            'password.reset',
            now()->addHours(48),
            ['token' => Password::createToken($this->user), 'email' => $this->user->email],
        );

        return new Content(
            view: 'emails.doctor_welcome',
            with: [
                'user'         => $this->user,
                'doctorName'   => $this->doctorName,
                'siteName'     => config('app.name'),
                'supportEmail' => config('mail.from.address'),
                'resetUrl'     => $resetUrl,
            ],
        );
    }
}
