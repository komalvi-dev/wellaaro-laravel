@extends('layouts.admin')
@section('title', 'Specialties')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Specialties</h4>
    <a href="{{ route('admin.specialties.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Specialty</a>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light"><tr><th>Image</th><th>Name</th><th>Slug</th><th>Featured</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($specialties as $item)
                    <tr>
                        <td>
                            @if($item->featured_image_url)
                                <img src="{{ $item->featured_image_url }}" alt="{{ $item->name }}" style="width:48px;height:48px;object-fit:cover;border-radius:4px;">
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->name }}</td>
                        <td class="text-muted small">{{ $item->slug }}</td>
                        <td>@if($item->featured)<span class="badge bg-success">Yes</span>@else<span class="badge bg-secondary">No</span>@endif</td>
                        <td>
                            <a href="{{ route('admin.specialties.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.specialties.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No specialties found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($specialties->hasPages())
    <div class="card-footer bg-white">{{ $specialties->links() }}</div>
    @endif
</div>
@endsection
