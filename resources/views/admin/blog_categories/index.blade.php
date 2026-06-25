@extends('layouts.admin')
@section('title', 'Blog Categories')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Blog Categories</h1>
    <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">New Category</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Name</th>
                    <th>Slug</th>
                    <th>Posts</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td class="ps-4 fw-medium small">{{ $cat->name }}</td>
                    <td class="small text-muted">{{ $cat->slug }}</td>
                    <td class="small">{{ $cat->posts_count }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.blog-categories.edit', $cat) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.blog-categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
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
    <div class="card-footer bg-white py-3">{{ $categories->links() }}</div>
</div>
@endsection
