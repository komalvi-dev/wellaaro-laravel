@extends('layouts.admin')
@section('title', 'New Appointment')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.appointments.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Appointments</a>
        <h4 class="mb-0 fw-bold mt-1">New Appointment</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ isset($inquiry) ? route('admin.inquiries.appointments.store', $inquiry) : route('admin.appointments.store') }}">
            @csrf
            @if(isset($inquiry))
            <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <select name="patient_profile_id" class="form-select" required>
                        <option value="">Select patient...</option>
                        @foreach($patients ?? [] as $p)
                        <option value="{{ $p->id }}" {{ (isset($inquiry) && $inquiry->patient_profile_id == $p->id) ? 'selected':'' }}>{{ $p->user->name ?? $p->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <select name="doctor_id" class="form-select">
                        <option value="">Select doctor...</option>
                        @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}">{{ $d->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hospital</label>
                    <select name="hospital_id" class="form-select">
                        <option value="">Select hospital...</option>
                        @foreach($hospitals ?? [] as $h)
                        <option value="{{ $h->id }}">{{ $h->name }}</option>
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
                    <label class="form-label">Appointment Date & Time</label>
                    <input type="datetime-local" name="appointment_date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <select name="appointment_type" class="form-select">
                        <option value="consultation">Consultation</option>
                        <option value="procedure">Procedure</option>
                        <option value="follow_up">Follow-up</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Duration (mins)</label>
                    <input type="number" name="duration_minutes" class="form-control" value="60">
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Appointment</button>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
