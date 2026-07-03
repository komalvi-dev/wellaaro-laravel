@extends('layouts.admin')
@section('title', 'Treatments')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Treatments</h1>
    <a href="{{ route('admin.treatments.create') }}" class="btn btn-primary">Add Treatment</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <form action="{{ route('admin.treatments.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search..." style="max-width:250px;">
            <select name="specialty_id" class="form-select form-select-sm" style="max-width:200px;">
                <option value="">All Specialties</option>
                @foreach($specialties as $s)
                    <option value="{{ $s->id }}" {{ request('specialty_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-sm btn-outline-secondary">Filter</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Treatment</th>
                    <th>Specialty</th>
                    <th>Cost India</th>
                    <th>Cost USA</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($treatments as $t)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 fw-medium small">{{ $t->name }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">{{ $t->slug }}</p>
                    </td>
                    <td class="small text-muted">{{ $t->specialty?->name ?? '—' }}</td>
                    <td class="small text-success">{{ $t->cost_india_min ? '$' . number_format($t->cost_india_min) : '—' }}</td>
                    <td class="small text-muted">{{ $t->cost_usa ? '$' . number_format($t->cost_usa) : '—' }}</td>
                    <td>
                        <span class="badge {{ $t->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $t->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.treatments.edit', $t) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.treatments.destroy', $t) }}" onsubmit="return confirm('Delete {{ $t->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">{{ $treatments->links() }}</div>
</div>
@endsection
