<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'inquiry_id', 'quotation_id', 'patient_profile_id',
        'created_by_user_id', 'amount', 'currency', 'payment_type', 'payment_method',
        'gateway_name', 'gateway_transaction_id', 'gateway_response', 'bank_name',
        'account_name', 'account_number', 'swift_code', 'transfer_reference',
        'status', 'paid_at', 'description', 'receipt_url', 'invoice_number',
    ];

    protected $casts = [
        'paid_at'          => 'datetime',
        'gateway_response' => 'array',
    ];

    public function inquiry()        { return $this->belongsTo(Inquiry::class); }
    public function quotation()      { return $this->belongsTo(Quotation::class); }
    public function patientProfile() { return $this->belongsTo(PatientProfile::class); }
    public function createdBy()      { return $this->belongsTo(User::class, 'created_by_user_id'); }

    protected static function booted(): void
    {
        static::creating(function (Payment $p) {
            if (empty($p->reference_number)) {
                $p->reference_number = 'PAY-' . strtoupper(uniqid());
            }
        });
    }
}
