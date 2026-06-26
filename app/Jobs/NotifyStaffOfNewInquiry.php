<?php

namespace App\Jobs;

use App\Mail\InquiryNotificationMail;
use App\Models\CustomNotification;
use App\Models\Inquiry;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyStaffOfNewInquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue = 'critical';

    public function __construct(public readonly Inquiry $inquiry) {}

    public function handle(WhatsAppService $whatsapp): void
    {
        // 1) Send WhatsApp confirmation to the patient if they opted in.
        if ($this->inquiry->whatsapp_opt_in && $this->inquiry->whatsapp_number) {
            $whatsapp->sendMessage(
                $this->inquiry->whatsapp_number,
                "Thank you for your inquiry, {$this->inquiry->first_name}! We have received your request (Ref: {$this->inquiry->reference_number}) and a case manager will be in touch shortly."
            );
        }

        // 2) Scope notification to the assigned case manager only.
        $assignedUser = $this->inquiry->assignedTo;

        if (! $assignedUser) {
            return;
        }

        // Send email to the assigned staff member.
        Mail::to($assignedUser->email)->queue(new InquiryNotificationMail($this->inquiry));

        // 3) Create an in-app CustomNotification record for the assigned staff user.
        CustomNotification::create([
            'user_id'           => $assignedUser->id,
            'title'             => 'New Inquiry Assigned',
            'body'              => "A new inquiry (Ref: {$this->inquiry->reference_number}) from {$this->inquiry->first_name} {$this->inquiry->last_name} has been assigned to you.",
            'notification_type' => 'new_inquiry',
            'notifiable_type'   => Inquiry::class,
            'notifiable_id'     => $this->inquiry->id,
            'action_url'        => "/admin/inquiries/{$this->inquiry->id}",
        ]);
    }
}
