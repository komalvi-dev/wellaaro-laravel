@extends('layouts.admin')
@section('title', $hospital->name)
@section('breadcrumb')
<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item"><a href="{{ route('admin.hospitals.index') }}">Hospitals</a></li><li class="breadcrumb-item active">{{ Str::limit($hospital->name, 30) }}</li></ol></nav>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        @if($hospital->logo_url)<img src="{{ $hospital->logo_url }}" class="rounded" width="48" height="48" style="object-fit:contain;">@endif
        <div>
            <h4 class="fw-bold mb-0">{{ $hospital->name }}</h4>
            <span class="badge {{ $hospital->published ? 'bg-success' : 'bg-secondary' }}">{{ $hospital->published ? 'Published' : 'Draft' }}</span>
            @if($hospital->featured)<span class="badge bg-warning text-dark ms-1">Featured</span>@endif
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.hospitals.edit', $hospital->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>Edit</a>
        <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" onsubmit="return confirm('Delete this hospital?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash me-1"></i>Delete</button>
        </form>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-semibold">Overview</div>
            <div class="card-body">
                @if($hospital->tagline)<p class="fw-semibold">{{ $hospital->tagline }}</p>@endif
                @if($hospital->description)<p class="text-muted small">{{ $hospital->description }}</p>@endif
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">Specialties ({{ $hospital->specialties->count() }})</div>
            <div class="card-body d-flex flex-wrap gap-2">
                @forelse($hospital->specialties as $s)
                <span class="badge bg-light text-dark border">{{ $s->name }}</span>
                @empty
                <span class="text-muted small">No specialties assigned.</span>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-semibold">Details</div>
            <div class="card-body small">
                @if($hospital->city?->name)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">City</span><span class="fw-semibold">{{ $hospital->city->name }}</span></div>
                @endif
                @if($hospital->country?->name)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">Country</span><span class="fw-semibold">{{ $hospital->country->name }}</span></div>
                @endif
                @if($hospital->phone)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">Phone</span><span class="fw-semibold">{{ $hospital->phone }}</span></div>
                @endif
                @if($hospital->email)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">Email</span><span class="fw-semibold">{{ $hospital->email }}</span></div>
                @endif
                @if($hospital->tier)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">Tier</span><span class="fw-semibold">{{ ucfirst($hospital->tier) }}</span></div>
                @endif
                @if($hospital->bed_count)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">Beds</span><span class="fw-semibold">{{ $hospital->bed_count }}</span></div>
                @endif
                @if($hospital->established_year)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">Established</span><span class="fw-semibold">{{ $hospital->established_year }}</span></div>
                @endif
                @if($hospital->is_jci_accredited)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">JCI</span><span class="badge bg-success-subtle text-success">Accredited</span></div>
                @endif
                @if($hospital->is_nabh_accredited)
                <div class="d-flex justify-content-between mb-1"><span class="text-muted">NABH</span><span class="badge bg-success-subtle text-success">Accredited</span></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
