@extends('layouts.admin')
@section('title', 'Edit Inquiry')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Inquiry {{ $inquiry->reference_number }}</a>
        <h4 class="mb-0 fw-bold mt-1">Edit Inquiry</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Specialty</label>
                    <select name="specialty_id" class="form-select">
                        <option value="">Select specialty...</option>
                        @foreach($specialties ?? [] as $s)
                        <option value="{{ $s->id }}" {{ $inquiry->specialty_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Treatment</label>
                    <select name="treatment_id" class="form-select">
                        <option value="">Select treatment...</option>
                        @foreach($treatments ?? [] as $t)
                        <option value="{{ $t->id }}" {{ $inquiry->treatment_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Destination</label>
                    <select name="destination_id" class="form-select">
                        <option value="">Any destination</option>
                        @foreach($destinations ?? [] as $d)
                        <option value="{{ $d->id }}" {{ $inquiry->preferred_destination === $d->name ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Budget Range</label>
                    <input type="text" name="budget_range" class="form-control" value="{{ old('budget_range', $inquiry->budget_range) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Preferred Travel Date</label>
                    <input type="date" name="preferred_travel_date" class="form-control" value="{{ old('preferred_travel_date', optional($inquiry->preferred_travel_date)->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach(\App\Models\Inquiry::STATUSES as $s)
                        <option value="{{ $s }}" {{ $inquiry->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Medical Description</label>
                    <textarea name="medical_description" class="form-control" rows="4">{{ old('medical_description', $inquiry->condition_description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Additional Notes</label>
                    <textarea name="additional_notes" class="form-control" rows="2">{{ old('additional_notes', $inquiry->additional_notes) }}</textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
