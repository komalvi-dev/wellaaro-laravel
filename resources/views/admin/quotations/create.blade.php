@extends('layouts.admin')
@section('title', 'New Quotation')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Inquiry {{ $inquiry->reference_number }}</a>
        <h4 class="mb-0 fw-bold mt-1">New Quotation</h4>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inquiries.quotations.store', $inquiry) }}" id="quotationForm">
            @csrf

            {{-- Context --}}
            <h6 class="fw-semibold mb-3">Context</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Hospital</label>
                    <select name="hospital_id" class="form-select">
                        <option value="">Select hospital...</option>
                        @foreach($hospitals ?? [] as $h)
                        <option value="{{ $h->id }}" {{ old('hospital_id') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Doctor</label>
                    <select name="doctor_id" class="form-select">
                        <option value="">Select doctor...</option>
                        @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}" {{ old('doctor_id') == $d->id ? 'selected' : '' }}>{{ $d->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Treatment</label>
                    <select name="treatment_id" class="form-select">
                        <option value="">Select treatment...</option>
                        @foreach($treatments ?? [] as $t)
                        <option value="{{ $t->id }}" {{ old('treatment_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Currency <span class="text-danger">*</span></label>
                    <select name="currency" class="form-select" required>
                        @foreach(['USD','INR','EUR','GBP'] as $c)
                        <option value="{{ $c }}" {{ old('currency', 'USD') === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Valid Until</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Validity (days)</label>
                    <input type="number" name="validity_days" class="form-control" value="{{ old('validity_days', 30) }}" min="1">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Treatment Duration</label>
                    <input type="text" name="treatment_duration" class="form-control" value="{{ old('treatment_duration') }}" placeholder="e.g. 5–7 days">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hospital Stay (days)</label>
                    <input type="number" name="hospital_stay_days" class="form-control" value="{{ old('hospital_stay_days') }}" min="0">
                </div>
            </div>

            {{-- Cost breakdown --}}
            <h6 class="fw-semibold mb-3">Cost Breakdown</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Treatment Cost <span class="text-danger">*</span></label>
                    <input type="number" name="treatment_cost" class="form-control cost-field" value="{{ old('treatment_cost', 0) }}" min="0" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hospital Stay Cost</label>
                    <input type="number" name="hospital_stay_cost" class="form-control cost-field" value="{{ old('hospital_stay_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Consultation Cost</label>
                    <input type="number" name="consultation_cost" class="form-control cost-field" value="{{ old('consultation_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Diagnostic Cost</label>
                    <input type="number" name="diagnostic_cost" class="form-control cost-field" value="{{ old('diagnostic_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Medicine Cost</label>
                    <input type="number" name="medicine_cost" class="form-control cost-field" value="{{ old('medicine_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Travel Cost</label>
                    <input type="number" name="travel_cost" class="form-control cost-field" value="{{ old('travel_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Accommodation Cost</label>
                    <input type="number" name="accommodation_cost" class="form-control cost-field" value="{{ old('accommodation_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Visa Cost</label>
                    <input type="number" name="visa_cost" class="form-control cost-field" value="{{ old('visa_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Other Cost</label>
                    <input type="number" name="other_cost" class="form-control cost-field" value="{{ old('other_cost', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Discount Amount</label>
                    <input type="number" name="discount_amount" id="discountAmount" class="form-control" value="{{ old('discount_amount', 0) }}" min="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Deposit Percentage (%)</label>
                    <input type="number" name="deposit_percentage" class="form-control" value="{{ old('deposit_percentage', 20) }}" min="0" max="100">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estimated Total</label>
                    <input type="text" id="estimatedTotal" class="form-control bg-light" readonly>
                </div>
            </div>

            {{-- Additional details --}}
            <h6 class="fw-semibold mb-3">Additional Details</h6>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Hospital Details</label>
                    <textarea name="hospital_details" class="form-control" rows="2">{{ old('hospital_details') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Doctor Details</label>
                    <textarea name="doctor_details" class="form-control" rows="2">{{ old('doctor_details') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Inclusions</label>
                    <textarea name="inclusions" class="form-control" rows="2">{{ old('inclusions') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Exclusions</label>
                    <textarea name="exclusions" class="form-control" rows="2">{{ old('exclusions') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Terms &amp; Conditions</label>
                    <textarea name="terms" class="form-control" rows="3">{{ old('terms') }}</textarea>
                </div>
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
function recalc() {
    let sum = 0;
    document.querySelectorAll('.cost-field').forEach(i => sum += parseInt(i.value, 10) || 0);
    const discount = parseInt(document.getElementById('discountAmount').value, 10) || 0;
    const total = Math.max(0, sum - discount);
    document.getElementById('estimatedTotal').value = total.toLocaleString();
}
document.querySelectorAll('.cost-field, #discountAmount').forEach(el => el.addEventListener('input', recalc));
recalc();
</script>
@endpush
