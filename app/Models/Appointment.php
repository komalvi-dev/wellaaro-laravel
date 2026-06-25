<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'inquiry_id', 'patient_profile_id', 'doctor_id', 'hospital_id',
        'treatment_id', 'created_by_user_id', 'appointment_type', 'appointment_date',
        'appointment_time', 'timezone', 'duration_minutes', 'meeting_link', 'meeting_notes',
        'status', 'reminder_sent_24h', 'reminder_sent_1h', 'cancellation_reason',
        'cancelled_by_user_id', 'cancelled_at', 'notes', 'post_consultation_notes',
    ];

    protected $casts = [
        'appointment_date'  => 'date',
        'reminder_sent_24h' => 'boolean',
        'reminder_sent_1h'  => 'boolean',
        'cancelled_at'      => 'datetime',
    ];

    public function inquiry()        { return $this->belongsTo(Inquiry::class); }
    public function patientProfile() { return $this->belongsTo(PatientProfile::class); }
    public function doctor()         { return $this->belongsTo(Doctor::class); }
    public function hospital()       { return $this->belongsTo(Hospital::class); }
    public function treatment()      { return $this->belongsTo(Treatment::class); }
    public function createdBy()      { return $this->belongsTo(User::class, 'created_by_user_id'); }
    public function cancelledBy()    { return $this->belongsTo(User::class, 'cancelled_by_user_id'); }

    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', now()->toDateString())
                     ->where('status', 'scheduled');
    }

    protected static function booted(): void
    {
        static::creating(function (Appointment $a) {
            if (empty($a->reference_number)) {
                $a->reference_number = 'APT-' . strtoupper(substr(uniqid(), -8));
            }
        });
    }
}
