<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Package extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'highlights', 'duration_days_min',
        'duration_days_max', 'price_usd_from', 'price_note', 'destination_id',
        'specialty_id', 'hospital_id', 'package_type', 'inclusions', 'exclusions',
        'itinerary', 'featured_image_url', 'published', 'featured', 'position',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'published'  => 'boolean',
        'featured'   => 'boolean',
        'highlights' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'itinerary'  => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function destination() { return $this->belongsTo(Destination::class); }
    public function specialty()   { return $this->belongsTo(Specialty::class); }
    public function hospital()    { return $this->belongsTo(Hospital::class); }
    public function treatments()  { return $this->belongsToMany(Treatment::class, 'package_treatments'); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeFeatured($query)  { return $query->where('featured', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
