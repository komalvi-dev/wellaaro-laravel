@extends('layouts.admin')
@section('title', 'Doctors')
@section('breadcrumb')
<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Doctors</li></ol></nav>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Doctors</h4>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Doctor</a>
</div>
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body py-2">
        <form class="row g-2 align-items-end" method="GET">
            <div class="col-md-4"><input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search doctors..."></div>
            <div class="col-md-2">
                <select name="published" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="1" {{ request('published')=='1'?'selected':'' }}>Published</option>
                    <option value="0" {{ request('published')=='0'?'selected':'' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="hospital_id" class="form-select form-select-sm">
                    <option value="">All Hospitals</option>
                    @foreach($hospitals as $hospital)
                    <option value="{{ $hospital->id }}" {{ request('hospital_id')==$hospital->id?'selected':'' }}>{{ $hospital->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><button class="btn btn-sm btn-outline-secondary w-100" type="submit">Filter</button></div>
            <div class="col-md-1"><a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-link">Clear</a></div>
        </form>
    </div>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Doctor</th><th>Designation</th><th>Experience</th><th>Status</th><th>Featured</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($doctor->photo_url)<img src="{{ $doctor->photo_url }}" class="rounded-circle" width="36" height="36" style="object-fit:cover;">@else<div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center" style="width:36px;height:36px;font-size:.75rem;"><i class="fas fa-user-md"></i></div>@endif
                            <div><div class="fw-semibold small">{{ $doctor->full_name }}</div><div class="text-muted" style="font-size:.75rem;">{{ $doctor->slug }}</div></div>
                        </div>
                    </td>
                    <td class="small">{{ $doctor->designation }}</td>
                    <td class="small">{{ $doctor->experience_years ? $doctor->experience_years . ' yrs' : '—' }}</td>
                    <td><span class="badge {{ $doctor->published ? 'bg-success' : 'bg-secondary' }}">{{ $doctor->published ? 'Published' : 'Draft' }}</span></td>
                    <td>@if($doctor->featured)<i class="bi bi-star-fill text-warning"></i>@endif</td>
                    <td>
                        <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-xs btn-outline-primary me-1"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-xs btn-outline-secondary me-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this doctor?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No doctors found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($doctors->hasPages())
    <div class="card-footer bg-white">{{ $doctors->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
