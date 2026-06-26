<?php

namespace App\Mail;

use App\Models\Quotation;
use App\Models\SiteSetting;
use App\Services\QuotationPdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
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

        if (!$patientEmail) {
            throw new \RuntimeException(
                'Cannot send quotation mail: no patient email address found for quotation ' . $this->quotation->reference_number
            );
        }

        return new Envelope(
            to: $patientEmail,
            subject: 'Your Treatment Quotation — ' . $this->quotation->reference_number,
        );
    }

    public function content(): Content
    {
        $siteName = SiteSetting::get('site_name', config('app.name'));
        $quotationUrl = route('patient.quotations.show', $this->quotation);

        return new Content(
            view: 'emails.quotation_sent',
            with: [
                'quotation'    => $this->quotation,
                'siteName'     => $siteName,
                'quotationUrl' => $quotationUrl,
            ],
        );
    }

    public function attachments(): array
    {
        $pdfData = (new QuotationPdfService)->generate($this->quotation);

        return [
            Attachment::fromData(fn () => $pdfData, 'quotation-' . $this->quotation->reference_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
