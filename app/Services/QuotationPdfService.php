<?php

namespace App\Services;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationPdfService
{
    public function generate(Quotation $quotation): \Barryvdh\DomPDF\PDF
    {
        $quotation->load(['inquiry', 'hospital', 'doctor', 'treatment', 'createdBy']);

        return Pdf::loadView('admin.quotations.pdf', compact('quotation'))
            ->setPaper('a4', 'portrait');
    }

    public function download(Quotation $quotation): \Symfony\Component\HttpFoundation\Response
    {
        return $this->generate($quotation)
            ->download("quotation-{$quotation->reference_number}.pdf");
    }

    public function stream(Quotation $quotation): \Symfony\Component\HttpFoundation\Response
    {
        return $this->generate($quotation)
            ->stream("quotation-{$quotation->reference_number}.pdf");
    }
}
