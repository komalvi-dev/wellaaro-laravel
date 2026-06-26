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
                    {{-- featured_image_url: plain URL string — canonical Laravel strategy; no file upload / ActiveStorage --}}
                    <div class="mb-3">
                        <label class="form-label fw-medium">Featured Image URL</label>
                        <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $package->featured_image_url) }}" class="form-control" placeholder="https://…" maxlength="500">
                        @if($package->featured_image_url)
                            <div class="mt-2">
                                <img src="{{ $package->featured_image_url }}" alt="Featured image preview" class="img-fluid rounded" style="max-height:160px;">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Treatments</label>
                        @php
                            $selectedTreatments = old('treatment_ids', $package->exists ? $package->treatments->pluck('id')->toArray() : []);
                        @endphp
                        <select name="treatment_ids[]" class="form-select" multiple size="6">
                            @foreach($treatments as $t)
                                <option value="{{ $t->id }}" {{ in_array($t->id, $selectedTreatments) ? 'selected' : '' }}>{{ $t->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Hold Ctrl / Cmd to select multiple treatments.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Specialty</label>
                        <select name="specialty_id" class="form-select">
                            <option value="">Select specialty</option>
                            @foreach($specialties as $s)
                                <option value="{{ $s->id }}" {{ old('specialty_id', $package->specialty_id) == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Destination</label>
                        <select name="destination_id" class="form-select">
                            <option value="">Select destination</option>
                            @foreach($destinations as $d)
                                <option value="{{ $d->id }}" {{ old('destination_id', $package->destination_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <label class="form-label fw-medium">Package Type</label>
                        <select name="package_type" class="form-select">
                            <option value="">Select type</option>
                            @foreach(['standard', 'premium', 'vip', 'budget'] as $type)
                                <option value="{{ $type }}" {{ old('package_type', $package->package_type) === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Duration Min (days)</label>
                        <input type="number" name="duration_days_min" value="{{ old('duration_days_min', $package->duration_days_min) }}" class="form-control" min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Duration Max (days)</label>
                        <input type="number" name="duration_days_max" value="{{ old('duration_days_max', $package->duration_days_max) }}" class="form-control" min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Price From (USD)</label>
                        <input type="number" name="price_usd_from" value="{{ old('price_usd_from', $package->price_usd_from) }}" class="form-control" min="0" step="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Price Note</label>
                        <input type="text" name="price_note" value="{{ old('price_note', $package->price_note) }}" class="form-control" placeholder="e.g. Starting from, includes accommodation">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Position</label>
                        <input type="number" name="position" value="{{ old('position', $package->position ?? 0) }}" class="form-control" min="0">
                    </div>
                    <hr>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="published" value="0">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $package->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" value="1" class="form-check-input" role="switch" {{ old('featured', $package->featured) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
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
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $package->meta_keywords) }}" class="form-control" placeholder="keyword1, keyword2, keyword3">
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
