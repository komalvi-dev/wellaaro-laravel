@extends('layouts.patient')

@section('title', 'My Inquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">My Inquiries</h5>
    <a href="{{ route('get_quote') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>New Inquiry
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($inquiries as $inquiry)
        <div class="d-flex align-items-center px-4 py-3 border-bottom">
            <div class="flex-grow-1">
                <div class="fw-semibold">{{ $inquiry->treatment->name ?? ($inquiry->specialty->name ?? 'General Inquiry') }}</div>
                <div class="text-muted small mt-1">
                    <span class="me-3"><i class="fas fa-hashtag me-1"></i>{{ $inquiry->reference_number }}</span>
                    @if($inquiry->hospital)
                    <span class="me-3"><i class="fas fa-hospital me-1"></i>{{ $inquiry->hospital->name }}</span>
                    @endif
                    <span><i class="fas fa-calendar me-1"></i>{{ $inquiry->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge {{ $inquiry->statusBadgeClass() }} px-3 py-2">
                    {{ ucfirst(str_replace('_', ' ', $inquiry->status)) }}
                </span>
                <a href="{{ route('patient.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-primary">
                    View Details
                </a>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-file-medical fa-3x mb-3 opacity-25"></i>
            <h6>No inquiries yet</h6>
            <p class="small mb-3">Submit an inquiry to get started with your medical journey.</p>
            <a href="{{ route('get_quote') }}" class="btn btn-primary btn-sm">Get a Free Quote</a>
        </div>
        @endforelse
    </div>
    @if($inquiries->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>
@endsection
