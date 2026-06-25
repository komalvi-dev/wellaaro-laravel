<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ROLES    = ['patient', 'admin', 'super_admin', 'case_manager', 'hospital_admin', 'doctor'];
    const STATUSES = ['active', 'suspended', 'deleted'];

    protected $fillable = [
        'email', 'password', 'role', 'status',
        'email_verified_at', 'confirmation_token', 'confirmation_sent_at',
        'unconfirmed_email', 'failed_attempts', 'unlock_token', 'locked_at',
    ];

    protected $hidden = ['password', 'remember_token', 'unlock_token', 'confirmation_token'];

    protected $casts = [
        'email_verified_at'    => 'datetime',
        'confirmation_sent_at' => 'datetime',
        'current_sign_in_at'   => 'datetime',
        'last_sign_in_at'      => 'datetime',
        'locked_at'            => 'datetime',
    ];

    public function patientProfile()    { return $this->hasOne(PatientProfile::class); }
    public function staffProfile()      { return $this->hasOne(StaffProfile::class); }
    public function inquiries()         { return $this->hasMany(Inquiry::class); }
    public function assignedInquiries() { return $this->hasMany(Inquiry::class, 'assigned_to_user_id'); }
    public function sentMessages()      { return $this->hasMany(Message::class, 'sender_user_id'); }
    public function auditLogs()         { return $this->hasMany(AuditLog::class); }
    public function customNotifications() { return $this->hasMany(CustomNotification::class); }

    public function scopeCaseManagers($query) { return $query->whereIn('role', ['case_manager', 'admin', 'super_admin']); }
    public function scopeAdmins($query)       { return $query->whereIn('role', ['admin', 'super_admin']); }
    public function scopeActive($query)       { return $query->where('status', 'active'); }
    public function scopePatientRole($query)  { return $query->where('role', 'patient'); }

    public function isPatient(): bool     { return $this->role === 'patient'; }
    public function isAdmin(): bool       { return in_array($this->role, ['admin', 'super_admin']); }
    public function isSuperAdmin(): bool  { return $this->role === 'super_admin'; }
    public function isCaseManager(): bool { return in_array($this->role, ['case_manager', 'admin', 'super_admin']); }
    public function isDoctorUser(): bool  { return $this->role === 'doctor'; }

    public function getFullNameAttribute(): string
    {
        return $this->patientProfile?->full_name
            ?? $this->staffProfile?->full_name
            ?? explode('@', $this->email)[0];
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->patientProfile?->avatar_url ?? $this->staffProfile?->avatar_url;
    }

    public function unreadNotificationsCount(): int
    {
        return $this->customNotifications()->whereNull('read_at')->count();
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            if ($user->isPatient()) {
                $user->patientProfile()->create([
                    'first_name' => explode('@', $user->email)[0],
                    'last_name'  => '-',
                ]);
            } elseif ($user->isAdmin() || $user->isCaseManager()) {
                $user->staffProfile()->create([
                    'first_name' => explode('@', $user->email)[0],
                    'last_name'  => '',
                ]);
            }
        });
    }
}
