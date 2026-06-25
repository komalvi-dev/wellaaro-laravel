<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryNote extends Model
{
    use HasFactory;

    protected $fillable = ['inquiry_id', 'user_id', 'content', 'note_type', 'is_internal'];
    protected $casts    = ['is_internal' => 'boolean'];

    public function inquiry() { return $this->belongsTo(Inquiry::class); }
    public function user()    { return $this->belongsTo(User::class); }
}
