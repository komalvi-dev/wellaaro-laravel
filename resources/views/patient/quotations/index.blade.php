@extends('layouts.patient')

@section('title', 'My Quotations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">My Quotations</h5>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($quotations as $quotation)
        <div class="d-flex align-items-center px-4 py-3 border-bottom">
            <div class="flex-grow-1">
                <div class="fw-semibold">{{ $quotation->hospital->name ?? 'Medical Quotation' }}</div>
                <div class="text-muted small mt-1">
                    @if($quotation->inquiry)
                    <span class="me-3"><i class="fas fa-hashtag me-1"></i>{{ $quotation->inquiry->reference_number }}</span>
                    @endif
                    @if($quotation->valid_until)
                    <span class="me-3">
                        <i class="fas fa-calendar-times me-1"></i>
                        Valid till {{ $quotation->valid_until->format('d M Y') }}
                        @if($quotation->valid_until->isPast())
                        <span class="text-danger">(Expired)</span>
                        @endif
                    </span>
                    @endif
                    <span><i class="fas fa-clock me-1"></i>{{ $quotation->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="fw-bold text-primary">${{ number_format($quotation->total_amount ?? 0, 0) }}</div>
                    @php
                        $badgeClass = match($quotation->status) {
                            'pending'  => 'bg-warning text-dark',
                            'accepted' => 'bg-success',
                            'declined' => 'bg-danger',
                            'expired'  => 'bg-secondary',
                            default    => 'bg-light text-dark',
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ ucfirst($quotation->status) }}</span>
                </div>
                <a href="{{ route('patient.quotations.show', $quotation) }}" class="btn btn-sm btn-outline-primary">
                    View
                </a>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-file-invoice-dollar fa-3x mb-3 opacity-25"></i>
            <h6>No quotations yet</h6>
            <p class="small">Quotations will appear here once our team responds to your inquiry.</p>
        </div>
        @endforelse
    </div>
    @if($quotations->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $quotations->links() }}
    </div>
    @endif
</div>
@endsection
