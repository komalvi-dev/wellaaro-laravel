<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Inquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->inquiry->patient_email,
            subject: 'Your inquiry status has been updated – ' . $this->inquiry->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry_status_updated',
            with: ['inquiry' => $this->inquiry],
        );
    }
}
