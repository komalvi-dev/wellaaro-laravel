@extends('layouts.admin')
@section('title', 'Blog Posts')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Blog Posts</h1>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">New Post</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 fw-medium small">{{ Str::limit($post->title, 60) }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">{{ $post->slug }}</p>
                    </td>
                    <td class="small text-muted">{{ $post->category?->name ?? '—' }}</td>
                    <td class="small">{{ $post->author_name ?? $post->author?->email ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $post->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $post->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="small text-muted">{{ $post->published_at?->format('M d, Y') ?? '—' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
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
    <div class="card-footer bg-white py-3">{{ $posts->links() }}</div>
</div>
@endsection
