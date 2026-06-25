@extends('layouts.admin')
@section('title', 'Edit Quotation')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.quotations.show', [$inquiry, $quotation]) }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Quotation #{{ $quotation->id }}</a>
        <h4 class="mb-0 fw-bold mt-1">Edit Quotation</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inquiries.quotations.update', [$inquiry, $quotation]) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Hospital</label>
                    <select name="hospital_id" class="form-select">
                        <option value="">Select hospital...</option>
                        @foreach($hospitals ?? [] as $h)
                        <option value="{{ $h->id }}" {{ $quotation->hospital_id == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <select name="doctor_id" class="form-select">
                        <option value="">Select doctor...</option>
                        @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}" {{ $quotation->doctor_id == $d->id ? 'selected' : '' }}>{{ $d->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Currency</label>
                    <select name="currency" class="form-select">
                        @foreach(['USD','INR','EUR','GBP'] as $c)
                        <option value="{{ $c }}" {{ $quotation->currency === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Valid Until</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until', optional($quotation->valid_until)->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ old('total_amount', $quotation->total_amount) }}">
                </div>
                <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="2">{{ old('notes', $quotation->notes) }}</textarea></div>
                <div class="col-12"><label class="form-label">Inclusions</label><textarea name="inclusions" class="form-control" rows="2">{{ old('inclusions', $quotation->inclusions) }}</textarea></div>
                <div class="col-12"><label class="form-label">Exclusions</label><textarea name="exclusions" class="form-control" rows="2">{{ old('exclusions', $quotation->exclusions) }}</textarea></div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.inquiries.quotations.show', [$inquiry, $quotation]) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
