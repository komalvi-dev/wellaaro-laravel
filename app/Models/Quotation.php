<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'inquiry_id', 'hospital_id', 'doctor_id', 'treatment_id',
        'created_by_user_id', 'currency', 'treatment_cost', 'hospital_stay_cost',
        'consultation_cost', 'diagnostic_cost', 'medicine_cost', 'travel_cost',
        'accommodation_cost', 'visa_cost', 'other_cost', 'discount_amount', 'total_cost',
        'deposit_amount', 'deposit_percentage', 'inclusions', 'exclusions',
        'validity_days', 'valid_until', 'notes', 'terms', 'hospital_details',
        'doctor_details', 'treatment_duration', 'hospital_stay_days', 'status',
        'sent_at', 'viewed_at', 'responded_at', 'patient_response', 'patient_response_note',
        'version', 'parent_quotation_id', 'line_items',
    ];

    protected $casts = [
        'valid_until'  => 'date',
        'sent_at'      => 'datetime',
        'viewed_at'    => 'datetime',
        'responded_at' => 'datetime',
        'line_items'   => 'array',
    ];

    public function inquiry()          { return $this->belongsTo(Inquiry::class); }
    public function hospital()         { return $this->belongsTo(Hospital::class); }
    public function doctor()           { return $this->belongsTo(Doctor::class); }
    public function treatment()        { return $this->belongsTo(Treatment::class); }
    public function createdBy()        { return $this->belongsTo(User::class, 'created_by_user_id'); }
    public function parentQuotation()  { return $this->belongsTo(Quotation::class, 'parent_quotation_id'); }
    public function childQuotations()  { return $this->hasMany(Quotation::class, 'parent_quotation_id'); }
    public function payments()         { return $this->hasMany(Payment::class); }

    protected static function booted(): void
    {
        static::creating(function (Quotation $q) {
            if (empty($q->reference_number)) {
                $year  = now()->year;
                $count = static::whereYear('created_at', $year)->count() + 1;
                $q->reference_number = "QT-{$year}-" . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function isExpired(): bool
    {
        return $this->valid_until && $this->valid_until->isPast();
    }
}
