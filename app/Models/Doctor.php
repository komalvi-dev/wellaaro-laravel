<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Doctor extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'user_id', 'hospital_id', 'first_name', 'last_name', 'slug', 'title',
        'designation', 'qualifications', 'experience_years', 'about', 'training',
        'achievements', 'languages_spoken', 'consultation_fee_usd',
        'online_consultation', 'in_person_consultation', 'response_time_hours',
        'photo_url', 'published', 'featured', 'position',
        'meta_title', 'meta_description', 'schema_markup',
    ];

    protected $casts = [
        'online_consultation'   => 'boolean',
        'in_person_consultation'=> 'boolean',
        'published'             => 'boolean',
        'featured'              => 'boolean',
        'languages_spoken'      => 'array',
        'schema_markup'         => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }

    public function user()        { return $this->belongsTo(User::class); }
    public function hospital()    { return $this->belongsTo(Hospital::class); }
    public function specialties() { return $this->belongsToMany(Specialty::class, 'doctor_specialties')->withPivot('is_primary'); }
    public function treatments()  { return $this->belongsToMany(Treatment::class, 'doctor_treatments'); }
    public function hospitals()   { return $this->belongsToMany(Hospital::class, 'doctor_hospitals')->withPivot('is_primary', 'visiting_days'); }
    public function appointments() { return $this->hasMany(Appointment::class); }
    public function testimonials() { return $this->hasMany(Testimonial::class); }

    public function getFullNameAttribute(): string
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeFeatured($query)  { return $query->where('featured', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
