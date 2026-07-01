@extends('layouts.app')
@section('title', $destination->name)
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">{{ __('Destinations') }}</a></li><li class="breadcrumb-item active">{{ $destination->name }}</li></ol></nav>
        <h1 class="h2 fw-bold">{{ $destination->name }}</h1>
        <p class="text-muted">{{ $destination->country->name }}</p>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            @if($destination->description)<div class="card border-0 shadow-sm mb-4"><div class="card-body">{!! nl2br(e($destination->description)) !!}</div></div>@endif
            @if($destination->why_choose)<div class="card border-0 shadow-sm mb-4"><div class="card-header bg-white fw-semibold">{{ __('Why Choose') }} {{ $destination->name }}?</div><div class="card-body">{!! nl2br(e($destination->why_choose)) !!}</div></div>@endif
            @if($destination->visa_info)<div class="card border-0 shadow-sm mb-4"><div class="card-header bg-white fw-semibold"><i class="fas fa-passport me-2"></i>{{ __('Visa Information') }}</div><div class="card-body">{!! nl2br(e($destination->visa_info)) !!}</div></div>@endif
            @if(isset($hospitals) && $hospitals->count())
            <h4 class="fw-bold mb-3">{{ __('Top Hospitals') }}</h4>
            <div class="row g-3">
                @foreach($hospitals as $hospital)
                <div class="col-md-6">
                    <a href="{{ route('hospitals.show', $hospital->slug) }}" class="text-decoration-none">
                        <div class="card card-hover border-0 shadow-sm p-3">
                            <div class="fw-semibold small">{{ $hospital->name }}</div>
                            @if($hospital->is_jci_accredited)<span class="badge bg-success-subtle text-success small">{{ __('JCI') }}</span>@endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body small">
                    @if($destination->best_time_to_visit)<p class="mb-2"><i class="fas fa-calendar me-2 text-muted"></i><strong>{{ __('Best Time:') }}</strong> {{ $destination->best_time_to_visit }}</p>@endif
                    @if($destination->climate)<p class="mb-2"><i class="fas fa-cloud-sun me-2 text-muted"></i><strong>{{ __('Climate:') }}</strong> {{ $destination->climate }}</p>@endif
                    @if($destination->cost_savings_text)<p class="mb-0 text-success"><i class="fas fa-piggy-bank me-2"></i>{{ $destination->cost_savings_text }}</p>@endif
                </div>
            </div>
            <a href="{{ route('get_quote') }}?destination={{ $destination->name }}" class="btn btn-primary w-100">{{ __('Plan My Trip') }}</a>
        </div>
    </div>
</div>
@endsection
