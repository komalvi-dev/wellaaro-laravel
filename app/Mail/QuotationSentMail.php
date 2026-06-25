<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Quotation $quotation) {}

    public function envelope(): Envelope
    {
        $patientEmail = $this->quotation->inquiry->email
            ?? $this->quotation->inquiry->patientProfile?->user?->email;

        return new Envelope(
            to: $patientEmail,
            subject: 'Your Treatment Quotation - ' . $this->quotation->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quotation_sent',
            with: ['quotation' => $this->quotation],
        );
    }
}
