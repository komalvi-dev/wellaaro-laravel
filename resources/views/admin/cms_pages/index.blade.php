@extends('layouts.admin')
@section('title', 'CMS Pages')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">CMS Pages</h1>
    <a href="{{ route('admin.cms-pages.create') }}" class="btn btn-primary">New Page</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Title</th>
                    <th>Slug</th>
                    <th>Template</th>
                    <th>Updated</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td class="ps-4 fw-medium small">{{ $page->title }}</td>
                    <td class="small text-muted">{{ $page->slug }}</td>
                    <td><span class="badge bg-secondary-subtle text-secondary">{{ ucfirst($page->template ?? 'default') }}</span></td>
                    <td class="small text-muted">{{ $page->updated_at->format('M d, Y') }}</td>
                    <td>
                        <span class="badge {{ $page->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $page->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.cms-pages.edit', $page) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.cms-pages.destroy', $page) }}" onsubmit="return confirm('Delete this page?')">
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
    <div class="card-footer bg-white py-3">{{ $pages->links() }}</div>
</div>
@endsection
