<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_profile_id', 'inquiry_id', 'uploaded_by_user_id', 'title',
        'description', 'record_type', 'file_name', 'file_size', 'content_type',
        'file_url', 'record_date', 'issuing_doctor', 'issuing_hospital',
        'is_pre_treatment', 'is_sensitive', 'access_level',
    ];

    protected $casts = [
        'record_date'     => 'date',
        'is_pre_treatment'=> 'boolean',
        'is_sensitive'    => 'boolean',
    ];

    public function patientProfile() { return $this->belongsTo(PatientProfile::class); }
    public function inquiry()        { return $this->belongsTo(Inquiry::class); }
    public function uploadedBy()     { return $this->belongsTo(User::class, 'uploaded_by_user_id'); }
}
