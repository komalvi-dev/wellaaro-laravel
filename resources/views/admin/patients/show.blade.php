@extends('layouts.admin')
@section('title', 'Patient Profile')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.patients.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Patients</a>
        <h4 class="mb-0 fw-bold mt-1">{{ $patient->user->name ?? $patient->full_name }}</h4>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <div class="rounded-circle bg-primary text-white mx-auto d-flex align-items-center justify-content-center mb-3" style="width:72px;height:72px;font-size:2rem;">
                    {{ strtoupper(substr($patient->user->name ?? 'P', 0, 1)) }}
                </div>
                <h5 class="fw-bold">{{ $patient->user->name ?? $patient->full_name }}</h5>
                <p class="text-muted small mb-1">{{ $patient->user->email ?? '' }}</p>
                <p class="text-muted small">{{ $patient->phone ?? '' }}</p>
            </div>
            <div class="card-footer bg-white">
                <dl class="row mb-0">
                    <dt class="col-6 text-muted small">Nationality</dt><dd class="col-6 small">{{ $patient->nationality ?? '—' }}</dd>
                    <dt class="col-6 text-muted small">Date of Birth</dt><dd class="col-6 small">{{ $patient->date_of_birth ? $patient->date_of_birth->format('d M Y') : '—' }}</dd>
                    <dt class="col-6 text-muted small">Gender</dt><dd class="col-6 small">{{ ucfirst($patient->gender ?? '—') }}</dd>
                    <dt class="col-6 text-muted small">Blood Group</dt><dd class="col-6 small">{{ $patient->blood_group ?? '—' }}</dd>
                </dl>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Medical Records</div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($patient->medicalRecords ?? [] as $rec)
                    <li class="list-group-item small">
                        <div class="fw-semibold">{{ $rec->title }}</div>
                        <div class="text-muted">{{ $rec->record_type }} · {{ $rec->created_at->format('d M Y') }}</div>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center py-3">No records</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Inquiry History</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light"><tr><th>Ref #</th><th>Treatment</th><th>Status</th><th>Date</th><th></th></tr></thead>
                        <tbody>
                            @forelse($patient->inquiries ?? [] as $inquiry)
                            <tr>
                                <td>{{ $inquiry->reference_number }}</td>
                                <td>{{ $inquiry->treatment->name ?? '—' }}</td>
                                <td><span class="badge {{ $inquiry->statusBadgeClass() }}">{{ ucfirst(str_replace('_',' ',$inquiry->status)) }}</span></td>
                                <td>{{ $inquiry->created_at->format('d M Y') }}</td>
                                <td><a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-muted text-center py-3">No inquiries</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
