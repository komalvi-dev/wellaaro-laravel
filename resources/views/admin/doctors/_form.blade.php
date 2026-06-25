<div class="row g-3">
    <div class="col-md-2">
        <label class="form-label fw-semibold">Title</label>
        <select name="title" class="form-select">
            @foreach(['Dr.','Prof.','Mr.','Mrs.','Ms.'] as $t)
            <option value="{{ $t }}" {{ old('title', $doctor->title ?? 'Dr.') == $t ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
        <input type="text" name="first_name" value="{{ old('first_name', $doctor->first_name ?? '') }}" class="form-control @error('first_name') is-invalid @enderror" required>
        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-5">
        <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
        <input type="text" name="last_name" value="{{ old('last_name', $doctor->last_name ?? '') }}" class="form-control @error('last_name') is-invalid @enderror" required>
        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Designation</label>
        <input type="text" name="designation" value="{{ old('designation', $doctor->designation ?? '') }}" class="form-control" placeholder="e.g. Senior Cardiologist">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Experience (Years)</label>
        <input type="number" name="experience_years" value="{{ old('experience_years', $doctor->experience_years ?? '') }}" class="form-control" min="0" max="60">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Consultation Fee (USD)</label>
        <input type="number" name="consultation_fee_usd" value="{{ old('consultation_fee_usd', $doctor->consultation_fee_usd ?? '') }}" class="form-control" min="0" step="1">
    </div>
    <div class="col-md-12">
        <label class="form-label fw-semibold">Qualifications</label>
        <input type="text" name="qualifications" value="{{ old('qualifications', $doctor->qualifications ?? '') }}" class="form-control" placeholder="e.g. MBBS, MD (Cardiology), FRCS">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">About</label>
        <textarea name="about" class="form-control" rows="5">{{ old('about', $doctor->about ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Hospital</label>
        <select name="hospital_id" class="form-select">
            <option value="">Select hospital...</option>
            @foreach($hospitals ?? [] as $h)
            <option value="{{ $h->id }}" {{ old('hospital_id', $doctor->hospital_id ?? '') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Photo URL</label>
        <input type="url" name="photo_url" value="{{ old('photo_url', $doctor->photo_url ?? '') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Position</label>
        <input type="number" name="position" value="{{ old('position', $doctor->position ?? 99) }}" class="form-control" min="0">
    </div>
    <div class="col-12">
        <div class="d-flex gap-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="published" id="published_doc" value="1" {{ old('published', $doctor->published ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="published_doc">Published</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="featured" id="featured_doc" value="1" {{ old('featured', $doctor->featured ?? false) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="featured_doc">Featured Doctor</label>
            </div>
        </div>
    </div>
</div>
