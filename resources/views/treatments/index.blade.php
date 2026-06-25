@extends('layouts.app')
@section('title', 'Treatments')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Medical Treatments</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Treatments</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Filter by Specialty</h6>
                <form method="GET">
                    @foreach($specialties ?? [] as $specialty)
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="specialty_id" value="{{ $specialty->id }}" id="s{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'checked' : '' }}>
                        <label class="form-check-label small" for="s{{ $specialty->id }}">{{ $specialty->name }}</label>
                    </div>
                    @endforeach
                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        <a href="{{ route('treatments.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row g-3">
                @foreach($treatments as $treatment)
                <div class="col-md-6">
                    <a href="{{ route('treatments.show', $treatment->slug) }}" class="text-decoration-none">
                        <div class="card card-hover h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <span class="badge bg-primary-subtle text-primary mb-2 small">{{ $treatment->specialty?->name }}</span>
                                <h6 class="fw-bold">{{ $treatment->name }}</h6>
                                <p class="text-muted small">{{ $treatment->short_description }}</p>
                                <div class="row g-1 text-center mt-2">
                                    @if($treatment->recovery_time)
                                        <div class="col-6"><small class="text-muted">Recovery</small><br><small class="fw-semibold">{{ $treatment->recovery_time }}</small></div>
                                    @endif
                                    @if($treatment->cost_india_min)
                                        <div class="col-6"><small class="text-muted">Cost from</small><br><small class="fw-semibold text-success">${{ number_format($treatment->cost_india_min) }}</small></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $treatments->links() }}</div>
        </div>
    </div>
</div>
@endsection
