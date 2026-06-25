<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Specialty extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'short_description', 'description', 'icon_class', 'icon_svg',
        'featured_image_url', 'published', 'featured', 'position',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'published' => 'boolean',
        'featured'  => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function treatments()    { return $this->hasMany(Treatment::class); }
    public function doctors()       { return $this->belongsToMany(Doctor::class, 'doctor_specialties'); }
    public function hospitals()     { return $this->belongsToMany(Hospital::class, 'hospital_specialties'); }
    public function faqs()          { return $this->hasMany(Faq::class); }
    public function inquiries()     { return $this->hasMany(Inquiry::class); }
    public function blogPosts()     { return $this->hasMany(BlogPost::class); }
    public function testimonials()  { return $this->hasMany(Testimonial::class); }
    public function packages()      { return $this->hasMany(Package::class); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeFeatured($query)  { return $query->where('featured', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
