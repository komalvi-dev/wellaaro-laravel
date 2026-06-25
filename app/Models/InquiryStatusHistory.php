<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = ['inquiry_id', 'from_status', 'to_status', 'changed_by_user_id', 'reason'];

    public function inquiry()   { return $this->belongsTo(Inquiry::class); }
    public function changedBy() { return $this->belongsTo(User::class, 'changed_by_user_id'); }

    public function scopeRecent($query) { return $query->orderBy('created_at', 'desc'); }
}
