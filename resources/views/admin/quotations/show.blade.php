@extends('layouts.admin')
@section('title', 'Quotation Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Inquiry {{ $inquiry->reference_number }}</a>
        <h4 class="mb-0 fw-bold mt-1">Quotation #{{ $quotation->id }}</h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.inquiries.quotations.preview_pdf', [$inquiry, $quotation]) }}" class="btn btn-outline-secondary" target="_blank"><i class="fas fa-file-pdf me-1"></i> Preview PDF</a>
        @if($quotation->status !== 'sent')
        <form method="POST" action="{{ route('admin.inquiries.quotations.send_to_patient', [$inquiry, $quotation]) }}">
            @csrf
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Send to Patient</button>
        </form>
        @endif
        <a href="{{ route('admin.inquiries.quotations.edit', [$inquiry, $quotation]) }}" class="btn btn-outline-primary">Edit</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Quotation Details</div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-sm-6"><dt class="text-muted small">Hospital</dt><dd>{{ $quotation->hospital->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Doctor</dt><dd>{{ $quotation->doctor?->full_name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Currency</dt><dd>{{ $quotation->currency }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Valid Until</dt><dd>{{ $quotation->valid_until ? $quotation->valid_until->format('d M Y') : '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Status</dt><dd><span class="badge bg-secondary">{{ ucfirst($quotation->status) }}</span></dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Sent At</dt><dd>{{ $quotation->sent_at ? $quotation->sent_at->format('d M Y H:i') : '—' }}</dd></div>
                </div>

                <h6 class="fw-semibold">Line Items</h6>
                <table class="table table-sm">
                    <thead class="table-light"><tr><th>Description</th><th class="text-end">Amount</th></tr></thead>
                    <tbody>
                        @foreach($quotation->line_items ?? [] as $item)
                        <tr>
                            <td>{{ $item['description'] ?? '' }}</td>
                            <td class="text-end">{{ $quotation->currency }} {{ number_format($item['amount'] ?? 0, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold"><td>Total</td><td class="text-end">{{ $quotation->currency }} {{ number_format($quotation->total_cost, 2) }}</td></tr>
                    </tfoot>
                </table>

                @if($quotation->notes)
                <div class="mt-3"><dt class="text-muted small">Notes</dt><dd>{{ $quotation->notes }}</dd></div>
                @endif
                @if($quotation->inclusions)
                <div class="mt-2"><dt class="text-muted small">Inclusions</dt><dd>{{ $quotation->inclusions }}</dd></div>
                @endif
                @if($quotation->exclusions)
                <div class="mt-2"><dt class="text-muted small">Exclusions</dt><dd>{{ $quotation->exclusions }}</dd></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Patient Response</div>
            <div class="card-body">
                @if($quotation->patient_response)
                <span class="badge {{ $quotation->patient_response === 'accepted' ? 'bg-success' : 'bg-danger' }} mb-2">{{ ucfirst($quotation->patient_response) }}</span>
                @if($quotation->patient_notes)
                <p class="text-muted small mt-2">{{ $quotation->patient_notes }}</p>
                @endif
                @else
                <p class="text-muted small">No response yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
