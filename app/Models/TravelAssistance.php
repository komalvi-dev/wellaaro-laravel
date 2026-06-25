<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAssistance extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id', 'patient_profile_id', 'assigned_to_user_id',
        'visa_required', 'visa_country', 'visa_status', 'visa_invitation_sent',
        'visa_approved_at', 'visa_notes', 'accommodation_required', 'accommodation_pref',
        'accommodation_name', 'accommodation_address', 'accommodation_checkin',
        'accommodation_checkout', 'accommodation_cost_usd', 'accommodation_booking_ref',
        'accommodation_notes', 'transfer_required', 'arrival_flight', 'arrival_datetime',
        'arrival_airport', 'departure_flight', 'departure_datetime', 'transfer_notes',
        'transfer_cost_usd', 'interpreter_required', 'interpreter_language',
        'interpreter_notes', 'status',
    ];

    protected $casts = [
        'visa_required'           => 'boolean',
        'visa_invitation_sent'    => 'boolean',
        'visa_approved_at'        => 'date',
        'accommodation_required'  => 'boolean',
        'accommodation_checkin'   => 'date',
        'accommodation_checkout'  => 'date',
        'transfer_required'       => 'boolean',
        'arrival_datetime'        => 'datetime',
        'departure_datetime'      => 'datetime',
        'interpreter_required'    => 'boolean',
    ];

    public function inquiry()        { return $this->belongsTo(Inquiry::class); }
    public function patientProfile() { return $this->belongsTo(PatientProfile::class); }
    public function assignedTo()     { return $this->belongsTo(User::class, 'assigned_to_user_id'); }
}
