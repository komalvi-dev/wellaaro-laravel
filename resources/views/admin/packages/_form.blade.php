<form method="POST" action="{{ $package->exists ? route('admin.packages.update', $package) : route('admin.packages.store') }}">
    @csrf
    @if($package->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Package Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name', $package->name) }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Tagline</label>
                        <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $package->tagline) }}" placeholder="Short tagline...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Description</label>
                        <textarea name="description" class="form-control" rows="6">{{ old('description', $package->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Hospital</label>
                        <select name="hospital_id" class="form-select">
                            <option value="">Select hospital</option>
                            @foreach($hospitals as $h)
                                <option value="{{ $h->id }}" {{ old('hospital_id', $package->hospital_id) == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Duration (days)</label>
                        <input type="number" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" class="form-control" min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Price From (USD)</label>
                        <input type="number" name="price_usd_from" value="{{ old('price_usd_from', $package->price_usd_from) }}" class="form-control" min="0" step="100">
                    </div>
                    <hr>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $package->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="is_popular" value="1" class="form-check-input" role="switch" {{ old('is_popular', $package->is_popular) ? 'checked' : '' }}>
                        <label class="form-check-label">Popular</label>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">SEO</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $package->meta_title) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $package->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">{{ $package->exists ? 'Update Package' : 'Create Package' }}</button>
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
