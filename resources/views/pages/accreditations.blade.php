@extends('layouts.app')

@section('title', 'Hospital Accreditations & Quality Standards')

@section('description', 'All Wellaaro partner hospitals hold internationally recognised accreditations — JCI, NABH, ISO — ensuring the highest patient safety standards.')

@section('content')
<div class="bg-primary py-5 text-white">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2">{{ __('Accreditations & Quality Standards') }}</h1>
        <p class="lead opacity-90">{{ __("Every Wellaaro partner hospital is vetted against the world's most rigorous quality benchmarks.") }}</p>
    </div>
</div>

<div class="container py-5">

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-award-fill fs-2 text-warning"></i>
                        <div>
                            <h5 class="fw-bold mb-0">{{ __('JCI Accreditation') }}</h5>
                            <small class="text-muted">{{ __('Joint Commission International') }}</small>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ __('The gold standard in global healthcare quality. JCI accreditation means a hospital has met over 1,200 measurable patient-care and safety standards. India has more JCI hospitals than any other Asian country.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-shield-check fs-2 text-primary"></i>
                        <div>
                            <h5 class="fw-bold mb-0">{{ __('NABH Accreditation') }}</h5>
                            <small class="text-muted">{{ __('National Accreditation Board for Hospitals') }}</small>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ __("India's national healthcare accreditation body, equivalent to JCI standards. NABH-accredited hospitals undergo rigorous bi-annual audits covering clinical outcomes, patient rights, and infection control.") }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-patch-check-fill fs-2 text-success"></i>
                        <div>
                            <h5 class="fw-bold mb-0">{{ __('ISO Certification') }}</h5>
                            <small class="text-muted">{{ __('ISO 9001:2015') }}</small>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ __('ISO-certified hospitals demonstrate consistent quality management systems. This ensures standardised processes across all departments, from admissions to post-operative care.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-clipboard2-pulse-fill fs-2 text-info"></i>
                        <div>
                            <h5 class="fw-bold mb-0">{{ __('NABL Laboratories') }}</h5>
                            <small class="text-muted">{{ __('National Accreditation Board for Testing') }}</small>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ __('NABL-accredited diagnostic labs in partner hospitals guarantee accurate, reliable test results aligned with international laboratory standards.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        @foreach ($hospitals as $h)
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="fw-semibold mb-2">{{ $h->name }}</div>
                <div class="d-flex justify-content-center gap-2">
                    @if ($h->is_jci_accredited)
                        <span class="badge bg-warning text-dark">{{ __('JCI') }}</span>
                    @endif
                    @if ($h->is_nabh_accredited)
                        <span class="badge bg-primary">{{ __('NABH') }}</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-light rounded-4 p-5 text-center">
        <h4 class="display-5 fw-bold mb-2">{{ __('Our Hospital Selection Approach') }}</h4>
        <p class="text-muted mb-4">{{ __('We help patients compare accredited hospitals across India based on their medical needs, budget, and preferences. Our goal is to provide clear information and independent guidance so patients can make informed healthcare decisions.') }}</p>
    </div>

</div>
@endsection
