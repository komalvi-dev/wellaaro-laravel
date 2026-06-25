@extends('layouts.app')
@section('title', 'Medical Packages')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Medical Packages</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Packages</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        @forelse($packages as $package)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('packages.show', $package->slug) }}" class="text-decoration-none">
                <div class="card card-hover h-100 border-0 shadow-sm">
                    @if($package->featured_image_url)<img src="{{ $package->featured_image_url }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $package->name }}">@endif
                    <div class="card-body">
                        <h6 class="fw-bold mb-1">{{ $package->name }}</h6>
                        @if($package->tagline)<p class="text-muted small mb-2">{{ $package->tagline }}</p>@endif
                        <div class="d-flex justify-content-between align-items-center">
                            @if($package->duration_days_min)<span class="text-muted small"><i class="fas fa-clock me-1"></i>{{ $package->duration_days_min }}-{{ $package->duration_days_max ?? $package->duration_days_min }} days</span>@endif
                            @if($package->price_usd_from)<span class="text-success fw-bold">From ${{ number_format($package->price_usd_from) }}</span>@endif
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">No packages available.</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $packages->links() }}</div>
</div>
@endsection
