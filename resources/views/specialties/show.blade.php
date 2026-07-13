@extends('layouts.app')
@section('title', $specialty->name)
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <nav aria-label="{{ __('breadcrumb') }}"><ol class="breadcrumb small mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item"><a href="{{ route('specialties.index') }}">{{ __('Specialties') }}</a></li><li class="breadcrumb-item active">{{ $specialty->name }}</li></ol></nav>
        <x-breadcrumb-schema :items="[
            ['name' => __('Home'), 'url' => route('home')],
            ['name' => __('Specialties'), 'url' => route('specialties.index')],
            ['name' => $specialty->name],
        ]" />
        <h1 class="h2 fw-bold">{{ $specialty->name }}</h1>
        <p class="text-muted">{{ $specialty->short_description }}</p>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            @if($specialty->description)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">{!! nl2br(e($specialty->description)) !!}</div>
                </div>
            @endif
            @if($specialty->treatments->count())
            <h4 class="fw-bold mb-3">{{ __('Treatments') }}</h4>
            <div class="row g-3 mb-4">
                @foreach($specialty->treatments as $treatment)
                <div class="col-md-6">
                    <a href="{{ route('treatments.show', $treatment->slug) }}" class="text-decoration-none">
                        <div class="card card-hover border-0 shadow-sm h-100 p-3">
                            <h6 class="fw-semibold mb-1">{{ $treatment->name }}</h6>
                            <p class="text-muted small mb-0">{{ $treatment->short_description }}</p>
                            @if($treatment->cost_india_min)
                                <div class="mt-2 text-success small fw-semibold">{{ __('From') }} ${{ number_format($treatment->cost_india_min) }}</div>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
            @if(isset($faqs) && $faqs->count())
            <h4 class="fw-bold mb-3">{{ __('Frequently Asked Questions') }}</h4>
            <div class="accordion mb-4" id="faqAccordion">
                @foreach($faqs as $i => $faq)
                <div class="accordion-item border-0 shadow-sm mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">{{ $faq->question }}</button>
                    </h2>
                    <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">{{ $faq->answer }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-2">{{ __('Get a Free Consultation') }}</h6>
                    <p class="text-muted small">{{ __('Our medical coordinators will help you plan your treatment') }}</p>
                    <a href="{{ route('get_quote') }}" class="btn btn-primary w-100">{{ __('Get Quote') }}</a>
                </div>
            </div>
            @if(isset($hospitals) && $hospitals->count())
            <h6 class="fw-bold mb-3">{{ __('Top Hospitals') }}</h6>
            @foreach($hospitals as $hospital)
            <a href="{{ route('hospitals.show', $hospital->slug) }}" class="text-decoration-none">
                <div class="card card-hover border-0 shadow-sm mb-2">
                    <div class="card-body py-2 px-3">
                        <div class="fw-semibold small">{{ $hospital->name }}</div>
                        <div class="text-muted small">{{ $hospital->city?->name }}</div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
