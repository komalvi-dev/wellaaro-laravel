@extends('layouts.app')
@section('title', __('Medical Specialties'))
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">{{ __('Medical Specialties') }}</h1>
        <nav aria-label="{{ __('breadcrumb') }}"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item active">{{ __('Specialties') }}</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        @foreach($specialties as $specialty)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('specialties.show', $specialty->slug) }}" class="text-decoration-none">
                <div class="card card-hover h-100 border-0 shadow-sm">
                    @if($specialty->featured_image_url)
                        <img src="{{ $specialty->featured_image_url }}" class="card-img-top bg-light" style="height:140px;object-fit:contain;" alt="{{ $specialty->name }}">
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="card-title fw-bold mb-0">{{ $specialty->name }}</h5>
                        </div>
                        <p class="card-text text-muted small">{{ $specialty->short_description }}</p>
                        <span class="text-primary small fw-semibold">{{ $specialty->treatments_count ?? $specialty->treatments->count() }} {{ __('treatments') }} <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
