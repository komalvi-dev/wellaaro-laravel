@extends('layouts.patient')

@section('title', 'Appointment Details')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('patient.appointments.index') }}" class="btn btn-sm btn-light">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <h5 class="fw-bold mb-0">Appointment Details</h5>
    @php
        $statusColor = match($appointment->status) {
            'confirmed' => 'success',
            'pending'   => 'warning',
            'cancelled' => 'danger',
            'completed' => 'secondary',
            default     => 'light',
        };
    @endphp
    <span class="badge bg-{{ $statusColor }}">{{ ucfirst($appointment->status) }}</span>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-calendar-check me-2 text-primary"></i>Appointment Info</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Date & Time</small>
                        <strong>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, d M Y \a\t h:i A') }}</strong>
                    </div>
                    @if($appointment->treatment)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Treatment</small>
                        <strong>{{ $appointment->treatment->name }}</strong>
                    </div>
                    @endif
                    @if($appointment->doctor)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Doctor</small>
                        <strong>Dr. {{ $appointment->doctor->name }}</strong>
                        <div class="text-muted small">{{ $appointment->doctor->specialty?->name }}</div>
                    </div>
                    @endif
                    @if($appointment->hospital)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Hospital</small>
                        <strong>{{ $appointment->hospital->name }}</strong>
                        <div class="text-muted small">{{ $appointment->hospital->city }}, {{ $appointment->hospital->country }}</div>
                    </div>
                    @endif
                    @if($appointment->duration_minutes)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Duration</small>
                        <strong>{{ $appointment->duration_minutes }} minutes</strong>
                    </div>
                    @endif
                    @if($appointment->appointment_type)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Type</small>
                        <strong>{{ ucfirst(str_replace('_', ' ', $appointment->appointment_type)) }}</strong>
                    </div>
                    @endif
                    @if($appointment->notes)
                    <div class="col-12">
                        <small class="text-muted d-block">Notes</small>
                        <p class="mb-0">{{ $appointment->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($appointment->pre_op_instructions)
        <div class="card border-0 shadow-sm border-info">
            <div class="card-header bg-info bg-opacity-10 border-bottom py-3">
                <h6 class="mb-0 fw-semibold text-info"><i class="fas fa-clipboard-list me-2"></i>Pre-operative Instructions</h6>
            </div>
            <div class="card-body">
                <div class="text-muted">{!! nl2br(e($appointment->pre_op_instructions)) !!}</div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold">Quick Actions</h6>
            </div>
            <div class="card-body d-grid gap-2">
                @if($appointment->inquiry)
                <a href="{{ route('patient.inquiries.show', $appointment->inquiry) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-file-medical me-1"></i>View Inquiry
                </a>
                @endif
                <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-envelope me-1"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
