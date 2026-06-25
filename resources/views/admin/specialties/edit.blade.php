@extends('layouts.admin')
@section('title', 'Edit Specialty')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.specialties.index') }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Specialties</a>
        <h4 class="mb-0 fw-bold mt-1">Edit Specialty: {{ $specialty->name }}</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.specialties.update', $specialty) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $specialty->name) }}" required></div>
                <div class="col-md-6"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $specialty->slug) }}"></div>
                <div class="col-md-4"><label class="form-label">Icon Class</label><input type="text" name="icon_class" class="form-control" value="{{ old('icon_class', $specialty->icon_class) }}" placeholder="bi-heart-pulse"></div>
                <div class="col-md-4"><label class="form-label">Position</label><input type="number" name="position" class="form-control" value="{{ old('position', $specialty->position) }}"></div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="featured" value="1" {{ old('featured', $specialty->featured) ? 'checked':'' }}>
                    <label class="form-check-label">Featured</label></div>
                </div>
                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $specialty->description) }}</textarea></div>
                <div class="col-12"><label class="form-label">Replace Image</label><input type="file" name="image" class="form-control" accept="image/*"></div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.specialties.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
