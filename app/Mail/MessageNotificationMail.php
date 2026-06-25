<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Message $message,
        public readonly User $recipient
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->recipient->email,
            subject: 'New message in your inquiry conversation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.message_notification',
            with: [
                'message'   => $this->message,
                'recipient' => $this->recipient,
            ],
        );
    }
}
