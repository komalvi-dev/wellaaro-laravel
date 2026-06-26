@extends('layouts.app')

@section('title', 'Medical Travel Guide to India')

@section('description', 'Everything you need to know about travelling to India for medical treatment — visas, flights, accommodation, and on-ground support.')

@section('content')
<div class="bg-primary py-5 text-white">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2">Medical Travel Guide</h1>
        <p class="lead opacity-90">Your complete guide to travelling to India for treatment — from visa to recovery.</p>
    </div>
</div>

<div class="container py-5">

    <!-- Steps Timeline -->
    <h2 class="fw-bold mb-4 text-center">Your Journey Step by Step</h2>
    <div class="row g-4 mb-5">

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;flex-shrink:0;">1</div>
                        <h6 class="fw-bold mb-0">Submit Your Inquiry</h6>
                    </div>
                    <p class="text-muted small mb-0">Fill in our free inquiry form with your medical details. Our team will review your case and match you with the best hospitals within 24 hours.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;flex-shrink:0;">2</div>
                        <h6 class="fw-bold mb-0">Receive Treatment Plan</h6>
                    </div>
                    <p class="text-muted small mb-0">Get detailed cost estimates, hospital recommendations, and a treatment timeline. Ask questions and compare options before deciding.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;flex-shrink:0;">3</div>
                        <h6 class="fw-bold mb-0">Apply for Medical Visa</h6>
                    </div>
                    <p class="text-muted small mb-0">We provide all the documentation needed for your Indian Medical Visa (e-MED). Processing typically takes 3–5 business days.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;flex-shrink:0;">4</div>
                        <h6 class="fw-bold mb-0">Travel to India</h6>
                    </div>
                    <p class="text-muted small mb-0">Our coordinator arranges airport pickup, hotel, and hospital admission. You're never alone from the moment you land.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;flex-shrink:0;">5</div>
                        <h6 class="fw-bold mb-0">Receive Treatment</h6>
                    </div>
                    <p class="text-muted small mb-0">Get world-class treatment at your chosen hospital. Our case manager visits daily and handles all communication with the medical team.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;flex-shrink:0;">6</div>
                        <h6 class="fw-bold mb-0">Return Home</h6>
                    </div>
                    <p class="text-muted small mb-0">We provide complete discharge summaries and connect you with follow-up care in your home country for seamless continuity.</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mb-5">
        <!-- Visa Info -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-passport me-2 text-primary"></i>Medical Visa (e-MED)</h5>
                    <ul class="list-unstyled small">
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Apply online at indianvisaonline.gov.in</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Valid for 60 days, extendable up to 1 year</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>We provide the official hospital invitation letter</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Companion visa (e-MEDX) available for 1 attendant</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Typically processed in 3–5 business days</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Available to citizens of 160+ countries</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Accommodation -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-building me-2 text-primary"></i>Accommodation Options</h5>
                    <ul class="list-unstyled small">
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Hospital guest houses — closest to treatment centre</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>3-star hotels from $30–50/night</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>4-star hotels from $60–100/night</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>5-star hotels from $120–250/night</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>Serviced apartments for longer stays</span>
                        </li>
                        <li class="d-flex gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span>We negotiate special patient rates</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-primary rounded-4 text-white text-center p-5">
        <h3 class="fw-bold mb-2">We Handle Everything for You</h3>
        <p class="mb-4 opacity-90">From visa documentation to airport pickup — our coordinators are with you every step of the way.</p>
        <a href="{{ route('get_quote') }}" class="btn btn-light btn-lg fw-bold px-5">Start Your Journey</a>
    </div>

</div>
@endsection
