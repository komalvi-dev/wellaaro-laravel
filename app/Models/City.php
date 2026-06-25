<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id', 'name', 'slug', 'is_medical_hub', 'description',
        'meta_title', 'meta_description',
    ];

    protected $casts = ['is_medical_hub' => 'boolean'];

    public function country()   { return $this->belongsTo(Country::class); }
    public function hospitals() { return $this->hasMany(Hospital::class); }

    public function scopeMedicalHubs($query) { return $query->where('is_medical_hub', true); }
}
