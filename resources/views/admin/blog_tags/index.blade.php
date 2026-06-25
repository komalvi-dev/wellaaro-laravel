@extends('layouts.admin')
@section('title', 'Blog Tags')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Blog Tags</h1>
</div>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-medium">Add New Tag</div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
                @endif
                <form method="POST" action="{{ route('admin.blog-tags.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Tag</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-medium">All Tags ({{ $tags->total() }})</div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                    <span class="badge bg-secondary-subtle text-secondary d-flex align-items-center gap-1" style="font-size:0.85rem;padding:6px 10px;">
                        {{ $tag->name }}
                        <form method="POST" action="{{ route('admin.blog-tags.destroy', $tag) }}" onsubmit="return confirm('Delete tag \'{{ $tag->name }}\'?')" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-link p-0 text-danger" style="font-size:0.75rem;line-height:1;"><i class="bi bi-x"></i></button>
                        </form>
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
