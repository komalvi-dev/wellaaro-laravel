<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'inquiry_id', 'patient_profile_id', 'hospital_id',
        'doctor_id', 'created_by_user_id', 'title', 'description', 'start_date',
        'end_date', 'total_duration_days', 'arrival_date', 'departure_date',
        'arrival_flight', 'departure_flight', 'accommodation_name', 'accommodation_address',
        'accommodation_checkin', 'accommodation_checkout', 'itinerary',
        'pre_op_instructions', 'post_op_instructions', 'diet_restrictions',
        'medication_plan', 'status', 'shared_at',
    ];

    protected $casts = [
        'start_date'           => 'date',
        'end_date'             => 'date',
        'arrival_date'         => 'date',
        'departure_date'       => 'date',
        'accommodation_checkin'=> 'date',
        'accommodation_checkout'=> 'date',
        'itinerary'            => 'array',
        'shared_at'            => 'datetime',
    ];

    public function inquiry()        { return $this->belongsTo(Inquiry::class); }
    public function patientProfile() { return $this->belongsTo(PatientProfile::class); }
    public function hospital()       { return $this->belongsTo(Hospital::class); }
    public function doctor()         { return $this->belongsTo(Doctor::class); }
    public function createdBy()      { return $this->belongsTo(User::class, 'created_by_user_id'); }
}
