@extends('layouts.admin')
@section('title', $destination->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $destination->name }}</h1>
    <a href="{{ route('admin.destinations.edit', $destination) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>

{{-- Core details --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header fw-semibold bg-light">Details</div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3 text-muted small">Country</dt>
            <dd class="col-sm-9">{{ $destination->country?->name ?? '—' }}</dd>

            <dt class="col-sm-3 text-muted small">Tagline</dt>
            <dd class="col-sm-9">{{ $destination->tagline ?? '—' }}</dd>

            <dt class="col-sm-3 text-muted small">Status</dt>
            <dd class="col-sm-9">
                <span class="badge {{ $destination->published ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $destination->published ? 'Published' : 'Draft' }}
                </span>
            </dd>

            <dt class="col-sm-3 text-muted small">Best Time to Visit</dt>
            <dd class="col-sm-9">{{ $destination->best_time_to_visit ?? '—' }}</dd>

            <dt class="col-sm-3 text-muted small">Climate</dt>
            <dd class="col-sm-9">{{ $destination->climate ?? '—' }}</dd>
        </dl>
    </div>
</div>

{{-- Description --}}
@if($destination->description)
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header fw-semibold bg-light">Description</div>
    <div class="card-body">
        <p class="mb-0">{{ $destination->description }}</p>
    </div>
</div>
@endif

{{-- Visa Info --}}
@if($destination->visa_info)
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header fw-semibold bg-light">Visa Information</div>
    <div class="card-body">
        <p class="mb-0">{{ $destination->visa_info }}</p>
    </div>
</div>
@endif

{{-- Packages --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header fw-semibold bg-light d-flex align-items-center justify-content-between">
        <span>Packages</span>
        <span class="badge bg-secondary">{{ $destination->packages->count() }}</span>
    </div>
    <div class="card-body p-0">
        @if($destination->packages->isEmpty())
            <p class="text-muted small p-3 mb-0">No packages linked to this destination.</p>
        @else
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destination->packages as $package)
                    <tr>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->price !== null ? number_format($package->price, 2) : '—' }}</td>
                        <td>{{ $package->duration ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $package->published ?? $package->is_active ?? false ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ($package->published ?? $package->is_active ?? false) ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.packages.show', $package) }}" class="btn btn-xs btn-outline-secondary btn-sm py-0 px-2">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
