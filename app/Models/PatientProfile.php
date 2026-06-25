<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'date_of_birth', 'gender',
        'phone', 'phone_country_code', 'whatsapp_number', 'nationality',
        'country_of_residence', 'city', 'address', 'passport_number', 'passport_expiry',
        'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relation',
        'preferred_language', 'avatar_url', 'notes',
    ];

    protected $casts = [
        'date_of_birth'   => 'date',
        'passport_expiry' => 'date',
    ];

    public function user()           { return $this->belongsTo(User::class); }
    public function inquiries()      { return $this->hasMany(Inquiry::class); }
    public function medicalRecords() { return $this->hasMany(MedicalRecord::class); }
    public function appointments()   { return $this->hasMany(Appointment::class); }
    public function payments()       { return $this->hasMany(Payment::class); }
    public function quotations()     { return $this->hasMany(Quotation::class); }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
