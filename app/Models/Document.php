<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentable_type', 'documentable_id', 'uploaded_by_user_id', 'title',
        'document_type', 'file_name', 'file_size', 'content_type', 'file_url',
        'is_visible_to_patient',
    ];

    protected $casts = ['is_visible_to_patient' => 'boolean'];

    public function documentable() { return $this->morphTo(); }
    public function uploadedBy()   { return $this->belongsTo(User::class, 'uploaded_by_user_id'); }
}
