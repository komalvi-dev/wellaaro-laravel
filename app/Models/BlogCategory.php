<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogCategory extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'position', 'published'];
    protected $casts    = ['published' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function parent()   { return $this->belongsTo(BlogCategory::class, 'parent_id'); }
    public function children() { return $this->hasMany(BlogCategory::class, 'parent_id'); }
    public function posts()    { return $this->hasMany(BlogPost::class); }
}
