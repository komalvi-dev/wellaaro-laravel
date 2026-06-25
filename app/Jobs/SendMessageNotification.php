<?php

namespace App\Jobs;

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
        $senderId = $this->message->sender_user_id;

        foreach ($conversation->participants as $user) {
            if ($user->id === $senderId) {
                continue;
            }
            Mail::to($user->email)->send(new \App\Mail\MessageNotificationMail($this->message, $user));
        }
    }
}
