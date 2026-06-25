@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<div class="bg-light py-5">
    <div class="container">
        <h1 class="h2 fw-bold mb-3">About Us</h1>
        <p class="lead text-muted">Connecting international patients with world-class healthcare in India since 2015.</p>
    </div>
</div>
<div class="container py-5">
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-3">Our Mission</h2>
            <p class="text-muted">We bridge the gap between patients seeking affordable, high-quality medical care and India's world-renowned hospitals and doctors. Our dedicated team of medical coordinators guides you through every step of your healthcare journey.</p>
            <p class="text-muted">From the moment you reach out to us until your complete recovery and follow-up care, we are with you every step of the way.</p>
        </div>
        <div class="col-lg-6">
            <div class="row g-3">
                <div class="col-6"><div class="bg-primary text-white rounded p-4 text-center"><div class="h3 fw-bold">5000+</div><div class="small">Patients Served</div></div></div>
                <div class="col-6"><div class="bg-success text-white rounded p-4 text-center"><div class="h3 fw-bold">50+</div><div class="small">Partner Hospitals</div></div></div>
                <div class="col-6"><div class="bg-info text-white rounded p-4 text-center"><div class="h3 fw-bold">40+</div><div class="small">Countries</div></div></div>
                <div class="col-6"><div class="bg-warning text-dark rounded p-4 text-center"><div class="h3 fw-bold">10+</div><div class="small">Years Experience</div></div></div>
            </div>
        </div>
    </div>
    <h2 class="fw-bold mb-4 text-center">Why Choose Us?</h2>
    <div class="row g-4">
        @foreach([['fas fa-shield-alt', 'Accredited Hospitals', 'All partner hospitals are JCI or NABH accredited with international standards.'],['fas fa-dollar-sign','Cost Savings','Save 60-80% on medical costs compared to Western countries without compromising quality.'],['fas fa-headset','24/7 Support','Round-the-clock assistance from our dedicated medical coordinators.'],['fas fa-plane','Full Travel Support','We handle visa, accommodation, airport transfers, and translation services.']] as [$icon, $title, $desc])
        <div class="col-md-3 text-center">
            <div class="rounded-circle bg-primary-subtle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                <i class="{{ $icon }} text-primary fa-lg"></i>
            </div>
            <h6 class="fw-bold">{{ $title }}</h6>
            <p class="text-muted small">{{ $desc }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
