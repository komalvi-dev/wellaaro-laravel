@extends('layouts.patient')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold">Welcome back, {{ auth()->user()->first_name }}!</h4>
    <p class="text-muted mb-0">Here's a summary of your medical journey.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fas fa-file-medical text-primary"></i>
                    </div>
                    <div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['active_inquiries'] }}</div>
                        <small class="text-muted">Active Inquiries</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #f59e0b !important;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fas fa-file-invoice-dollar text-warning"></i>
                    </div>
                    <div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['pending_quotations'] }}</div>
                        <small class="text-muted">Pending Quotations</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #10b981 !important;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fas fa-calendar-check text-success"></i>
                    </div>
                    <div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['upcoming_appointments'] }}</div>
                        <small class="text-muted">Upcoming Appointments</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Recent Inquiries</h6>
                <a href="{{ route('patient.inquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentInquiries as $inquiry)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <div class="flex-grow-1">
                        <div class="fw-medium small">{{ $inquiry->treatment->name ?? 'General Inquiry' }}</div>
                        <div class="text-muted" style="font-size:.75rem;">Ref: {{ $inquiry->reference_number }} &middot; {{ $inquiry->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge {{ $inquiry->statusBadgeClass() }}">{{ ucfirst(str_replace('_',' ',$inquiry->status)) }}</span>
                        <a href="{{ route('patient.inquiries.show', $inquiry) }}" class="btn btn-sm btn-light">View</a>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p class="mb-0">No inquiries yet. <a href="{{ route('get_quote') }}">Get a quote</a> to start.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">Recent Quotations</h6>
                <a href="{{ route('patient.quotations.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentQuotations as $quotation)
                <div class="px-3 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-medium small">{{ $quotation->hospital->name ?? 'Hospital Quotation' }}</div>
                            <div class="text-muted" style="font-size:.75rem;">Valid: {{ $quotation->valid_until ? $quotation->valid_until->format('d M Y') : 'N/A' }}</div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary small">${{ number_format($quotation->total_cost ?? 0, 0) }}</div>
                            <span class="badge bg-warning text-dark" style="font-size:.65rem;">{{ ucfirst($quotation->status) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-file-invoice fa-2x mb-2"></i>
                    <p class="mb-0">No quotations yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
