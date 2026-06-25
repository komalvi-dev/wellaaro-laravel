<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'action', 'auditable_type', 'auditable_id',
        'changes', 'ip_address', 'user_agent',
    ];

    protected $casts = ['changes' => 'array'];

    public function user()      { return $this->belongsTo(User::class); }
    public function auditable() { return $this->morphTo(); }

    public static function record(string $action, ?Model $model = null, ?array $changes = null): self
    {
        return static::create([
            'user_id'        => auth()->id(),
            'action'         => $action,
            'auditable_type' => $model ? get_class($model) : null,
            'auditable_id'   => $model?->getKey(),
            'changes'        => $changes,
            'ip_address'     => request()->ip(),
            'user_agent'     => request()->userAgent(),
        ]);
    }

    public function scopeRecent($query) { return $query->orderBy('created_at', 'desc'); }
}
