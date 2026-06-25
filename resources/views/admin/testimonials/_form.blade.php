<form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
    @csrf
    @if($testimonial->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Testimonial</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Patient Name</label>
                            <input type="text" name="patient_name" value="{{ old('patient_name', $testimonial->patient_name) }}" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Country</label>
                            <input type="text" name="country" value="{{ old('country', $testimonial->country) }}" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Treatment</label>
                            <input type="text" name="treatment" value="{{ old('treatment', $testimonial->treatment) }}" class="form-control" placeholder="e.g. Cardiac Bypass Surgery">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Hospital</label>
                            <select name="hospital_id" class="form-select">
                                <option value="">Select</option>
                                @foreach($hospitals as $h)
                                    <option value="{{ $h->id }}" {{ old('hospital_id', $testimonial->hospital_id) == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Rating (1-5)</label>
                            <select name="rating" class="form-select">
                                <option value="">Select</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Short Quote</label>
                        <input type="text" name="short_quote" value="{{ old('short_quote', $testimonial->short_quote) }}" class="form-control" placeholder="Brief quote shown on cards">
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Full Story</label>
                        <textarea name="full_story" class="form-control" rows="4" placeholder="Full patient story (optional)">{{ old('full_story', $testimonial->full_story) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Settings</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $testimonial->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="is_video" value="1" class="form-check-input" role="switch" {{ old('is_video', $testimonial->is_video) ? 'checked' : '' }}>
                        <label class="form-check-label">Is Video Testimonial</label>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Video URL</label>
                        <input type="url" name="video_url" value="{{ old('video_url', $testimonial->video_url) }}" class="form-control" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">{{ $testimonial->exists ? 'Update Testimonial' : 'Create Testimonial' }}</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
