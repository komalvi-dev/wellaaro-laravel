<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Treatment extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'specialty_id', 'parent_id', 'name', 'slug', 'short_description', 'description',
        'procedure_details', 'recovery_time', 'hospital_stay', 'success_rate',
        'cost_india_min', 'cost_india_max', 'cost_usa', 'cost_uk', 'cost_savings_percent',
        'featured_image_url', 'published', 'featured', 'position',
        'faq_schema', 'schema_markup', 'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'featured'     => 'boolean',
        'faq_schema'   => 'array',
        'schema_markup'=> 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function specialty()    { return $this->belongsTo(Specialty::class); }
    public function parent()       { return $this->belongsTo(Treatment::class, 'parent_id'); }
    public function children()     { return $this->hasMany(Treatment::class, 'parent_id'); }
    public function doctors()      { return $this->belongsToMany(Doctor::class, 'doctor_treatments'); }
    public function conditions()   { return $this->belongsToMany(Condition::class, 'condition_treatments'); }
    public function packages()     { return $this->belongsToMany(Package::class, 'package_treatments'); }
    public function faqs()         { return $this->hasMany(Faq::class); }
    public function blogPosts()    { return $this->hasMany(BlogPost::class); }
    public function inquiries()    { return $this->hasMany(Inquiry::class); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeFeatured($query)  { return $query->where('featured', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
