<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'value_type', 'group', 'description', 'updated_by_user_id'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, mixed $value, ?int $userId = null): void
    {
        static::updateOrCreate(['key' => $key], [
            'value'              => $value,
            'updated_by_user_id' => $userId,
        ]);
        Cache::forget("site_setting_{$key}");
    }

    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by_user_id'); }
}
