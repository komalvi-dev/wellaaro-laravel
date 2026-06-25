@extends('layouts.admin')
@section('title', 'New Blog Category')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">New Blog Category</h1>
</div>
<div class="row"><div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('admin.blog-categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="auto-generated">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection
