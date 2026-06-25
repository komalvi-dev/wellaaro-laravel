@extends('layouts.admin')
@section('title', $package->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $package->name }}</h1>
    <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($package->tagline)<p class="text-muted fw-semibold">{{ $package->tagline }}</p>@endif
                @if($package->description)<p>{{ $package->description }}</p>@endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">Hospital</dt><dd>{{ $package->hospital?->name ?? '—' }}</dd>
                    <dt class="small text-muted">Duration</dt><dd>{{ $package->duration_days }} days</dd>
                    <dt class="small text-muted">Price From</dt><dd>{{ $package->price_usd_from ? '$' . number_format($package->price_usd_from) : '—' }}</dd>
                    <dt class="small text-muted">Status</dt><dd><span class="badge {{ $package->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $package->published ? 'Published' : 'Draft' }}</span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
