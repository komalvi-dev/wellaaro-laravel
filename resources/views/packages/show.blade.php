@extends('layouts.app')
@section('title', $package->name)
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item"><a href="{{ route('packages.index') }}">{{ __('Packages') }}</a></li><li class="breadcrumb-item active">{{ $package->name }}</li></ol></nav>
        <x-breadcrumb-schema :items="[
            ['name' => __('Home'), 'url' => route('home')],
            ['name' => __('Packages'), 'url' => route('packages.index')],
            ['name' => $package->name],
        ]" />
        <h1 class="h2 fw-bold">{{ $package->name }}</h1>
        @if($package->tagline)<p class="text-muted">{{ $package->tagline }}</p>@endif
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            @if($package->description)<div class="card border-0 shadow-sm mb-4"><div class="card-body">{!! nl2br(e($package->description)) !!}</div></div>@endif
            @if($package->highlights)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Package Highlights') }}</div>
                <div class="card-body"><ul class="list-group list-group-flush">@foreach($package->highlights as $h)<li class="list-group-item border-0 ps-0"><i class="fas fa-check text-success me-2"></i>{{ $h }}</li>@endforeach</ul></div>
            </div>
            @endif
            @if($package->inclusions)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Inclusions') }}</div>
                <div class="card-body"><ul class="list-group list-group-flush">@foreach($package->inclusions as $inc)<li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i>{{ $inc }}</li>@endforeach</ul></div>
            </div>
            @endif
            @if($package->exclusions)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Exclusions') }}</div>
                <div class="card-body"><ul class="list-group list-group-flush">@foreach($package->exclusions as $exc)<li class="list-group-item border-0 ps-0"><i class="fas fa-times-circle text-danger me-2"></i>{{ $exc }}</li>@endforeach</ul></div>
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top:80px;">
                <div class="card-body">
                    @if($package->price_usd_from)<div class="h4 text-success fw-bold mb-1">{{ __('From') }} ${{ number_format($package->price_usd_from) }}</div>@endif
                    @if($package->price_note)<p class="text-muted small mb-3">{{ $package->price_note }}</p>@endif
                    <div class="mb-3">
                        @if($package->duration_days_min)<p class="mb-1 small"><i class="fas fa-clock me-2 text-muted"></i>{{ $package->duration_days_min }}-{{ $package->duration_days_max ?? $package->duration_days_min }} {{ __('days') }}</p>@endif
                        @if($package->destination)<p class="mb-1 small"><i class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $package->destination->name }}</p>@endif
                        @if($package->hospital)<p class="mb-0 small"><i class="fas fa-hospital me-2 text-muted"></i>{{ $package->hospital->name }}</p>@endif
                    </div>
                    <a href="{{ route('get_quote') }}?package_id={{ $package->id }}" class="btn btn-primary w-100">{{ __('Book This Package') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
