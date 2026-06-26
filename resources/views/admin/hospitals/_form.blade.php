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
        <select name="country_id" id="hospital_country_id" class="form-select"
                data-cities-url="{{ route('admin.hospitals.cities_by_country') }}">
            <option value="">Select country...</option>
            @foreach($countries ?? [] as $c)
            <option value="{{ $c->id }}" {{ old('country_id', $hospital->country_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">City</label>
        <select name="city_id" id="hospital_city_id" class="form-select">
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
    <div class="col-md-6">
        <label class="form-label fw-semibold">Latitude</label>
        <input type="number" name="latitude" value="{{ old('latitude', $hospital->latitude ?? '') }}" class="form-control @error('latitude') is-invalid @enderror" step="any" min="-90" max="90" placeholder="e.g. 28.6139">
        @error('latitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Longitude</label>
        <input type="number" name="longitude" value="{{ old('longitude', $hospital->longitude ?? '') }}" class="form-control @error('longitude') is-invalid @enderror" step="any" min="-180" max="180" placeholder="e.g. 77.2090">
        @error('longitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
    @if(!empty($specialties) && $specialties->count())
    <div class="col-12">
        <label class="form-label fw-semibold">Specialties</label>
        @php
            $selectedSpecialtyIds = old('specialty_ids', isset($hospital) ? $hospital->specialties->pluck('id')->toArray() : []);
        @endphp
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 border rounded p-3">
            @foreach($specialties as $specialty)
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="specialty_ids[]"
                           id="spec_{{ $specialty->id }}"
                           value="{{ $specialty->id }}"
                           {{ in_array($specialty->id, $selectedSpecialtyIds) ? 'checked' : '' }}>
                    <label class="form-check-label" for="spec_{{ $specialty->id }}">
                        {{ $specialty->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-text">Select all specialties offered by this hospital.</div>
    </div>
    @endif
    <div class="col-md-6">
        <label class="form-label fw-semibold">Logo</label>
        @if(!empty($hospital->logo_url ?? null))
            <div class="mb-1"><img src="{{ $hospital->logo_url }}" alt="Logo" style="max-height:60px;max-width:120px;object-fit:contain;border:1px solid #dee2e6;border-radius:4px;padding:2px;"></div>
        @endif
        <input type="file" name="logo" accept="image/*" class="form-control @error('logo') is-invalid @enderror">
        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <div class="form-text">Upload an image file, or enter a URL below (upload takes priority).</div>
        <input type="url" name="logo_url" value="{{ old('logo_url', $hospital->logo_url ?? '') }}" class="form-control mt-1" placeholder="https://...">
        @error('logo_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Featured Image</label>
        @if(!empty($hospital->featured_image_url ?? null))
            <div class="mb-1"><img src="{{ $hospital->featured_image_url }}" alt="Featured Image" style="max-height:60px;max-width:120px;object-fit:contain;border:1px solid #dee2e6;border-radius:4px;padding:2px;"></div>
        @endif
        <input type="file" name="featured_image" accept="image/*" class="form-control @error('featured_image') is-invalid @enderror">
        @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <div class="form-text">Upload an image file, or enter a URL below (upload takes priority).</div>
        <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $hospital->featured_image_url ?? '') }}" class="form-control mt-1" placeholder="https://...">
        @error('featured_image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Position</label>
        <input type="number" name="position" value="{{ old('position', $hospital->position ?? 99) }}" class="form-control" min="0">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">About</label>
        <textarea name="about" class="form-control @error('about') is-invalid @enderror" rows="5">{{ old('about', $hospital->about ?? '') }}</textarea>
        @error('about')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- SEO --}}
    <div class="col-12">
        <hr class="my-1">
        <p class="fw-semibold mb-3">SEO</p>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Meta Title</label>
        <input type="text" name="meta_title" value="{{ old('meta_title', $hospital->meta_title ?? '') }}" class="form-control @error('meta_title') is-invalid @enderror">
        @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Meta Description</label>
        <input type="text" name="meta_description" value="{{ old('meta_description', $hospital->meta_description ?? '') }}" class="form-control @error('meta_description') is-invalid @enderror">
        @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Meta Keywords</label>
        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $hospital->meta_keywords ?? '') }}" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="comma-separated keywords">
        @error('meta_keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold d-block mb-2">Settings</label>
        <div class="d-flex gap-3 flex-wrap">
            <div class="form-check form-switch">
                <input type="hidden" name="published" value="0">
                <input class="form-check-input" type="checkbox" name="published" id="published_hosp" value="1" {{ old('published', $hospital->published ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="published_hosp">Published</label>
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="featured" value="0">
                <input class="form-check-input" type="checkbox" name="featured" id="featured_hosp" value="1" {{ old('featured', $hospital->featured ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="featured_hosp">Featured</label>
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="is_jci_accredited" value="0">
                <input class="form-check-input" type="checkbox" name="is_jci_accredited" id="jci" value="1" {{ old('is_jci_accredited', $hospital->is_jci_accredited ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="jci">JCI Accredited</label>
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="is_nabh_accredited" value="0">
                <input class="form-check-input" type="checkbox" name="is_nabh_accredited" id="nabh" value="1" {{ old('is_nabh_accredited', $hospital->is_nabh_accredited ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="nabh">NABH Accredited</label>
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="is_partner" value="0">
                <input class="form-check-input" type="checkbox" name="is_partner" id="partner" value="1" {{ old('is_partner', $hospital->is_partner ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="partner">Partner Hospital</label>
            </div>
            <div class="form-check form-switch">
                <input type="hidden" name="international_patient_desk" value="0">
                <input class="form-check-input" type="checkbox" name="international_patient_desk" id="intl_desk" value="1" {{ old('international_patient_desk', $hospital->international_patient_desk ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="intl_desk">International Patient Desk</label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const countrySelect = document.getElementById('hospital_country_id');
    const citySelect    = document.getElementById('hospital_city_id');

    if (!countrySelect || !citySelect) return;

    const citiesUrl     = countrySelect.dataset.citiesUrl;
    const initialCityId = citySelect.value; // preserve current selection on page load

    countrySelect.addEventListener('change', function () {
        const countryId = this.value;

        // Clear city dropdown immediately
        citySelect.innerHTML = '<option value="">Select city...</option>';

        if (!countryId) return;

        fetch(citiesUrl + '?country_id=' + encodeURIComponent(countryId), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function (res) { return res.json(); })
        .then(function (cities) {
            cities.forEach(function (city) {
                const opt = document.createElement('option');
                opt.value       = city.id;
                opt.textContent = city.name;
                citySelect.appendChild(opt);
            });
        })
        .catch(function () {
            // silently fail — dropdown stays empty
        });
    });
})();
</script>
@endpush
