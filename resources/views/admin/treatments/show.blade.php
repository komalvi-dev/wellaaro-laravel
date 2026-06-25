@extends('layouts.admin')
@section('title', $treatment->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.treatments.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $treatment->name }}</h1>
    <a href="{{ route('admin.treatments.edit', $treatment) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted">{{ $treatment->short_description }}</p>
                <div>{!! nl2br(e($treatment->description)) !!}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">Specialty</dt><dd>{{ $treatment->specialty?->name ?? '—' }}</dd>
                    <dt class="small text-muted">Status</dt><dd><span class="badge {{ $treatment->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $treatment->published ? 'Published' : 'Draft' }}</span></dd>
                    <dt class="small text-muted">India Cost</dt><dd>{{ $treatment->cost_india_min ? '$' . number_format($treatment->cost_india_min) : '—' }}</dd>
                    <dt class="small text-muted">USA Cost</dt><dd>{{ $treatment->cost_usa ? '$' . number_format($treatment->cost_usa) : '—' }}</dd>
                    <dt class="small text-muted">Recovery</dt><dd>{{ $treatment->recovery_time ?? '—' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
