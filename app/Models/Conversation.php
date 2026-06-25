<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['inquiry_id', 'subject', 'status'];

    public function inquiry()      { return $this->belongsTo(Inquiry::class); }
    public function messages()     { return $this->hasMany(Message::class)->orderBy('created_at'); }
    public function participants() { return $this->belongsToMany(User::class, 'conversation_participants')->withPivot('last_read_at'); }
}
