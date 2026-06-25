@extends('layouts.admin')
@section('title', 'Appointment Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.appointments.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Appointments</a>
        <h4 class="mb-0 fw-bold mt-1">Appointment #{{ $appointment->id }}</h4>
    </div>
    <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-outline-primary">Edit</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Details</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6"><dt class="text-muted small">Patient</dt><dd>{{ $appointment->patientProfile?->user?->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Doctor</dt><dd>{{ $appointment->doctor?->full_name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Hospital</dt><dd>{{ $appointment->hospital->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Treatment</dt><dd>{{ $appointment->treatment->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Appointment Date</dt><dd>{{ $appointment->appointment_date ? $appointment->appointment_date->format('d M Y, H:i') : '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Status</dt><dd><span class="badge bg-secondary">{{ ucfirst(str_replace('_',' ',$appointment->status)) }}</span></dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Type</dt><dd>{{ ucfirst($appointment->appointment_type ?? '—') }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Duration</dt><dd>{{ $appointment->duration_minutes ? $appointment->duration_minutes . ' mins' : '—' }}</dd></div>
                    @if($appointment->notes)
                    <div class="col-12"><dt class="text-muted small">Notes</dt><dd>{{ $appointment->notes }}</dd></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @if($appointment->inquiry)
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Related Inquiry</div>
            <div class="card-body">
                <div class="fw-semibold">{{ $appointment->inquiry->reference_number }}</div>
                <span class="badge {{ $appointment->inquiry->statusBadgeClass() }} mt-1">{{ ucfirst($appointment->inquiry->status) }}</span>
                <div class="mt-2"><a href="{{ route('admin.inquiries.show', $appointment->inquiry) }}" class="btn btn-sm btn-outline-primary">View Inquiry</a></div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
