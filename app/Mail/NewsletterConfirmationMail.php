<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly NewsletterSubscriber $subscriber) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->subscriber->email,
            subject: 'Confirm your newsletter subscription',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter_confirmation',
            with: ['subscriber' => $this->subscriber],
        );
    }
}
