@extends('layouts.admin')
@section('title', 'Edit Blog Tag')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.blog-tags.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">Edit: {{ $tag->name }}</h1>
</div>
<div class="row"><div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('admin.blog-tags.update', $tag) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name', $tag->name) }}" class="form-control" required maxlength="100">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Tag</button>
                    <a href="{{ route('admin.blog-tags.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection
