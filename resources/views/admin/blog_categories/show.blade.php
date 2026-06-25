@extends('layouts.admin')
@section('title', $category->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $category->name }}</h1>
    <a href="{{ route('admin.blog-categories.edit', $category) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <dl>
            <dt class="small text-muted">Slug</dt><dd>{{ $category->slug }}</dd>
            @if($category->description)<dt class="small text-muted">Description</dt><dd>{{ $category->description }}</dd>@endif
        </dl>
    </div>
</div>
@endsection
