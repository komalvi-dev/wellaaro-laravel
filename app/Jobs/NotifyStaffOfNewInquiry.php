<?php

namespace App\Jobs;

use App\Mail\InquiryNotificationMail;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyStaffOfNewInquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public readonly Inquiry $inquiry) {}

    public function handle(): void
    {
        User::caseManagers()->active()->each(function (User $staff) {
            Mail::to($staff->email)->queue(new InquiryNotificationMail($this->inquiry));
        });
    }
}
