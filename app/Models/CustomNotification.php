<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotification extends Model
{
    use HasFactory;

    protected $table = 'notifications_custom';

    protected $fillable = [
        'user_id', 'title', 'body', 'notification_type', 'notifiable_type',
        'notifiable_id', 'read_at', 'action_url',
    ];

    protected $casts = ['read_at' => 'datetime'];

    public function user()       { return $this->belongsTo(User::class); }
    public function notifiable() { return $this->morphTo(); }

    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }

    public function scopeUnread($query) { return $query->whereNull('read_at'); }
}
