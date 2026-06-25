<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id', 'sender_user_id', 'body', 'message_type',
        'file_url', 'file_name', 'is_internal', 'read_at',
    ];

    protected $casts = [
        'is_internal' => 'boolean',
        'read_at'     => 'datetime',
    ];

    public function conversation() { return $this->belongsTo(Conversation::class); }
    public function sender()       { return $this->belongsTo(User::class, 'sender_user_id'); }
}
