@extends('layouts.admin')
@section('title', 'New Inquiry')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Inquiries</a>
        <h4 class="mb-0 fw-bold mt-1">New Inquiry</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inquiries.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <select name="patient_profile_id" class="form-select" required>
                        <option value="">Select patient...</option>
                        @foreach($patients ?? [] as $p)
                        <option value="{{ $p->id }}">{{ $p->user->name ?? $p->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Specialty</label>
                    <select name="specialty_id" class="form-select">
                        <option value="">Select specialty...</option>
                        @foreach($specialties ?? [] as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Treatment</label>
                    <select name="treatment_id" class="form-select">
                        <option value="">Select treatment...</option>
                        @foreach($treatments ?? [] as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Destination</label>
                    <select name="destination_id" class="form-select">
                        <option value="">Any destination</option>
                        @foreach($destinations ?? [] as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Budget Range</label>
                    <input type="text" name="budget_range" class="form-control" value="{{ old('budget_range') }}" placeholder="e.g. $5,000–$10,000">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Preferred Travel Date</label>
                    <input type="date" name="preferred_travel_date" class="form-control" value="{{ old('preferred_travel_date') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Medical Description</label>
                    <textarea name="medical_description" class="form-control" rows="4">{{ old('medical_description') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Additional Notes</label>
                    <textarea name="additional_notes" class="form-control" rows="2">{{ old('additional_notes') }}</textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Inquiry</button>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
