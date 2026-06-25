@extends('layouts.app')

@section('title', 'Travel Guide for Medical Tourists')

@section('content')
<div class="bg-primary text-white py-5">
    <div class="container py-3">
        <h1 class="fw-bold display-5">Travel Guide</h1>
        <p class="lead opacity-75 mb-0">Everything you need to know before traveling to India for treatment</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h3 class="fw-bold mb-3"><i class="fas fa-passport text-primary me-2"></i>Visa for Medical Travel</h3>
                    <p>India offers a dedicated <strong>Medical Visa (M-Visa)</strong> specifically for patients traveling for treatment. Here's what you need:</p>
                    <ul class="text-muted">
                        <li class="mb-2">Valid passport with at least 6 months validity</li>
                        <li class="mb-2">Letter from the Indian hospital confirming your treatment</li>
                        <li class="mb-2">Bank statements showing sufficient funds</li>
                        <li class="mb-2">Medical records supporting the need for treatment</li>
                        <li>Two attendants are allowed on MX-Visa (Medical Attendant Visa)</li>
                    </ul>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        We assist our patients with obtaining invitation letters from hospitals to support their visa application.
                    </div>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold mb-3"><i class="fas fa-plane text-primary me-2"></i>Getting to India</h3>
                    <p>India's major international airports are well connected to most global destinations:</p>
                    <ul class="text-muted">
                        <li class="mb-2"><strong>Delhi (IGI Airport)</strong> — Best for hospitals in North India</li>
                        <li class="mb-2"><strong>Mumbai (CSIA)</strong> — Access to Maharashtra's leading hospitals</li>
                        <li class="mb-2"><strong>Chennai (MAA)</strong> — Premier destination for cardiac, orthopedic & transplant surgeries</li>
                        <li><strong>Bengaluru (KIA)</strong> — Growing hub for complex surgeries and cancer treatment</li>
                    </ul>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold mb-3"><i class="fas fa-hotel text-primary me-2"></i>Accommodation</h3>
                    <p>Most major hospitals offer in-house guest houses or partner with nearby hotels for patient families. We can arrange accommodation close to your hospital, ranging from budget guesthouses to 5-star hotels.</p>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold mb-3"><i class="fas fa-rupee-sign text-primary me-2"></i>Currency & Payments</h3>
                    <p>India's currency is the <strong>Indian Rupee (INR)</strong>. Most major hospitals accept international credit cards and some accept USD/EUR directly. We recommend:</p>
                    <ul class="text-muted">
                        <li class="mb-2">Carrying some USD/EUR for conversion on arrival</li>
                        <li class="mb-2">Informing your bank of international travel before departure</li>
                        <li>Using licensed money changers at airports for initial conversion</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="mb-0 fw-semibold">Quick Reference</h6>
                    </div>
                    <div class="card-body">
                        <dl class="mb-0">
                            <dt class="small text-muted">Time Zone</dt>
                            <dd>IST (UTC +5:30)</dd>
                            <dt class="small text-muted">Currency</dt>
                            <dd>Indian Rupee (INR)</dd>
                            <dt class="small text-muted">Language</dt>
                            <dd>English widely spoken in hospitals</dd>
                            <dt class="small text-muted">Emergency</dt>
                            <dd>112 (National Emergency)</dd>
                            <dt class="small text-muted">Climate</dt>
                            <dd>Tropical; best Oct–March</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white border-top p-3">
                        <a href="{{ route('get_quote') }}" class="btn btn-primary w-100">Plan My Trip</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
