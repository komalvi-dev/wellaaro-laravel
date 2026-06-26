@extends('layouts.admin')
@section('title', $specialty->name)
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.specialties.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Specialties</a>
        <h4 class="mb-0 fw-bold mt-1">{{ $specialty->name }}</h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.specialties.edit', $specialty) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit me-1"></i> Edit</a>
        <form method="POST" action="{{ route('admin.specialties.destroy', $specialty) }}" onsubmit="return confirm('Delete this specialty?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i> Delete</button>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="row g-4">

    {{-- Details --}}
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">Details</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted small" style="width:40%">Name</td><td class="fw-semibold">{{ $specialty->name }}</td></tr>
                    <tr><td class="text-muted small">Slug</td><td><code>{{ $specialty->slug }}</code></td></tr>
                    <tr><td class="text-muted small">Icon</td><td>
                        @if($specialty->icon_class)
                            <i class="{{ $specialty->icon_class }} me-1"></i><code>{{ $specialty->icon_class }}</code>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td></tr>
                    <tr><td class="text-muted small">Position</td><td>{{ $specialty->position ?? '—' }}</td></tr>
                    <tr><td class="text-muted small">Status</td><td>
                        @if($specialty->published)
                            <span class="badge bg-success-subtle text-success">Published</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                        @endif
                    </td></tr>
                    <tr><td class="text-muted small">Featured</td><td>
                        @if($specialty->featured)
                            <span class="badge bg-warning-subtle text-warning">Featured</span>
                        @else
                            <span class="text-muted small">No</span>
                        @endif
                    </td></tr>
                    <tr><td class="text-muted small">Created</td><td class="small">{{ $specialty->created_at->format('d M Y') }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Description --}}
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Description</div>
            <div class="card-body">
                @if($specialty->description)
                    <p class="mb-0">{{ $specialty->description }}</p>
                @else
                    <p class="text-muted small mb-0">No description added.</p>
                @endif
            </div>
        </div>

        {{-- Stats --}}
        <div class="row g-3">
            <div class="col-4">
                <div class="card shadow-sm text-center py-3">
                    <div class="fs-3 fw-bold text-primary">{{ $specialty->treatments->count() }}</div>
                    <div class="small text-muted">Treatments</div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm text-center py-3">
                    <div class="fs-3 fw-bold text-success">{{ $specialty->doctors->count() }}</div>
                    <div class="small text-muted">Doctors</div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm text-center py-3">
                    <div class="fs-3 fw-bold text-info">{{ $specialty->hospitals->count() }}</div>
                    <div class="small text-muted">Hospitals</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Treatments --}}
    @if($specialty->treatments->count())
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Treatments ({{ $specialty->treatments->count() }})</div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light"><tr><th>Name</th><th>Status</th><th>Position</th></tr></thead>
                    <tbody>
                        @foreach($specialty->treatments->sortBy('position') as $treatment)
                        <tr>
                            <td class="fw-semibold small">{{ $treatment->name }}</td>
                            <td>
                                @if($treatment->published)
                                    <span class="badge bg-success-subtle text-success">Published</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $treatment->position ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- Doctors --}}
    @if($specialty->doctors->count())
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Doctors ({{ $specialty->doctors->count() }})</div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light"><tr><th>Name</th><th>Designation</th><th>Hospital</th></tr></thead>
                    <tbody>
                        @foreach($specialty->doctors as $doctor)
                        <tr>
                            <td class="fw-semibold small">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                            <td class="small text-muted">{{ $doctor->designation ?? '—' }}</td>
                            <td class="small text-muted">{{ $doctor->hospital?->name ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
