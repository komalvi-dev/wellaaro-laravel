<form method="POST" action="{{ $destination->exists ? route('admin.destinations.update', $destination) : route('admin.destinations.store') }}">
    @csrf
    @if($destination->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Destination Details</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Name</label>
                            <input type="text" name="name" value="{{ old('name', $destination->name) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Country</label>
                            <select name="country_id" class="form-select">
                                <option value="">Select country</option>
                                @foreach($countries as $c)
                                    <option value="{{ $c->id }}" {{ old('country_id', $destination->country_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Description</label>
                        <textarea name="description" class="form-control" rows="6">{{ old('description', $destination->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Settings</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $destination->slug) }}" class="form-control" placeholder="auto-generated if blank">
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $destination->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">SEO</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $destination->meta_title) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $destination->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">{{ $destination->exists ? 'Update Destination' : 'Create Destination' }}</button>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
