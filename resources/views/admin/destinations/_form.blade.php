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
                            <select name="country_id" class="form-select" required>
                                <option value="">Select country</option>
                                @foreach($countries as $c)
                                    <option value="{{ $c->id }}" {{ old('country_id', $destination->country_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $destination->tagline) }}" class="form-control" placeholder="Short tagline...">
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Description</label>
                        <textarea name="description" class="form-control" rows="6">{{ old('description', $destination->description) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Why Choose</label>
                        <textarea name="why_choose" class="form-control" rows="4" placeholder="Reasons to choose this destination...">{{ old('why_choose', $destination->why_choose) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Cost Savings Text</label>
                        <textarea name="cost_savings_text" class="form-control" rows="3" placeholder="Describe cost savings for patients...">{{ old('cost_savings_text', $destination->cost_savings_text) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Visa Info</label>
                        <textarea name="visa_info" class="form-control" rows="3" placeholder="Visa requirements and notes...">{{ old('visa_info', $destination->visa_info) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Best Time to Visit</label>
                        <input type="text" name="best_time_to_visit" value="{{ old('best_time_to_visit', $destination->best_time_to_visit) }}" class="form-control" placeholder="e.g. October – March">
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Climate</label>
                        <input type="text" name="climate" value="{{ old('climate', $destination->climate) }}" class="form-control" placeholder="e.g. Tropical, Temperate...">
                    </div>
                    {{-- featured_image_url: plain URL string — canonical Laravel strategy; no file upload / ActiveStorage --}}
                    <div class="mt-3">
                        <label class="form-label fw-medium">Featured Image URL</label>
                        <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $destination->featured_image_url) }}" class="form-control" placeholder="https://…" maxlength="500">
                        @if($destination->featured_image_url)
                            <div class="mt-2">
                                <img src="{{ $destination->featured_image_url }}" alt="Featured image preview" class="img-fluid rounded" style="max-height:160px;">
                            </div>
                        @endif
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
                    <div class="mb-3">
                        <label class="form-label fw-medium">Position</label>
                        <input type="number" name="position" value="{{ old('position', $destination->position) }}" class="form-control" min="0" placeholder="Sort order (0 = default)">
                    </div>
                    <div class="form-check form-switch">
                        {{-- hidden 0 ensures the field is submitted as false when checkbox is unchecked --}}
                        <input type="hidden" name="published" value="0">
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
