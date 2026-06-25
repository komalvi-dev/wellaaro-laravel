<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Hospital Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $hospital->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Tier</label>
        <select name="tier" class="form-select">
            <option value="">Select...</option>
            @foreach(['standard','premium','elite'] as $t)
            <option value="{{ $t }}" {{ old('tier', $hospital->tier ?? '') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Country</label>
        <select name="country_id" class="form-select">
            <option value="">Select country...</option>
            @foreach($countries ?? [] as $c)
            <option value="{{ $c->id }}" {{ old('country_id', $hospital->country_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">City</label>
        <select name="city_id" class="form-select">
            <option value="">Select city...</option>
            @foreach($cities ?? [] as $c)
            <option value="{{ $c->id }}" {{ old('city_id', $hospital->city_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Address</label>
        <textarea name="address" class="form-control" rows="2">{{ old('address', $hospital->address ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $hospital->phone ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $hospital->email ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Website</label>
        <input type="url" name="website" value="{{ old('website', $hospital->website ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Established Year</label>
        <input type="number" name="established_year" value="{{ old('established_year', $hospital->established_year ?? '') }}" class="form-control" min="1800" max="{{ date('Y') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Bed Count</label>
        <input type="number" name="bed_count" value="{{ old('bed_count', $hospital->bed_count ?? '') }}" class="form-control" min="0">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">OT Count</label>
        <input type="number" name="ot_count" value="{{ old('ot_count', $hospital->ot_count ?? '') }}" class="form-control" min="0">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tagline</label>
        <input type="text" name="tagline" value="{{ old('tagline', $hospital->tagline ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Annual Patients</label>
        <input type="number" name="annual_patients" value="{{ old('annual_patients', $hospital->annual_patients ?? '') }}" class="form-control" min="0">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control" rows="5">{{ old('description', $hospital->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Logo URL</label>
        <input type="url" name="logo_url" value="{{ old('logo_url', $hospital->logo_url ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Featured Image URL</label>
        <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $hospital->featured_image_url ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Position</label>
        <input type="number" name="position" value="{{ old('position', $hospital->position ?? 99) }}" class="form-control" min="0">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold d-block mb-2">Settings</label>
        <div class="d-flex gap-3 flex-wrap">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="published" id="published_hosp" value="1" {{ old('published', $hospital->published ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="published_hosp">Published</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="featured" id="featured_hosp" value="1" {{ old('featured', $hospital->featured ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="featured_hosp">Featured</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_jci_accredited" id="jci" value="1" {{ old('is_jci_accredited', $hospital->is_jci_accredited ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="jci">JCI Accredited</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_nabh_accredited" id="nabh" value="1" {{ old('is_nabh_accredited', $hospital->is_nabh_accredited ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="nabh">NABH Accredited</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_partner" id="partner" value="1" {{ old('is_partner', $hospital->is_partner ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="partner">Partner Hospital</label>
            </div>
        </div>
    </div>
</div>
