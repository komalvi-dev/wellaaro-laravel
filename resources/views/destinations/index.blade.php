@extends('layouts.app')
@section('title', 'Medical Tourism Destinations')
@section('description', 'Explore world-class medical destinations with JCI-accredited hospitals and affordable healthcare.')
@section('content')

<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50 small mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active text-white">{{ __('Destinations') }}</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">{{ __('Medical Tourism Destinations') }}</h1>
                <p class="lead mb-0">{{ __('World-class healthcare in affordable destinations trusted by patients from 60+ countries.') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if($destinations->isNotEmpty())
            <div class="row g-4">
                @foreach($destinations as $destination)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                                     style="width:48px;height:48px;flex-shrink:0;">
                                    <i class="bi bi-geo-alt-fill text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0">{{ $destination->name }}</h5>
                                    <p class="mb-0 text-muted small">{{ $destination->country->name ?? '' }}</p>
                                </div>
                            </div>
                            @if($destination->description)
                                <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($destination->description, 120) }}</p>
                            @endif
                            <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-sm btn-outline-primary">
                                {{ __('Explore') }} <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-geo display-4 text-muted d-block mb-3"></i>
                <h5 class="text-muted">{{ __('No destinations listed yet') }}</h5>
            </div>
        @endif
    </div>
</section>

<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">{{ __('Ready to Explore Your Options?') }}</h2>
        <p class="text-muted mb-4">{{ __("Tell us about your medical needs and we'll match you with the best hospitals.") }}</p>
        <a href="{{ route('get_quote') }}" class="btn btn-primary btn-lg px-5">{{ __('Get Free Consultation') }}</a>
    </div>
</section>

@endsection
