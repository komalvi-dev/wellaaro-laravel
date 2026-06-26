<?php

namespace App\Mail;

use App\Models\Inquiry;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageNotificationPatientMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Message $message,
        public readonly User $recipient,
        public readonly Inquiry $inquiry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->recipient->email,
            subject: 'New message in your inquiry ' . $this->inquiry->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.message_notification_patient',
            with: [
                'message'    => $this->message,
                'recipient'  => $this->recipient,
                'inquiry'    => $this->inquiry,
                'action_url' => url('/dashboard/inquiries/' . $this->inquiry->id . '/messages'),
            ],
        );
    }
}
