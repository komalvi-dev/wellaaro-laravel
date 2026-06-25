@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Dashboard</h4>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-clipboard-list"></i></div>
                <div>
                    <div class="text-muted small">Total Inquiries</div>
                    <div class="fs-4 fw-bold">{{ $totalInquiries ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon bg-success bg-opacity-10 text-success"><i class="fas fa-users"></i></div>
                <div>
                    <div class="text-muted small">Active Patients</div>
                    <div class="fs-4 fw-bold">{{ $activePatients ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon bg-info bg-opacity-10 text-info"><i class="fas fa-hospital"></i></div>
                <div>
                    <div class="text-muted small">Hospitals</div>
                    <div class="fs-4 fw-bold">{{ $totalHospitals ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-user-md"></i></div>
                <div>
                    <div class="text-muted small">Doctors</div>
                    <div class="fs-4 fw-bold">{{ $totalDoctors ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                Recent Inquiries
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ref #</th>
                                <th>Patient</th>
                                <th>Treatment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInquiries ?? [] as $inquiry)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $inquiry->reference_number }}</span></td>
                                <td>{{ $inquiry->patientProfile->user->name ?? '—' }}</td>
                                <td>{{ $inquiry->treatment->name ?? '—' }}</td>
                                <td><span class="badge {{ $inquiry->statusBadgeClass() }}">{{ ucfirst($inquiry->status) }}</span></td>
                                <td>{{ $inquiry->created_at->format('d M Y') }}</td>
                                <td><a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No recent inquiries</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                Pending Quotations
                <a href="{{ route('admin.inquiries.index') }}?status=quoted" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($pendingQuotations ?? [] as $quotation)
                    <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                        <div>
                            <div class="fw-semibold small">{{ $quotation->inquiry->reference_number ?? '—' }}</div>
                            <div class="text-muted small">{{ $quotation->inquiry->patientProfile->user->name ?? '—' }}</div>
                        </div>
                        <span class="badge bg-warning text-dark">Pending</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center py-4">No pending quotations</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
