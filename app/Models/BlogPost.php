<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'author_user_id', 'author_name',
        'medically_reviewed_by', 'medically_reviewed_by_photo_url',
        'blog_category_id', 'featured_image_url', 'featured_image_alt',
        'read_time_minutes', 'views_count', 'published', 'published_at',
        'specialty_id', 'treatment_id', 'hospital_id', 'destination_id',
        'schema_type', 'meta_title', 'meta_description', 'meta_keywords',
        'canonical_url', 'og_image_url',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function author()      { return $this->belongsTo(User::class, 'author_user_id'); }
    public function category()    { return $this->belongsTo(BlogCategory::class, 'blog_category_id'); }
    public function tags()        { return $this->belongsToMany(BlogTag::class, 'blog_post_tags'); }
    public function specialty()   { return $this->belongsTo(Specialty::class); }
    public function treatment()   { return $this->belongsTo(Treatment::class); }
    public function hospital()    { return $this->belongsTo(Hospital::class); }
    public function destination() { return $this->belongsTo(Destination::class); }

    public function scopePublished($query) { return $query->where('published', true); }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
