<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Condition extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'icd10_code', 'short_description', 'description',
        'symptoms', 'causes', 'diagnosis', 'treatment_overview', 'published',
        'meta_title', 'meta_description',
    ];

    protected $casts = ['published' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function treatments() { return $this->belongsToMany(Treatment::class, 'condition_treatments'); }

    public function scopePublished($query) { return $query->where('published', true); }
}
