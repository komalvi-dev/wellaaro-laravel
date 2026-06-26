<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'iso_code', 'iso3_code', 'phone_code', 'currency_code',
        'flag_emoji', 'is_destination', 'is_source', 'position',
    ];

    protected $casts = [
        'is_destination' => 'boolean',
        'is_source'      => 'boolean',
    ];

    public function cities()       { return $this->hasMany(City::class); }
    public function hospitals()    { return $this->hasMany(Hospital::class); }
    public function destinationPlaces() { return $this->hasMany(Destination::class); }

    public function scopeDestinations($query) { return $query->where('is_destination', true); }
    public function scopeSources($query)      { return $query->where('is_source', true); }
    public function scopeOrdered($query)      { return $query->orderBy('position')->orderBy('name'); }
}
