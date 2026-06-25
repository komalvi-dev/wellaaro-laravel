<?php

namespace App\Jobs;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckQuotationExpiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Quotation::whereIn('status', ['sent', 'viewed'])
            ->whereNotNull('valid_until')
            ->whereDate('valid_until', '<', now()->toDateString())
            ->update(['status' => 'expired']);
    }
}
