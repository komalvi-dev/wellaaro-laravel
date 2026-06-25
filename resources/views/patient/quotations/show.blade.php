@extends('layouts.patient')

@section('title', 'Quotation Details')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('patient.quotations.index') }}" class="btn btn-sm btn-light">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <h5 class="fw-bold mb-0">Quotation Details</h5>
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

<div class="row g-4">
    <div class="col-lg-8">
        {{-- Hospital Info --}}
        @if($quotation->hospital)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-hospital me-2 text-primary"></i>Hospital</h6>
            </div>
            <div class="card-body">
                <h6 class="fw-bold">{{ $quotation->hospital->name }}</h6>
                <p class="text-muted mb-0">{{ $quotation->hospital->city }}, {{ $quotation->hospital->country }}</p>
            </div>
        </div>
        @endif

        {{-- Line Items --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-list me-2 text-primary"></i>Cost Breakdown</h6>
            </div>
            <div class="card-body p-0">
                @if($quotation->line_items && count($quotation->line_items) > 0)
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotation->line_items as $item)
                        <tr>
                            <td>{{ $item['description'] ?? $item['name'] ?? 'Item' }}</td>
                            <td class="text-end">${{ number_format($item['amount'] ?? 0, 0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th>Total</th>
                            <th class="text-end text-primary">${{ number_format($quotation->total_amount ?? 0, 0) }}</th>
                        </tr>
                    </tfoot>
                </table>
                @else
                <div class="px-4 py-3 d-flex justify-content-between align-items-center border-bottom">
                    <span>Total Package Cost</span>
                    <strong class="text-primary">${{ number_format($quotation->total_amount ?? 0, 0) }}</strong>
                </div>
                @endif
            </div>
        </div>

        {{-- Notes --}}
        @if($quotation->notes)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold">Notes from Our Team</h6>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $quotation->notes }}</p>
            </div>
        </div>
        @endif

        {{-- Accept / Decline --}}
        @if($quotation->status === 'pending')
        <div class="card border-0 shadow-sm border-warning">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Respond to this Quotation</h6>
                <p class="text-muted small mb-3">
                    By accepting, you confirm your interest in proceeding with this quotation.
                    Our team will contact you to arrange the next steps.
                </p>
                <div class="d-flex gap-3">
                    <form method="POST" action="{{ route('patient.quotations.respond', $quotation) }}">
                        @csrf
                        <input type="hidden" name="response" value="accept">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-1"></i>Accept Quotation
                        </button>
                    </form>
                    <form method="POST" action="{{ route('patient.quotations.respond', $quotation) }}">
                        @csrf
                        <input type="hidden" name="response" value="decline">
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to decline this quotation?')">
                            <i class="fas fa-times me-1"></i>Decline
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold">Summary</h6>
            </div>
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">Total Amount</dt>
                    <dd class="h5 fw-bold text-primary">${{ number_format($quotation->total_amount ?? 0, 0) }}</dd>

                    <dt class="small text-muted">Valid Until</dt>
                    <dd>{{ $quotation->valid_until?->format('d M Y') ?? 'N/A' }}</dd>

                    @if($quotation->currency)
                    <dt class="small text-muted">Currency</dt>
                    <dd>{{ strtoupper($quotation->currency) }}</dd>
                    @endif

                    <dt class="small text-muted">Sent</dt>
                    <dd>{{ $quotation->created_at->format('d M Y') }}</dd>
                </dl>
            </div>
        </div>

        @if($quotation->inquiry)
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h6 class="fw-semibold small mb-2">Related Inquiry</h6>
                <p class="text-muted small mb-2">Ref: {{ $quotation->inquiry->reference_number }}</p>
                <a href="{{ route('patient.inquiries.show', $quotation->inquiry) }}" class="btn btn-sm btn-outline-primary w-100">
                    View Inquiry
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
