@extends('layouts.patient')

@section('title', 'My Profile')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">My Profile</h5>
    <a href="{{ route('patient.profile.edit') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-edit me-1"></i>Edit Profile
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body py-4">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3 fw-bold"
                     style="width:80px;height:80px;font-size:1.75rem;">
                    {{ strtoupper(substr($profile->first_name ?? auth()->user()->first_name ?? 'P', 0, 1)) }}
                </div>
                <h5 class="fw-bold mb-1">{{ $profile->first_name }} {{ $profile->last_name }}</h5>
                <p class="text-muted small mb-2">{{ auth()->user()->email }}</p>
                @if($profile->nationality)
                <p class="text-muted small mb-0">
                    <i class="fas fa-globe me-1"></i>{{ $profile->nationality }}
                </p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-user me-2 text-primary"></i>Personal Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">First Name</small>
                        <span>{{ $profile->first_name ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Last Name</small>
                        <span>{{ $profile->last_name ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Phone</small>
                        <span>{{ $profile->phone ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Date of Birth</small>
                        <span>{{ $profile->date_of_birth?->format('d M Y') ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Nationality</small>
                        <span>{{ $profile->nationality ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-passport me-2 text-primary"></i>Passport Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Passport Number</small>
                        <span>{{ $profile->passport_number ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Passport Expiry</small>
                        <span>{{ $profile->passport_expiry?->format('d M Y') ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-heartbeat me-2 text-primary"></i>Medical Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Blood Group</small>
                        <span>{{ $profile->blood_group ?? '—' }}</span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Allergies</small>
                        <span>{{ $profile->allergies ?? '—' }}</span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Chronic Conditions</small>
                        <span>{{ $profile->chronic_conditions ?? '—' }}</span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Current Medications</small>
                        <span>{{ $profile->current_medications ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-phone-alt me-2 text-primary"></i>Emergency Contact</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Name</small>
                        <span>{{ $profile->emergency_contact_name ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Phone</small>
                        <span>{{ $profile->emergency_contact_phone ?? '—' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Relationship</small>
                        <span>{{ $profile->emergency_contact_relationship ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
