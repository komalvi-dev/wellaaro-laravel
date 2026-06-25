<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'first_name', 'country', 'source', 'interests', 'is_confirmed',
        'confirmation_token', 'subscribed_at', 'unsubscribed_at', 'unsubscribe_reason',
    ];

    protected $casts = [
        'is_confirmed'     => 'boolean',
        'interests'        => 'array',
        'subscribed_at'    => 'datetime',
        'unsubscribed_at'  => 'datetime',
    ];

    public function scopeConfirmed($query) { return $query->where('is_confirmed', true); }
    public function scopeActive($query)    { return $query->whereNull('unsubscribed_at'); }
}
