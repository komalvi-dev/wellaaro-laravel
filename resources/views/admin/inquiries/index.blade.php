@extends('layouts.admin')
@section('title', 'Inquiries')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Inquiries</h4>
    <a href="{{ route('admin.inquiries.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> New Inquiry</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="q" class="form-control" placeholder="Search ref, patient..." value="{{ request('q') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach(\App\Models\Inquiry::STATUSES as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="from" class="form-control" placeholder="From" value="{{ request('from') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="to" class="form-control" placeholder="To" value="{{ request('to') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ref #</th>
                        <th>Patient</th>
                        <th>Phone</th>
                        <th>Specialty</th>
                        <th>Treatment</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                    <tr>
                        <td><a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-decoration-none fw-semibold">{{ $inquiry->reference_number }}</a></td>
                        <td>{{ $inquiry->patient_name }}</td>
                        <td>{{ $inquiry->patient_phone ?? '—' }}</td>
                        <td>{{ $inquiry->specialty->name ?? '—' }}</td>
                        <td>{{ $inquiry->treatment->name ?? '—' }}</td>
                        <td><span class="badge {{ $inquiry->statusBadgeClass() }}">{{ ucfirst(str_replace('_',' ',$inquiry->status)) }}</span></td>
                        <td>{{ $inquiry->assignedTo->name ?? '—' }}</td>
                        <td>{{ $inquiry->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.inquiries.edit', $inquiry) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No inquiries found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($inquiries->hasPages())
    <div class="card-footer bg-white">
        {{ $inquiries->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection
