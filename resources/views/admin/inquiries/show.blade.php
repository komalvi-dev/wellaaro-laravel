@extends('layouts.admin')
@section('title', 'Inquiry ' . $inquiry->reference_number)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.inquiries.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Inquiries</a>
        <h4 class="mb-0 fw-bold mt-1">Inquiry {{ $inquiry->reference_number }}</h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.inquiries.edit', $inquiry) }}" class="btn btn-outline-secondary">Edit</a>
        <a href="{{ route('admin.inquiries.quotations.create', $inquiry) }}" class="btn btn-primary">+ Quotation</a>
    </div>
</div>

<div class="row g-4">
    {{-- Left column --}}
    <div class="col-lg-8">
        {{-- Inquiry Details --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Inquiry Details</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6"><dt class="text-muted small">Specialty</dt><dd>{{ $inquiry->specialty->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Treatment</dt><dd>{{ $inquiry->treatment->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Destination</dt><dd>{{ $inquiry->destination->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Hospital Preference</dt><dd>{{ $inquiry->hospital->name ?? 'Any' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Budget</dt><dd>{{ $inquiry->budget_range ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Travel Date</dt><dd>{{ $inquiry->preferred_travel_date ? $inquiry->preferred_travel_date->format('d M Y') : '—' }}</dd></div>
                    <div class="col-12"><dt class="text-muted small">Medical Description</dt><dd>{{ $inquiry->medical_description ?? '—' }}</dd></div>
                    <div class="col-12"><dt class="text-muted small">Additional Notes</dt><dd>{{ $inquiry->additional_notes ?? '—' }}</dd></div>
                </div>
            </div>
        </div>

        {{-- Quotations --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold d-flex justify-content-between">
                Quotations
                <a href="{{ route('admin.inquiries.quotations.create', $inquiry) }}" class="btn btn-sm btn-outline-primary">+ Add</a>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light"><tr><th>#</th><th>Hospital</th><th>Amount</th><th>Valid Until</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                        @forelse($inquiry->quotations as $q)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $q->hospital->name ?? '—' }}</td>
                            <td>{{ $q->currency }} {{ number_format($q->total_amount, 2) }}</td>
                            <td>{{ $q->valid_until ? $q->valid_until->format('d M Y') : '—' }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($q->status) }}</span></td>
                            <td>
                                <a href="{{ route('admin.inquiries.quotations.show', [$inquiry, $q]) }}" class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-muted text-center py-3">No quotations yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Notes Timeline --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Notes & Activity</div>
            <div class="card-body">
                @forelse($notes ?? [] as $note)
                <div class="d-flex gap-3 mb-3">
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:36px;height:36px;min-width:36px;font-size:.8rem;">
                        {{ strtoupper(substr($note->user->name ?? 'S', 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-semibold small">{{ $note->user->name ?? 'System' }} <span class="text-muted fw-normal">{{ $note->created_at->diffForHumans() }}</span></div>
                        <div>{{ $note->content }}</div>
                    </div>
                </div>
                @empty
                <p class="text-muted mb-3">No notes yet.</p>
                @endforelse

                <form method="POST" action="{{ route('admin.inquiries.add_note', $inquiry) }}" class="mt-3">
                    @csrf
                    <div class="mb-2">
                        <textarea name="content" class="form-control" rows="2" placeholder="Add a note..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Add Note</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Right column --}}
    <div class="col-lg-4">
        {{-- Status --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Update Status</div>
            <div class="card-body">
                <span class="badge {{ $inquiry->statusBadgeClass() }} mb-3">{{ ucfirst(str_replace('_',' ',$inquiry->status)) }}</span>
                <form method="POST" action="{{ route('admin.inquiries.update_status', $inquiry) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            @foreach(['new','reviewing','quoted','accepted','scheduled','in_progress','completed','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $inquiry->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>

        {{-- Assign --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Assign To</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.inquiries.assign', $inquiry) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <select name="assigned_to" class="form-select">
                            <option value="">Unassigned</option>
                            @foreach($caseManagers ?? [] as $cm)
                            <option value="{{ $cm->id }}" {{ $inquiry->assigned_to == $cm->id ? 'selected' : '' }}>{{ $cm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100">Assign</button>
                </form>
            </div>
        </div>

        {{-- Patient Info --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Patient</div>
            <div class="card-body">
                @php $patient = $inquiry->patientProfile; @endphp
                <div class="fw-semibold">{{ $patient?->user?->name ?? '—' }}</div>
                <div class="text-muted small">{{ $patient?->user?->email ?? '' }}</div>
                <div class="text-muted small mt-1">{{ $patient?->phone ?? '' }}</div>
                <div class="text-muted small">{{ $patient?->nationality ?? '' }}</div>
                @if($patient)
                <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-sm btn-outline-secondary mt-2">View Profile</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
