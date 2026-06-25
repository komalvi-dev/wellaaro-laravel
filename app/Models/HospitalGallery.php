<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalGallery extends Model
{
    use HasFactory;

    protected $fillable = ['hospital_id', 'image_url', 'caption', 'position'];

    public function hospital() { return $this->belongsTo(Hospital::class); }
}
