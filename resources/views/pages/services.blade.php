@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<div class="bg-primary text-white py-5">
    <div class="container py-3">
        <h1 class="fw-bold display-5">Our Services</h1>
        <p class="lead opacity-75 mb-0">End-to-end support for your medical journey</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <p class="lead text-muted">We provide comprehensive support at every step of your medical journey — from your first inquiry to your safe return home.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-primary mb-3"><i class="fas fa-stethoscope fa-2x"></i></div>
                        <h5 class="fw-bold">Medical Consultation</h5>
                        <p class="text-muted mb-0">Free initial consultation with our medical advisors who help you understand your options and connect with the right specialist.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-primary mb-3"><i class="fas fa-hospital-alt fa-2x"></i></div>
                        <h5 class="fw-bold">Hospital Selection</h5>
                        <p class="text-muted mb-0">We match you with accredited hospitals based on your condition, budget, and preferences — with full transparency on cost and outcomes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-primary mb-3"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                        <h5 class="fw-bold">Cost Estimation</h5>
                        <p class="text-muted mb-0">Detailed cost estimates covering treatment, accommodation, travel, and ancillary services — no hidden charges.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-primary mb-3"><i class="fas fa-passport fa-2x"></i></div>
                        <h5 class="fw-bold">Visa Assistance</h5>
                        <p class="text-muted mb-0">We provide hospital invitation letters and guidance to obtain your Medical Visa quickly and easily.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-primary mb-3"><i class="fas fa-suitcase fa-2x"></i></div>
                        <h5 class="fw-bold">Travel Arrangements</h5>
                        <p class="text-muted mb-0">Airport transfers, accommodation near the hospital, and in-city travel — all coordinated by our dedicated travel team.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="text-primary mb-3"><i class="fas fa-comments fa-2x"></i></div>
                        <h5 class="fw-bold">24/7 Support</h5>
                        <p class="text-muted mb-0">Our dedicated case managers are available round the clock to assist you throughout your stay in India.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-primary text-white rounded-3 p-5 text-center">
            <h3 class="fw-bold mb-3">Ready to Get Started?</h3>
            <p class="opacity-75 mb-4">Submit a free inquiry today and our team will reach out within 24 hours.</p>
            <a href="{{ route('get_quote') }}" class="btn btn-light btn-lg px-5">Get a Free Quote</a>
        </div>
    </div>
</section>
@endsection
