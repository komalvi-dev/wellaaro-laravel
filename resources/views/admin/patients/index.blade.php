@extends('layouts.admin')
@section('title', 'Patients')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Patients</h4>
</div>
<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2">
            <div class="col-md-4"><input type="text" name="q" class="form-control" placeholder="Search by name, email..." value="{{ request('q') }}"></div>
            <div class="col-md-2"><button type="submit" class="btn btn-secondary w-100">Search</button></div>
            <div class="col-md-1"><a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary w-100">Reset</a></div>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr><th>Name</th><th>Email</th><th>Nationality</th><th>Phone</th><th>Inquiries</th><th>Joined</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->user->name ?? $patient->full_name }}</td>
                        <td>{{ $patient->user->email ?? '—' }}</td>
                        <td>{{ $patient->nationality ?? '—' }}</td>
                        <td>{{ $patient->phone ?? '—' }}</td>
                        <td>{{ $patient->inquiries_count ?? 0 }}</td>
                        <td>{{ $patient->created_at->format('d M Y') }}</td>
                        <td><a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No patients found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($patients->hasPages())
    <div class="card-footer bg-white">{{ $patients->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
