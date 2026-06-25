@extends('layouts.app')
@section('title', 'Medical Destinations')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Medical Destinations</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Destinations</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        @forelse($destinations as $destination)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('destinations.show', $destination->slug) }}" class="text-decoration-none">
                <div class="card card-hover h-100 border-0 shadow-sm">
                    @if($destination->featured_image_url)<img src="{{ $destination->featured_image_url }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $destination->name }}">@endif
                    <div class="card-body">
                        <h6 class="fw-bold mb-1">{{ $destination->name }}</h6>
                        <p class="text-muted small mb-1">{{ $destination->country->name }}</p>
                        @if($destination->tagline)<p class="small text-muted">{{ $destination->tagline }}</p>@endif
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">No destinations found.</div>
        @endforelse
    </div>
</div>
@endsection
