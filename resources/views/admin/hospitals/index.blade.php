@extends('layouts.admin')
@section('title', 'Hospitals')
@section('breadcrumb')
<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Hospitals</li></ol></nav>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Hospitals</h4>
    <a href="{{ route('admin.hospitals.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Hospital</a>
</div>
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body py-2">
        <form class="row g-2 align-items-end" method="GET">
            <div class="col-md-4"><input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search hospitals..."></div>
            <div class="col-md-3">
                <select name="published" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="1" {{ request('published')=='1'?'selected':'' }}>Published</option>
                    <option value="0" {{ request('published')=='0'?'selected':'' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-2"><button class="btn btn-sm btn-outline-secondary w-100" type="submit">Filter</button></div>
            <div class="col-md-1"><a href="{{ route('admin.hospitals.index') }}" class="btn btn-sm btn-link">Clear</a></div>
        </form>
    </div>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Hospital</th><th>City</th><th>Type</th><th>Beds</th><th>Status</th><th>Featured</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($hospitals as $hospital)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($hospital->logo_url)<img src="{{ $hospital->logo_url }}" class="rounded" width="36" height="36" style="object-fit:contain;">@endif
                            <div><div class="fw-semibold small">{{ $hospital->name }}</div><div class="text-muted" style="font-size:.75rem;">{{ $hospital->slug }}</div></div>
                        </div>
                    </td>
                    <td class="small">{{ $hospital->city?->name ?? '—' }}</td>
                    <td class="small">{{ $hospital->tier ? ucfirst($hospital->tier) : '—' }}</td>
                    <td class="small">{{ $hospital->bed_count ?? '—' }}</td>
                    <td><span class="badge {{ $hospital->published ? 'bg-success' : 'bg-secondary' }}">{{ $hospital->published ? 'Published' : 'Draft' }}</span></td>
                    <td>@if($hospital->featured)<i class="bi bi-star-fill text-warning"></i>@endif</td>
                    <td>
                        <a href="{{ route('admin.hospitals.show', $hospital->id) }}" class="btn btn-xs btn-outline-primary me-1" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.hospitals.edit', $hospital->id) }}" class="btn btn-xs btn-outline-secondary me-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this hospital?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No hospitals found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($hospitals->hasPages())
    <div class="card-footer bg-white">{{ $hospitals->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
