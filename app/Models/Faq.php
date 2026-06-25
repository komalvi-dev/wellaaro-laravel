<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'answer', 'category', 'specialty_id', 'treatment_id',
        'position', 'published',
    ];

    protected $casts = ['published' => 'boolean'];

    public function specialty()  { return $this->belongsTo(Specialty::class); }
    public function treatment()  { return $this->belongsTo(Treatment::class); }

    public function scopePublished($query) { return $query->where('published', true); }
    public function scopeOrdered($query)   { return $query->orderBy('position'); }
}
