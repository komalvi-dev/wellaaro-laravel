@extends('layouts.patient')

@section('title', 'Upload Medical Record')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('patient.medical-records.index') }}" class="btn btn-sm btn-light">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <h5 class="fw-bold mb-0">Upload Medical Record</h5>
</div>

<div class="card border-0 shadow-sm" style="max-width: 600px;">
    <div class="card-body">
        <form method="POST" action="{{ route('patient.medical-records.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Record Type <span class="text-danger">*</span></label>
                <select name="record_type" class="form-select @error('record_type') is-invalid @enderror" required>
                    <option value="">— Select type —</option>
                    <option value="lab_report"     {{ old('record_type') === 'lab_report'     ? 'selected' : '' }}>Lab Report</option>
                    <option value="imaging"        {{ old('record_type') === 'imaging'        ? 'selected' : '' }}>Imaging / Scan</option>
                    <option value="prescription"   {{ old('record_type') === 'prescription'   ? 'selected' : '' }}>Prescription</option>
                    <option value="discharge"      {{ old('record_type') === 'discharge'      ? 'selected' : '' }}>Discharge Summary</option>
                    <option value="referral"       {{ old('record_type') === 'referral'       ? 'selected' : '' }}>Referral Letter</option>
                    <option value="insurance"      {{ old('record_type') === 'insurance'      ? 'selected' : '' }}>Insurance Document</option>
                    <option value="other"          {{ old('record_type') === 'other'          ? 'selected' : '' }}>Other</option>
                </select>
                @error('record_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                    placeholder="Brief description of the document...">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">File <span class="text-danger">*</span></label>
                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                <div class="form-text">Accepted: PDF, JPG, PNG, DOC, DOCX. Max 10MB.</div>
                @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload me-1"></i>Upload Record
                </button>
                <a href="{{ route('patient.medical-records.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
