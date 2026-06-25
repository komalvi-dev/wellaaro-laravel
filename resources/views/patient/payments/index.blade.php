@extends('layouts.patient')

@section('title', 'Payments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Payment History</h5>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($payments as $payment)
        <div class="d-flex align-items-center px-4 py-3 border-bottom">
            <div class="me-3">
                @php
                    $iconColor = match($payment->status) {
                        'paid'    => 'text-success',
                        'pending' => 'text-warning',
                        'failed'  => 'text-danger',
                        default   => 'text-muted',
                    };
                @endphp
                <i class="fas fa-receipt fa-lg {{ $iconColor }}"></i>
            </div>
            <div class="flex-grow-1">
                <div class="fw-semibold">
                    {{ $payment->payment_type ? ucfirst(str_replace('_', ' ', $payment->payment_type)) : 'Payment' }}
                </div>
                <div class="text-muted small">
                    @if($payment->inquiry)
                    <span class="me-3">Ref: {{ $payment->inquiry->reference_number }}</span>
                    @endif
                    <span>{{ $payment->created_at->format('d M Y') }}</span>
                    @if($payment->transaction_id)
                    <span class="ms-3 text-muted">TXN: {{ $payment->transaction_id }}</span>
                    @endif
                </div>
            </div>
            <div class="text-end">
                <div class="fw-bold">${{ number_format($payment->amount ?? 0, 2) }}</div>
                @php
                    $badgeClass = match($payment->status) {
                        'paid'    => 'bg-success',
                        'pending' => 'bg-warning text-dark',
                        'failed'  => 'bg-danger',
                        'refunded'=> 'bg-info',
                        default   => 'bg-secondary',
                    };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ ucfirst($payment->status) }}</span>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-credit-card fa-3x mb-3 opacity-25"></i>
            <h6>No payments yet</h6>
            <p class="small">Your payment history will appear here.</p>
        </div>
        @endforelse
    </div>
    @if($payments->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $payments->links() }}
    </div>
    @endif
</div>
@endsection
