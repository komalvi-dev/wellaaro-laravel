@extends('layouts.admin')
@section('title', 'Add Specialty')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.specialties.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Specialties</a>
        <h4 class="mb-0 fw-bold mt-1">Add Specialty</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.specialties.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Name <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
                <div class="col-md-6"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generated if empty"></div>
                <div class="col-md-4"><label class="form-label">Position</label><input type="number" name="position" class="form-control" value="{{ old('position', 99) }}"></div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked':'' }}>
                    <label class="form-check-label">Featured</label></div>
                </div>
                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea></div>
                <div class="col-12">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*" class="form-control @error('featured_image') is-invalid @enderror">
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Upload an image file, or enter a URL below (upload takes priority). Shown on the public specialties page.</div>
                    <input type="url" name="featured_image_url" value="{{ old('featured_image_url') }}" class="form-control mt-1" placeholder="https://example.com/image.jpg">
                    @error('featured_image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
