<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Hospital extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'about', 'established_year',
        'bed_count', 'ot_count', 'annual_patients', 'country_id', 'city_id', 'address',
        'latitude', 'longitude', 'phone', 'email', 'website', 'logo_url',
        'featured_image_url', 'tier', 'is_partner', 'is_jci_accredited', 'is_nabh_accredited',
        'accreditations', 'awards', 'international_patient_desk', 'languages_spoken',
        'published', 'featured', 'position', 'meta_title', 'meta_description',
        'meta_keywords', 'schema_markup',
    ];

    protected $casts = [
        'is_partner'               => 'boolean',
        'is_jci_accredited'        => 'boolean',
        'is_nabh_accredited'       => 'boolean',
        'international_patient_desk'=> 'boolean',
        'published'                => 'boolean',
        'featured'                 => 'boolean',
        'accreditations'           => 'array',
        'awards'                   => 'array',
        'languages_spoken'         => 'array',
        'schema_markup'            => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function country()      { return $this->belongsTo(Country::class); }
    public function city()         { return $this->belongsTo(City::class); }
    public function specialties()  { return $this->belongsToMany(Specialty::class, 'hospital_specialties')->withPivot('is_center_of_excellence', 'description'); }
    public function doctors()      { return $this->belongsToMany(Doctor::class, 'doctor_hospitals')->withPivot('is_primary', 'visiting_days'); }
    public function facilities()   { return $this->hasMany(HospitalFacility::class); }
    public function gallery()      { return $this->hasMany(HospitalGallery::class)->orderBy('position'); }
    public function packages()     { return $this->hasMany(Package::class); }
    public function inquiries()    { return $this->hasMany(Inquiry::class); }
    public function testimonials() { return $this->hasMany(Testimonial::class); }
    public function blogPosts()    { return $this->hasMany(BlogPost::class); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeFeatured($query)  { return $query->where('featured', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
