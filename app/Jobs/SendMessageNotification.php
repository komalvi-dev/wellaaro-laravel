<?php

namespace App\Jobs;

use App\Mail\MessageNotificationPatientMail;
use App\Mail\MessageNotificationStaffMail;
use App\Models\CustomNotification;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMessageNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public readonly Message $message) {}

    public function handle(): void
    {
        $conversation = $this->message->conversation;
        $senderId     = $this->message->sender_user_id;
        $inquiry      = $conversation->inquiry;

        foreach ($conversation->participants as $user) {
            if ($user->id === $senderId) {
                continue;
            }
            if (empty($user->email)) {
                continue;
            }

            $mailable = $user->isPatient()
                ? new MessageNotificationPatientMail($this->message, $user, $inquiry)
                : new MessageNotificationStaffMail($this->message, $user, $inquiry);

            Mail::to($user->email)->queue($mailable);

            $actionUrl = $user->isPatient()
                ? "/messages/{$conversation->id}"
                : "/admin/conversations/{$conversation->id}";

            CustomNotification::create([
                'user_id'           => $user->id,
                'title'             => 'New Message',
                'body'              => 'You have a new message from ' . ($this->message->sender->name ?? 'a user') . '.',
                'notification_type' => 'new_message',
                'notifiable_type'   => Message::class,
                'notifiable_id'     => $this->message->id,
                'action_url'        => $actionUrl,
            ]);
        }
    }
}
