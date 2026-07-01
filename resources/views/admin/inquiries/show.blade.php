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
                    <div class="col-sm-6"><dt class="text-muted small">Country</dt><dd>{{ $inquiry->country_of_residence ?: $inquiry->patientProfile?->country_of_residence ?: '—' }}</dd></div>
                    <div class="col-sm-3"><dt class="text-muted small">Age</dt><dd>{{ $inquiry->age ?? '—' }}</dd></div>
                    <div class="col-sm-3"><dt class="text-muted small">Gender</dt><dd>{{ $inquiry->gender ? ucfirst($inquiry->gender) : '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Specialty</dt><dd>{{ $inquiry->specialty->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Treatment</dt><dd>{{ $inquiry->treatment->name ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Destination</dt><dd>{{ $inquiry->preferred_destination ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Budget</dt><dd>{{ $inquiry->budget_range ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Timeline</dt><dd>{{ [
                        'asap' => 'As Soon As Possible',
                        '1_3_months' => '1-3 Months',
                        '3_6_months' => '3-6 Months',
                        '6_plus' => '6+ Months',
                    ][$inquiry->preferred_timeline] ?? '—' }}</dd></div>
                    <div class="col-12"><dt class="text-muted small">Describe Your Condition</dt><dd>{{ $inquiry->condition_description ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Current Medications</dt><dd>{{ $inquiry->current_medications ?? '—' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Previous Treatments Attempted</dt><dd>{{ $inquiry->previous_treatments ?? '—' }}</dd></div>
                    <div class="col-12"><dt class="text-muted small">Additional Notes</dt><dd>{{ $inquiry->additional_notes ?? '—' }}</dd></div>
                </div>
            </div>
        </div>

        {{-- Uploaded Medical Reports --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Uploaded Medical Reports</div>
            <div class="card-body">
                @forelse($documents ?? [] as $document)
                <div class="d-flex align-items-center justify-content-between {{ !$loop->last ? 'border-bottom pb-2 mb-2' : '' }}">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-file-medical text-muted"></i>
                        <span>{{ $document->file_name ?? $document->title }}</span>
                    </div>
                    <a href="{{ $document->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                </div>
                @empty
                <p class="text-muted mb-0">No medical reports uploaded.</p>
                @endforelse
            </div>
        </div>

        {{-- Travel & Preferences --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Travel &amp; Preferences</div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-sm-6"><dt class="text-muted small">Number of Companions</dt><dd>{{ $inquiry->companions_count ?? '0' }}</dd></div>
                    <div class="col-sm-6"><dt class="text-muted small">Accommodation Preference</dt><dd>{{ $inquiry->accommodation_pref ? ucfirst($inquiry->accommodation_pref) : '—' }}</dd></div>
                </div>
                <dt class="text-muted small mb-2">Services Required</dt>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @if($inquiry->needs_visa_assistance)<span class="badge bg-info-subtle text-info-emphasis">Visa Assistance</span>@endif
                    @if($inquiry->needs_airport_transfer)<span class="badge bg-info-subtle text-info-emphasis">Airport Transfer</span>@endif
                    @if($inquiry->needs_interpreter)<span class="badge bg-info-subtle text-info-emphasis">Interpreter</span>@endif
                    @if(!$inquiry->needs_visa_assistance && !$inquiry->needs_airport_transfer && !$inquiry->needs_interpreter)
                    <span class="text-muted small">None requested</span>
                    @endif
                </div>
                <dt class="text-muted small mb-2">Contact Preferences</dt>
                <div class="d-flex flex-column gap-1 small">
                    <div><i class="fas {{ $inquiry->whatsapp_opt_in ? 'fa-check text-success' : 'fa-times text-muted' }} me-2"></i>Contact me via WhatsApp for faster updates</div>
                    <div><i class="fas {{ $inquiry->email_opt_in ? 'fa-check text-success' : 'fa-times text-muted' }} me-2"></i>Send me health articles and treatment updates by email</div>
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
                            <td>{{ $q->currency }} {{ number_format($q->total_cost, 2) }}</td>
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
                    <div class="row g-2 mb-2">
                        <div class="col-sm-6">
                            <select name="note_type" class="form-select form-select-sm">
                                <option value="general">General</option>
                                <option value="call">Call</option>
                                <option value="email">Email</option>
                                <option value="follow_up">Follow Up</option>
                            </select>
                        </div>
                        <div class="col-sm-6 d-flex align-items-center">
                            <input type="hidden" name="is_internal" value="0">
                            <div class="form-check">
                                <input type="checkbox" name="is_internal" value="1" id="is_internal" class="form-check-input" checked>
                                <label for="is_internal" class="form-check-label small">Internal note</label>
                            </div>
                        </div>
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
                            @foreach(\App\Models\Inquiry::STATUSES as $s)
                            <option value="{{ $s }}" {{ $inquiry->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status_reason" class="form-label small text-muted">Reason <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="text" id="status_reason" name="reason" class="form-control" placeholder="e.g. Patient requested reschedule">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="notify_patient" value="0">
                        <input type="checkbox" id="notify_patient" name="notify_patient" value="1" class="form-check-input">
                        <label for="notify_patient" class="form-check-label small">Notify patient by email</label>
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
                        <select name="user_id" class="form-select">
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
                <div class="fw-semibold">{{ $inquiry->patient_name }}</div>
                <div class="text-muted small">{{ $inquiry->patient_email ?? '' }}</div>
                <div class="text-muted small mt-1"><i class="fas fa-phone fa-xs me-1"></i>{{ $inquiry->patient_phone ?? '—' }}</div>
                <div class="text-muted small">{{ $inquiry->nationality ?? $patient?->nationality ?? '' }}</div>
                @if($patient)
                <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-sm btn-outline-secondary mt-2">View Profile</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
