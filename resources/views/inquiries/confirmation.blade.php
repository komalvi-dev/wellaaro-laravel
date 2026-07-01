@extends('layouts.app')
@section('title', 'Inquiry Submitted')
@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="mb-4">
                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;font-size:2.25rem;">
                    ✅
                </div>
                <h1 class="h3 fw-bold text-success">{{ __('Inquiry Submitted Successfully!') }}</h1>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    @if(session('reference_number'))
                    <p class="text-muted mb-2">{{ __('Your reference number') }}</p>
                    <div class="h4 fw-bold text-primary font-monospace bg-light rounded p-2 mb-3">{{ session('reference_number') }}</div>
                    @endif
                    <p class="mb-3">{{ __('Thank you for your inquiry. Our medical coordinators will review your case and contact you within') }} <strong>{{ __('24 hours') }}</strong>.</p>
                    <div class="text-start bg-light rounded p-3 mb-3 small">
                        <h6 class="fw-semibold mb-2">{{ __('What happens next?') }}</h6>
                        <ul class="mb-0 ps-3">
                            <li class="mb-1">{{ __('Our team reviews your medical information') }}</li>
                            <li class="mb-1">{{ __('We identify the best hospitals and doctors for your condition') }}</li>
                            <li class="mb-1">{{ __('You receive a detailed cost estimate and treatment plan') }}</li>
                            <li>{{ __('We assist with visa, travel, and accommodation arrangements') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-outline-primary">{{ __('Back to Home') }}</a>
                @auth
                <a href="{{ route('patient.dashboard') }}" class="btn btn-primary">{{ __('View My Dashboard') }}</a>
                @else
                <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Create Account to Track') }}</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
