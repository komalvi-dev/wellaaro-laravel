<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CmsPage extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title', 'slug', 'template', 'body', 'sections', 'published',
        'show_in_sitemap', 'meta_title', 'meta_description', 'meta_keywords',
        'canonical_url', 'og_image_url',
    ];

    protected $casts = [
        'published'      => 'boolean',
        'show_in_sitemap'=> 'boolean',
        'sections'       => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function scopePublished($query) { return $query->where('published', true); }
}
