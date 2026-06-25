<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Inquiry extends Model
{
    use HasFactory;

    const STATUSES = [
        'new', 'in_review', 'quote_sent', 'negotiating', 'confirmed',
        'treatment_scheduled', 'completed', 'follow_up', 'closed_won', 'closed_lost',
    ];
    const PRIORITIES  = ['low', 'normal', 'high', 'urgent'];
    const TIMELINES   = ['asap', '1_3_months', '3_6_months', '6_plus'];
    const ACCOM_PREFS = ['budget', 'standard', 'premium', 'luxury'];

    protected $fillable = [
        'reference_number', 'user_id', 'patient_profile_id', 'assigned_to_user_id',
        'specialty_id', 'treatment_id', 'first_name', 'last_name', 'email', 'phone',
        'phone_country_code', 'whatsapp_number', 'country_of_residence', 'nationality',
        'age', 'gender', 'condition_description', 'preferred_destination',
        'preferred_timeline', 'budget_range', 'budget_currency', 'current_medications',
        'previous_treatments', 'additional_notes', 'companions_count', 'accommodation_pref',
        'needs_visa_assistance', 'needs_airport_transfer', 'needs_interpreter',
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
        'referrer_url', 'landing_page', 'ip_address', 'user_agent', 'source_page',
        'status', 'priority', 'whatsapp_opt_in', 'email_opt_in', 'is_spam', 'spam_reason',
    ];

    protected $casts = [
        'needs_visa_assistance'   => 'boolean',
        'needs_airport_transfer'  => 'boolean',
        'needs_interpreter'       => 'boolean',
        'whatsapp_opt_in'         => 'boolean',
        'email_opt_in'            => 'boolean',
        'is_spam'                 => 'boolean',
    ];

    // Relationships
    public function user()           { return $this->belongsTo(User::class); }
    public function patientProfile() { return $this->belongsTo(PatientProfile::class); }
    public function specialty()      { return $this->belongsTo(Specialty::class); }
    public function treatment()      { return $this->belongsTo(Treatment::class); }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function quotations()            { return $this->hasMany(Quotation::class); }
    public function appointments()          { return $this->hasMany(Appointment::class); }
    public function treatmentPlan()         { return $this->hasOne(TreatmentPlan::class); }
    public function travelAssistance()      { return $this->hasOne(TravelAssistance::class); }
    public function medicalRecords()        { return $this->hasMany(MedicalRecord::class); }
    public function payments()              { return $this->hasMany(Payment::class); }
    public function conversation()          { return $this->hasOne(Conversation::class); }
    public function inquiryNotes()          { return $this->hasMany(InquiryNote::class); }
    public function inquiryStatusHistories(){ return $this->hasMany(InquiryStatusHistory::class); }
    public function documents()             { return $this->morphMany(Document::class, 'documentable'); }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['closed_won', 'closed_lost']);
    }

    public function scopeNewLeads($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeAssignedToUser($query, $userId)
    {
        return $query->where('assigned_to_user_id', $userId);
    }

    // Methods
    public function getTreatmentNameAttribute(): string
    {
        return $this->treatment?->name ?? $this->specialty?->name ?? 'General Inquiry';
    }

    public function getPatientNameAttribute(): string
    {
        $name = trim("{$this->first_name} {$this->last_name}");
        return $name ?: ($this->patientProfile?->full_name ?? $this->email ?? 'Unknown');
    }

    public function getPatientEmailAttribute(): ?string
    {
        return $this->email ?? $this->patientProfile?->user?->email;
    }

    public function activeQuotation(): ?Quotation
    {
        return $this->quotations()
            ->whereIn('status', ['sent', 'viewed'])
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function acceptedQuotation(): ?Quotation
    {
        return $this->quotations()->where('status', 'accepted')->first();
    }

    public function isUrgent(): bool { return $this->priority === 'urgent'; }

    public function statusBadgeClass(): string
    {
        return match($this->status) {
            'new'                  => 'badge bg-primary',
            'in_review'            => 'badge bg-info',
            'quote_sent'           => 'badge bg-warning',
            'negotiating'          => 'badge bg-warning text-dark',
            'confirmed'            => 'badge bg-success',
            'treatment_scheduled'  => 'badge bg-success',
            'completed'            => 'badge bg-secondary',
            'follow_up'            => 'badge bg-info',
            'closed_won'           => 'badge bg-success',
            'closed_lost'          => 'badge bg-danger',
            default                => 'badge bg-secondary',
        };
    }

    protected static function booted(): void
    {
        static::creating(function (Inquiry $inquiry) {
            if (empty($inquiry->reference_number)) {
                $year  = now()->year;
                $count = static::whereYear('created_at', $year)->count() + 1;
                $inquiry->reference_number = "WL-{$year}-" . str_pad($count, 6, '0', STR_PAD_LEFT);
            }
        });

        static::created(function (Inquiry $inquiry) {
            $inquiry->conversation()->create();
            $inquiry->travelAssistance()->create([
                'patient_profile_id'     => $inquiry->patient_profile_id,
                'visa_required'          => $inquiry->needs_visa_assistance,
                'accommodation_required' => !empty($inquiry->accommodation_pref),
                'accommodation_pref'     => $inquiry->accommodation_pref,
                'transfer_required'      => $inquiry->needs_airport_transfer,
                'interpreter_required'   => $inquiry->needs_interpreter,
            ]);
        });
    }
}
