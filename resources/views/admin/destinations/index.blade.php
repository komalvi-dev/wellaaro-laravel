@extends('layouts.admin')
@section('title', 'Destinations')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Destinations</h1>
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">New Destination</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Name</th>
                    <th>Country</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($destinations as $dest)
                <tr>
                    <td class="ps-4 fw-medium small">{{ $dest->name }}</td>
                    <td class="small">{{ $dest->country?->name }}</td>
                    <td class="small text-muted">{{ $dest->slug }}</td>
                    <td>
                        <span class="badge {{ $dest->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $dest->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.destinations.edit', $dest) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.destinations.destroy', $dest) }}" onsubmit="return confirm('Delete this destination?')">
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
    <div class="card-footer bg-white py-3">{{ $destinations->links() }}</div>
</div>
@endsection
