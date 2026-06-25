<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Destination extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'country_id', 'name', 'slug', 'tagline', 'description', 'why_choose',
        'cost_savings_text', 'visa_info', 'best_time_to_visit', 'climate',
        'featured_image_url', 'published', 'position',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = ['published' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function country()   { return $this->belongsTo(Country::class); }
    public function packages()  { return $this->hasMany(Package::class); }
    public function blogPosts() { return $this->hasMany(BlogPost::class); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
