@extends('layouts.admin')
@section('title', 'New Quotation')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Inquiry {{ $inquiry->reference_number }}</a>
        <h4 class="mb-0 fw-bold mt-1">New Quotation</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inquiries.quotations.store', $inquiry) }}" id="quotationForm">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Hospital</label>
                    <select name="hospital_id" class="form-select">
                        <option value="">Select hospital...</option>
                        @foreach($hospitals ?? [] as $h)
                        <option value="{{ $h->id }}">{{ $h->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <select name="doctor_id" class="form-select">
                        <option value="">Select doctor...</option>
                        @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}">{{ $d->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Currency</label>
                    <select name="currency" class="form-select">
                        <option value="USD">USD</option>
                        <option value="INR">INR</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Valid Until</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" id="totalAmount" class="form-control" value="{{ old('total_amount') }}" readonly>
                </div>
            </div>

            <h6 class="fw-semibold mt-4 mb-2">Line Items</h6>
            <div id="lineItems">
                <div class="row g-2 mb-2 line-item">
                    <div class="col-md-8"><input type="text" name="line_items[0][description]" class="form-control" placeholder="Description" required></div>
                    <div class="col-md-3"><input type="number" step="0.01" name="line_items[0][amount]" class="form-control item-amount" placeholder="Amount" required></div>
                    <div class="col-md-1"><button type="button" class="btn btn-outline-danger remove-line">×</button></div>
                </div>
            </div>
            <button type="button" id="addLine" class="btn btn-sm btn-outline-secondary mt-2">+ Add Line</button>

            <div class="row g-3 mt-2">
                <div class="col-12"><label class="form-label">Inclusions</label><textarea name="inclusions" class="form-control" rows="2">{{ old('inclusions') }}</textarea></div>
                <div class="col-12"><label class="form-label">Exclusions</label><textarea name="exclusions" class="form-control" rows="2">{{ old('exclusions') }}</textarea></div>
                <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea></div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Quotation</button>
                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
let lineCount = 1;
function recalc() {
    let total = 0;
    document.querySelectorAll('.item-amount').forEach(i => total += parseFloat(i.value)||0);
    document.getElementById('totalAmount').value = total.toFixed(2);
}
document.getElementById('addLine').addEventListener('click', () => {
    const div = document.createElement('div');
    div.className = 'row g-2 mb-2 line-item';
    div.innerHTML = `<div class="col-md-8"><input type="text" name="line_items[${lineCount}][description]" class="form-control" placeholder="Description" required></div>
        <div class="col-md-3"><input type="number" step="0.01" name="line_items[${lineCount}][amount]" class="form-control item-amount" placeholder="Amount" required></div>
        <div class="col-md-1"><button type="button" class="btn btn-outline-danger remove-line">×</button></div>`;
    document.getElementById('lineItems').appendChild(div);
    lineCount++;
});
document.getElementById('lineItems').addEventListener('click', e => {
    if (e.target.classList.contains('remove-line')) { e.target.closest('.line-item').remove(); recalc(); }
});
document.getElementById('lineItems').addEventListener('input', e => { if (e.target.classList.contains('item-amount')) recalc(); });
</script>
@endpush
