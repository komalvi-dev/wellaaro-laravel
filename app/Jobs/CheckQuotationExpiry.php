<?php

namespace App\Jobs;

use App\Mail\QuotationExpiredMail;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CheckQuotationExpiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $expiredQuotations = Quotation::where('status', 'sent')
            ->whereNotNull('valid_until')
            ->whereDate('valid_until', '<', now()->toDateString())
            ->with('inquiry')
            ->get();

        foreach ($expiredQuotations as $quotation) {
            $quotation->update(['status' => 'expired']);

            if ($quotation->inquiry && $quotation->inquiry->patient_email) {
                Mail::send(new QuotationExpiredMail($quotation));
            }
        }
    }
}
