@extends('layouts.admin')
@section('title', 'Appointments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Appointments</h4>
</div>
<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach(['scheduled','confirmed','completed','cancelled','no_show'] as $s)
                    <option value="{{ $s }}" {{ request('status')===$s ? 'selected':'' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><label class="form-label small mb-0">From</label><input type="date" name="from" class="form-control" value="{{ request('from') }}"></div>
            <div class="col-md-2"><label class="form-label small mb-0">To</label><input type="date" name="to" class="form-control" value="{{ request('to') }}"></div>
            <div class="col-md-2"><br><button type="submit" class="btn btn-secondary w-100">Filter</button></div>
            <div class="col-md-1"><br><a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary w-100">Reset</a></div>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr><th>Patient</th><th>Doctor</th><th>Hospital</th><th>Treatment</th><th>Date</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($appointments as $apt)
                    <tr>
                        <td>{{ $apt->patientProfile?->user?->name ?? '—' }}</td>
                        <td>{{ $apt->doctor?->full_name ?? '—' }}</td>
                        <td>{{ $apt->hospital->name ?? '—' }}</td>
                        <td>{{ $apt->treatment->name ?? '—' }}</td>
                        <td>{{ $apt->appointment_date ? $apt->appointment_date->format('d M Y') : '—' }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_',' ',$apt->status)) }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.appointments.show', $apt) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.appointments.edit', $apt) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No appointments found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($appointments->hasPages())
    <div class="card-footer bg-white">{{ $appointments->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
