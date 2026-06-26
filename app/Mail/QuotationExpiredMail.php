<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationExpiredMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Quotation $quotation) {}

    public function envelope(): Envelope
    {
        $patientEmail = $this->quotation->inquiry->patient_email
            ?? $this->quotation->inquiry->patientProfile?->user?->email;

        if (!$patientEmail) {
            throw new \RuntimeException(
                'Cannot send expiry mail: no patient email address found for quotation ' . $this->quotation->reference_number
            );
        }

        return new Envelope(
            to: $patientEmail,
            subject: 'Your Quotation Has Expired — ' . $this->quotation->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quotation_expired',
            with: ['quotation' => $this->quotation],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
