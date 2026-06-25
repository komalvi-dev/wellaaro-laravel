<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoRedirect extends Model
{
    use HasFactory;

    protected $fillable = ['from_path', 'to_path', 'redirect_type', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true); }
}
