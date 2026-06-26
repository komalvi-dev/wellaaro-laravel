<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Inquiry $inquiry) {}

    public function envelope(): Envelope
    {
        $patientEmail = $this->inquiry->patient_email;

        if (empty($patientEmail)) {
            return new Envelope(
                subject: 'We received your inquiry – ' . $this->inquiry->reference_number,
            );
        }

        return new Envelope(
            to: $patientEmail,
            subject: 'We received your inquiry – ' . $this->inquiry->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry_confirmation',
            with: ['inquiry' => $this->inquiry],
        );
    }
}
