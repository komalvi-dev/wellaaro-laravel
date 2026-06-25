@extends('layouts.patient')

@section('title', 'Appointments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Appointments</h5>
</div>

<ul class="nav nav-tabs mb-4" id="appointmentTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#upcoming">
            <i class="fas fa-calendar-check me-1"></i>Upcoming
            @if($upcoming->isNotEmpty())
            <span class="badge bg-primary ms-1">{{ $upcoming->count() }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#past">
            <i class="fas fa-history me-1"></i>Past
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="upcoming">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @forelse($upcoming as $appointment)
                <div class="d-flex align-items-start px-4 py-3 border-bottom">
                    <div class="me-3 text-center" style="min-width: 60px;">
                        <div class="bg-primary text-white rounded-2 px-2 py-1">
                            <div class="fw-bold" style="font-size:1.2rem;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d') }}</div>
                            <div style="font-size:.7rem;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M Y') }}</div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">{{ $appointment->treatment->name ?? 'Appointment' }}</div>
                        <div class="text-muted small">
                            @if($appointment->doctor)
                            <span class="me-3"><i class="fas fa-user-md me-1"></i>Dr. {{ $appointment->doctor->name }}</span>
                            @endif
                            @if($appointment->hospital)
                            <span class="me-3"><i class="fas fa-hospital me-1"></i>{{ $appointment->hospital->name }}</span>
                            @endif
                            <span><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</span>
                        </div>
                    </div>
                    <div>
                        @php
                            $statusColor = match($appointment->status) {
                                'confirmed' => 'success',
                                'pending'   => 'warning',
                                'cancelled' => 'danger',
                                default     => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $statusColor }}">{{ ucfirst($appointment->status) }}</span>
                        <div class="mt-1">
                            <a href="{{ route('patient.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-5">
                    <i class="fas fa-calendar fa-3x mb-3 opacity-25"></i>
                    <h6>No upcoming appointments</h6>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="past">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @forelse($past as $appointment)
                <div class="d-flex align-items-start px-4 py-3 border-bottom">
                    <div class="me-3 text-center" style="min-width: 60px;">
                        <div class="bg-secondary text-white rounded-2 px-2 py-1">
                            <div class="fw-bold" style="font-size:1.2rem;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d') }}</div>
                            <div style="font-size:.7rem;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M Y') }}</div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold text-muted">{{ $appointment->treatment->name ?? 'Appointment' }}</div>
                        <div class="text-muted small">
                            @if($appointment->doctor)
                            <span class="me-3"><i class="fas fa-user-md me-1"></i>Dr. {{ $appointment->doctor->name }}</span>
                            @endif
                            @if($appointment->hospital)
                            <span><i class="fas fa-hospital me-1"></i>{{ $appointment->hospital->name }}</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-secondary">{{ ucfirst($appointment->status) }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-5">
                    <i class="fas fa-history fa-3x mb-3 opacity-25"></i>
                    <h6>No past appointments</h6>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
