<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Quotation $quotation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->quotation->createdBy->email,
            subject: 'Quotation Declined — ' . $this->quotation->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quotation_rejected',
            with: ['quotation' => $this->quotation],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
