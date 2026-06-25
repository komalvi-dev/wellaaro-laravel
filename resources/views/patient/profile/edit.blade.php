@extends('layouts.patient')

@section('title', 'Edit Profile')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('patient.profile.show') }}" class="btn btn-sm btn-light">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <h5 class="fw-bold mb-0">Edit Profile</h5>
</div>

<form method="POST" action="{{ route('patient.profile.update') }}">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold">Personal Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name', $profile->first_name) }}">
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name', $profile->last_name) }}">
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $profile->phone) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth', $profile->date_of_birth?->format('Y-m-d')) }}">
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nationality</label>
                            <input type="text" name="nationality" class="form-control @error('nationality') is-invalid @enderror"
                                value="{{ old('nationality', $profile->nationality) }}">
                            @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold">Passport Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Passport Number</label>
                            <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror"
                                value="{{ old('passport_number', $profile->passport_number) }}">
                            @error('passport_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Passport Expiry</label>
                            <input type="date" name="passport_expiry" class="form-control @error('passport_expiry') is-invalid @enderror"
                                value="{{ old('passport_expiry', $profile->passport_expiry?->format('Y-m-d')) }}">
                            @error('passport_expiry')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold">Medical Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Blood Group</label>
                            <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror">
                                <option value="">— Select —</option>
                                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group', $profile->blood_group) === $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                @endforeach
                            </select>
                            @error('blood_group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Allergies</label>
                            <textarea name="allergies" class="form-control @error('allergies') is-invalid @enderror" rows="2"
                                placeholder="List any allergies...">{{ old('allergies', $profile->allergies) }}</textarea>
                            @error('allergies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Chronic Conditions</label>
                            <textarea name="chronic_conditions" class="form-control @error('chronic_conditions') is-invalid @enderror" rows="2"
                                placeholder="List any chronic conditions...">{{ old('chronic_conditions', $profile->chronic_conditions) }}</textarea>
                            @error('chronic_conditions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Current Medications</label>
                            <textarea name="current_medications" class="form-control @error('current_medications') is-invalid @enderror" rows="2"
                                placeholder="List current medications...">{{ old('current_medications', $profile->current_medications) }}</textarea>
                            @error('current_medications')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold">Emergency Contact</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                value="{{ old('emergency_contact_name', $profile->emergency_contact_name) }}">
                            @error('emergency_contact_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                value="{{ old('emergency_contact_phone', $profile->emergency_contact_phone) }}">
                            @error('emergency_contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Relationship</label>
                            <input type="text" name="emergency_contact_relationship" class="form-control @error('emergency_contact_relationship') is-invalid @enderror"
                                value="{{ old('emergency_contact_relationship', $profile->emergency_contact_relationship) }}"
                                placeholder="e.g., Spouse, Parent, Sibling">
                            @error('emergency_contact_relationship')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Save Changes
                </button>
                <a href="{{ route('patient.profile.show') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection
