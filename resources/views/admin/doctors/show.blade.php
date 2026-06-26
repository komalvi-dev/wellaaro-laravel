@extends('layouts.admin')
@section('title', 'Doctor Profile')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.doctors.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Doctors</a>
        <h4 class="mb-0 fw-bold mt-1">{{ $doctor->full_name }}</h4>
    </div>
    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-outline-primary">Edit</a>
</div>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                @if($doctor->photo_url)
                <img src="{{ $doctor->photo_url }}" class="rounded-circle mb-3" width="96" height="96" style="object-fit:cover;">
                @else
                <div class="rounded-circle bg-primary text-white mx-auto d-flex align-items-center justify-content-center mb-3" style="width:72px;height:72px;font-size:2rem;">
                    {{ strtoupper(substr($doctor->full_name, 0, 1)) }}
                </div>
                @endif
                <h5 class="fw-bold">{{ $doctor->full_name }}</h5>
                <p class="text-muted small">{{ $doctor->designation ?? '' }}</p>
                <p class="text-muted small">{{ $doctor->hospital->name ?? '' }}</p>
            </div>
            <div class="card-footer bg-white">
                <dl class="row mb-0 small">
                    <dt class="col-6 text-muted">Specialty</dt><dd class="col-6">{{ $doctor->specialties->pluck('name')->join(', ') ?: '—' }}</dd>
                    <dt class="col-6 text-muted">Experience</dt><dd class="col-6">{{ $doctor->experience_years ? $doctor->experience_years . ' yrs' : '—' }}</dd>
                    <dt class="col-6 text-muted">Qualification</dt><dd class="col-6">{{ $doctor->qualifications ?? '—' }}</dd>
                    <dt class="col-6 text-muted">Languages</dt><dd class="col-6">{{ is_array($doctor->languages_spoken) ? implode(', ', $doctor->languages_spoken) : ($doctor->languages_spoken ?? '—') }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Biography</div>
            <div class="card-body"><p>{{ $doctor->about ?? 'No biography added.' }}</p></div>
        </div>
        @if($doctor->achievements)
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Achievements</div>
            <div class="card-body"><p>{{ $doctor->achievements }}</p></div>
        </div>
        @endif
    </div>
</div>
@endsection
