@extends('layouts.admin')
@section('title', 'Quotations')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Quotations</h4>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Inquiry Ref</th>
                        <th>Patient</th>
                        <th>Hospital</th>
                        <th>Amount</th>
                        <th>Valid Until</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations as $q)
                    <tr>
                        <td><a href="{{ route('admin.inquiries.show', $q->inquiry) }}">{{ $q->inquiry->reference_number ?? '—' }}</a></td>
                        <td>{{ $q->inquiry?->patient_name ?? '—' }}</td>
                        <td>{{ $q->hospital->name ?? '—' }}</td>
                        <td>{{ $q->currency }} {{ number_format($q->total_amount, 2) }}</td>
                        <td>{{ $q->valid_until ? $q->valid_until->format('d M Y') : '—' }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($q->status) }}</span></td>
                        <td>
                            <a href="{{ route('admin.inquiries.quotations.show', [$q->inquiry, $q]) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No quotations found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($quotations, 'hasPages') && $quotations->hasPages())
    <div class="card-footer bg-white">{{ $quotations->links() }}</div>
    @endif
</div>
@endsection
