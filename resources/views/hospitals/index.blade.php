@extends('layouts.app')
@section('title', 'Partner Hospitals')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Partner Hospitals</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Hospitals</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            <form method="GET" class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Filters</h6>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Search</label>
                    <input type="text" name="q" class="form-control form-control-sm" value="{{ request('q') }}" placeholder="Hospital name...">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Specialty</label>
                    <select name="specialty_id" class="form-select form-select-sm">
                        <option value="">All Specialties</option>
                        @foreach($specialties ?? [] as $s)
                            <option value="{{ $s->id }}" {{ request('specialty_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                    <a href="{{ route('hospitals.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                </div>
            </form>
        </div>
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($hospitals as $hospital)
                <div class="col-md-6">
                    <a href="{{ route('hospitals.show', $hospital->slug) }}" class="text-decoration-none">
                        <div class="card card-hover h-100 border-0 shadow-sm">
                            @if($hospital->featured_image_url)
                                <img src="{{ $hospital->featured_image_url }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $hospital->name }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height:160px;"><i class="fas fa-hospital fa-3x text-secondary"></i></div>
                            @endif
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">{{ $hospital->name }}</h6>
                                <p class="text-muted small mb-2">{{ $hospital->city?->name }}, {{ $hospital->country?->name }}</p>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($hospital->is_jci_accredited)<span class="badge bg-success-subtle text-success small">JCI Accredited</span>@endif
                                    @if($hospital->is_nabh_accredited)<span class="badge bg-info-subtle text-info small">NABH</span>@endif
                                    @if($hospital->bed_count)<span class="badge bg-light text-muted small">{{ $hospital->bed_count }} Beds</span>@endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">No hospitals found.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $hospitals->appends(request()->query())->links() }}</div>
        </div>
    </div>
</div>
@endsection
