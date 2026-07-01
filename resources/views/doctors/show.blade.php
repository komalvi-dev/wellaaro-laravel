@extends('layouts.app')
@section('title', $doctor->full_name)
@section('content')
<div class="bg-light py-5">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-3"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item"><a href="{{ route('doctors.index') }}">{{ __('Doctors') }}</a></li><li class="breadcrumb-item active">{{ $doctor->full_name }}</li></ol></nav>
        <div class="row align-items-center g-4">
            <div class="col-auto">
                @if($doctor->photo_url)<img src="{{ $doctor->photo_url }}" class="rounded-circle shadow" width="120" height="120" style="object-fit:cover;" alt="{{ $doctor->full_name }}">
                @else<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow" style="width:120px;height:120px;font-size:3rem;">{{ substr($doctor->first_name,0,1) }}</div>@endif
            </div>
            <div class="col">
                <h1 class="h2 fw-bold mb-1">{{ $doctor->full_name }}</h1>
                <p class="text-muted mb-1">{{ $doctor->designation }}</p>
                <p class="text-muted small mb-2">{{ $doctor->qualifications }}</p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($doctor->specialties as $s)<span class="badge bg-primary">{{ $s->name }}</span>@endforeach
                    @if($doctor->experience_years)<span class="badge bg-light text-muted">{{ $doctor->experience_years }} {{ __('yrs experience') }}</span>@endif
                    @if($doctor->online_consultation)<span class="badge bg-success">{{ __('Online Consultation') }}</span>@endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            @if($doctor->about)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('About') }}</div>
                <div class="card-body">{!! nl2br(e($doctor->about)) !!}</div>
            </div>
            @endif
            @if($doctor->training)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Training & Education') }}</div>
                <div class="card-body">{!! nl2br(e($doctor->training)) !!}</div>
            </div>
            @endif
            @if($doctor->achievements)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Achievements') }}</div>
                <div class="card-body">{!! nl2br(e($doctor->achievements)) !!}</div>
            </div>
            @endif
            @if($doctor->hospitals->count())
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Affiliated Hospitals') }}</div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($doctor->hospitals as $h)
                        <div class="col-md-6">
                            <a href="{{ route('hospitals.show', $h->slug) }}" class="text-decoration-none">
                                <div class="border rounded p-2 d-flex gap-2 align-items-center">
                                    @if($h->logo_url)<img src="{{ $h->logo_url }}" height="32" class="rounded">@else<i class="fas fa-hospital text-primary"></i>@endif
                                    <span class="small fw-semibold">{{ $h->name }}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">{{ __('Consultation') }}</h6>
                    @if($doctor->consultation_fee_usd)<p class="mb-2"><span class="text-muted small">{{ __('Fee:') }}</span> <strong>${{ $doctor->consultation_fee_usd }}</strong></p>@endif
                    @if($doctor->response_time_hours)<p class="mb-3"><span class="text-muted small">{{ __('Response time:') }}</span> <strong>{{ $doctor->response_time_hours }}h</strong></p>@endif
                    <a href="{{ route('get_quote') }}?doctor_id={{ $doctor->id }}" class="btn btn-primary w-100 mb-2">{{ __('Book Consultation') }}</a>
                </div>
            </div>
            @if($doctor->languages_spoken && count($doctor->languages_spoken))
            <div class="card border-0 shadow-sm">
                <div class="card-body small">
                    <h6 class="fw-bold mb-2">{{ __('Languages') }}</h6>
                    @foreach($doctor->languages_spoken as $lang)<span class="badge bg-light text-muted me-1">{{ $lang }}</span>@endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
