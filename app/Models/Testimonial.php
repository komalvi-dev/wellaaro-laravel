<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name', 'country', 'treatment', 'hospital_id', 'doctor_id', 'specialty_id',
        'rating', 'short_quote', 'full_story', 'photo_url', 'video_url',
        'video_thumbnail_url', 'video_duration', 'is_featured', 'is_video',
        'position', 'published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_video'    => 'boolean',
        'published'   => 'boolean',
    ];

    public function hospital()  { return $this->belongsTo(Hospital::class); }
    public function doctor()    { return $this->belongsTo(Doctor::class); }
    public function specialty() { return $this->belongsTo(Specialty::class); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeFeatured($query)  { return $query->where('is_featured', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
