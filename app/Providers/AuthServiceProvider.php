<?php

namespace App\Providers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Inquiry;
use App\Models\MedicalRecord;
use App\Models\Quotation;
use App\Policies\DoctorPolicy;
use App\Policies\HospitalPolicy;
use App\Policies\InquiryPolicy;
use App\Policies\MedicalRecordPolicy;
use App\Policies\QuotationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Inquiry::class      => InquiryPolicy::class,
        Quotation::class    => QuotationPolicy::class,
        MedicalRecord::class=> MedicalRecordPolicy::class,
        Hospital::class     => HospitalPolicy::class,
        Doctor::class       => DoctorPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
