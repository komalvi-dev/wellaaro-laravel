@extends('layouts.admin')
@section('title', 'Conditions')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Conditions</h1>
    <a href="{{ route('admin.conditions.create') }}" class="btn btn-primary">Add Condition</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Name</th>
                    <th>ICD-10</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conditions as $condition)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 fw-medium small">{{ $condition->name }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">{{ $condition->slug }}</p>
                    </td>
                    <td class="small text-muted">{{ $condition->icd10_code ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $condition->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $condition->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.conditions.edit', $condition) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.conditions.destroy', $condition) }}" onsubmit="return confirm('Delete {{ $condition->name }}?')">
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
    <div class="card-footer bg-white py-3">{{ $conditions->links() }}</div>
</div>
@endsection
