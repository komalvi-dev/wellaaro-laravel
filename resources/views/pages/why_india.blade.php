@extends('layouts.app')

@section('title', 'Why Choose India for Medical Treatment')
@section('meta_description', 'Discover why India is the top destination for medical tourism — world-class hospitals, expert doctors, and affordable costs.')

@section('content')
<div class="bg-primary text-white py-5">
    <div class="container py-3">
        <h1 class="fw-bold display-5">Why Choose India?</h1>
        <p class="lead opacity-75 mb-0">World-class healthcare at a fraction of the cost</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="text-primary mb-3"><i class="fas fa-dollar-sign fa-3x"></i></div>
                    <h5 class="fw-bold">Up to 80% Cost Savings</h5>
                    <p class="text-muted">Major procedures cost a fraction of what they would in the US, UK, or Australia — without compromising quality.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="text-primary mb-3"><i class="fas fa-award fa-3x"></i></div>
                    <h5 class="fw-bold">JCI Accredited Hospitals</h5>
                    <p class="text-muted">India has the highest number of JCI-accredited hospitals outside the US, meeting international quality standards.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="text-primary mb-3"><i class="fas fa-user-md fa-3x"></i></div>
                    <h5 class="fw-bold">Globally Trained Specialists</h5>
                    <p class="text-muted">Indian doctors are renowned globally, many trained and certified in the US, UK, and Europe.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="text-primary mb-3"><i class="fas fa-language fa-3x"></i></div>
                    <h5 class="fw-bold">English-Speaking Staff</h5>
                    <p class="text-muted">India's extensive English-speaking medical community ensures clear communication throughout your care.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="text-primary mb-3"><i class="fas fa-clock fa-3x"></i></div>
                    <h5 class="fw-bold">No Waiting Lists</h5>
                    <p class="text-muted">Unlike public health systems abroad, patients in India receive prompt care without long waiting periods.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="text-primary mb-3"><i class="fas fa-plane fa-3x"></i></div>
                    <h5 class="fw-bold">Easy Accessibility</h5>
                    <p class="text-muted">India is well-connected globally with direct flights from over 50 countries, with a straightforward medical visa process.</p>
                </div>
            </div>
        </div>

        <div class="bg-light rounded-3 p-5 text-center">
            <h3 class="fw-bold mb-3">Ready to Begin Your Medical Journey?</h3>
            <p class="text-muted mb-4">Our team is here to guide you every step of the way — from finding the right doctor to arranging your stay.</p>
            <a href="{{ route('get_quote') }}" class="btn btn-primary btn-lg px-5">Get a Free Quote</a>
        </div>
    </div>
</section>
@endsection
