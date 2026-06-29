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
            \Log::warning('InquiryConfirmationMail skipped — no email on inquiry', [
                'inquiry_id' => $this->inquiry->id,
            ]);
            // Return envelope to admin so it isn't silently dropped
            $patientEmail = config('mail.admin_address', config('mail.from.address'));
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
