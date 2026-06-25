@extends('layouts.admin')
@section('title', 'SEO Redirects')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">SEO Redirects</h1>
    <a href="{{ route('admin.seo-redirects.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Add Redirect</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size:0.88rem;">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">From Path</th>
                    <th>To Path</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($redirects as $item)
                <tr>
                    <td class="ps-4"><code class="small">{{ $item->from_path }}</code></td>
                    <td><code class="small">{{ $item->to_path }}</code></td>
                    <td><span class="badge bg-secondary-subtle text-secondary">{{ $item->redirect_type }}</span></td>
                    <td>
                        @if($item->is_active)
                            <span class="badge bg-success-subtle text-success">Active</span>
                        @else
                            <span class="badge bg-secondary-subtle text-muted">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.seo-redirects.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.seo-redirects.destroy', $item) }}" onsubmit="return confirm('Delete this redirect?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-5">No redirects found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">{{ $redirects->links() }}</div>
</div>
@endsection
