<form method="POST" action="{{ $treatment->exists ? route('admin.treatments.update', $treatment) : route('admin.treatments.store') }}" enctype="multipart/form-data">
    @csrf
    @if($treatment->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Treatment Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name', $treatment->name) }}" class="form-control" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Specialty</label>
                            <select name="specialty_id" class="form-select">
                                <option value="">Select specialty</option>
                                @foreach($specialties as $s)
                                    <option value="{{ $s->id }}" {{ old('specialty_id', $treatment->specialty_id) == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Parent Treatment</label>
                            <select name="parent_id" class="form-select">
                                <option value="">None (top-level)</option>
                                @foreach($parents as $p)
                                    <option value="{{ $p->id }}" {{ old('parent_id', $treatment->parent_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $treatment->short_description) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Description</label>
                        <textarea name="description" class="form-control" rows="6">{{ old('description', $treatment->description) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Procedure Details</label>
                        <textarea name="procedure_details" class="form-control" rows="4">{{ old('procedure_details', $treatment->procedure_details) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white fw-medium">Cost Comparison</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">India Cost Min (USD)</label>
                            <input type="number" name="cost_india_min" value="{{ old('cost_india_min', $treatment->cost_india_min) }}" class="form-control" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">India Cost Max (USD)</label>
                            <input type="number" name="cost_india_max" value="{{ old('cost_india_max', $treatment->cost_india_max) }}" class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">USA Cost (USD)</label>
                            <input type="number" name="cost_usa" value="{{ old('cost_usa', $treatment->cost_usa) }}" class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">UK Cost (USD)</label>
                            <input type="number" name="cost_uk" value="{{ old('cost_uk', $treatment->cost_uk) }}" class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Savings %</label>
                            <input type="number" name="cost_savings_percent" value="{{ old('cost_savings_percent', $treatment->cost_savings_percent) }}" class="form-control" min="0" max="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Featured Image</div>
                <div class="card-body">
                    @if(!empty($treatment->featured_image_url))
                        <div class="mb-2"><img src="{{ $treatment->featured_image_url }}" alt="{{ $treatment->name }}" style="max-height:100px;max-width:100%;object-fit:cover;border:1px solid #dee2e6;border-radius:4px;padding:2px;"></div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*" class="form-control @error('featured_image') is-invalid @enderror">
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Upload an image, or enter a URL below (upload takes priority). Shown on the public treatment page.</div>
                    <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $treatment->featured_image_url) }}" class="form-control mt-1" placeholder="https://example.com/image.jpg">
                    @error('featured_image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">Publishing</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="published" value="0">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $treatment->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" value="1" class="form-check-input" role="switch" {{ old('featured', $treatment->featured) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Position</label>
                        <input type="number" name="position" value="{{ old('position', $treatment->position ?? 99) }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">Clinical Info</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Recovery Time</label>
                        <input type="text" name="recovery_time" value="{{ old('recovery_time', $treatment->recovery_time) }}" class="form-control" placeholder="e.g. 4-6 weeks">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Hospital Stay</label>
                        <input type="text" name="hospital_stay" value="{{ old('hospital_stay', $treatment->hospital_stay) }}" class="form-control" placeholder="e.g. 3-5 days">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Success Rate</label>
                        <input type="text" name="success_rate" value="{{ old('success_rate', $treatment->success_rate) }}" class="form-control" placeholder="e.g. 95%">
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">SEO</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $treatment->meta_title) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $treatment->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">{{ $treatment->exists ? 'Update Treatment' : 'Create Treatment' }}</button>
                <a href="{{ route('admin.treatments.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
