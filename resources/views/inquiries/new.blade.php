@extends('layouts.app')
@section('title', 'Get a Free Medical Quote')
@section('content')
<div class="hero-section text-white py-5">
    <div class="container text-center">
        <h1 class="h2 fw-bold mb-2">Get a Free Medical Consultation</h1>
        <p class="text-white-75">Fill in the form below and our medical coordinators will contact you within 24 hours</p>
    </div>
</div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('inquiries.store') }}" method="POST">
                @csrf
                {{-- Personal Info --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-semibold"><i class="fas fa-user me-2 text-primary"></i>Personal Information</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country of Residence</label>
                                <input type="text" name="country_of_residence" class="form-control" value="{{ old('country_of_residence') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" value="{{ old('age') }}" min="1" max="120">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="">Select</option>
                                    <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                                    <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                                    <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Medical Info --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-semibold"><i class="fas fa-heartbeat me-2 text-primary"></i>Medical Information</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Medical Specialty <span class="text-danger">*</span></label>
                                <select name="specialty_id" id="specialty_id" class="form-select @error('specialty_id') is-invalid @enderror" required>
                                    <option value="">Select Specialty</option>
                                    @foreach($specialties as $s)
                                        <option value="{{ $s->id }}" {{ old('specialty_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                                @error('specialty_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Treatment Needed</label>
                                <select name="treatment_id" id="treatment_id" class="form-select">
                                    <option value="">Select Treatment</option>
                                    @foreach($treatments as $t)
                                        <option value="{{ $t->id }}" {{ old('treatment_id')==$t->id?'selected':'' }} data-specialty="{{ $t->specialty_id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Describe Your Condition <span class="text-danger">*</span></label>
                                <textarea name="condition_description" class="form-control @error('condition_description') is-invalid @enderror" rows="4" placeholder="Please describe your medical condition, symptoms, and any previous treatments..." required>{{ old('condition_description') }}</textarea>
                                @error('condition_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Current Medications</label>
                                <textarea name="current_medications" class="form-control" rows="2" placeholder="List any medications you are currently taking">{{ old('current_medications') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Previous Treatments</label>
                                <textarea name="previous_treatments" class="form-control" rows="2" placeholder="Describe any previous treatments or surgeries">{{ old('previous_treatments') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preferences --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-semibold"><i class="fas fa-cog me-2 text-primary"></i>Treatment Preferences</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Preferred Destination</label>
                                <input type="text" name="preferred_destination" class="form-control" value="{{ old('preferred_destination') }}" placeholder="e.g. Delhi, Mumbai, Chennai">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preferred Timeline</label>
                                <select name="preferred_timeline" class="form-select">
                                    <option value="">Select Timeline</option>
                                    <option value="asap" {{ old('preferred_timeline')=='asap'?'selected':'' }}>As Soon As Possible</option>
                                    <option value="1_3_months" {{ old('preferred_timeline')=='1_3_months'?'selected':'' }}>1-3 Months</option>
                                    <option value="3_6_months" {{ old('preferred_timeline')=='3_6_months'?'selected':'' }}>3-6 Months</option>
                                    <option value="6_plus" {{ old('preferred_timeline')=='6_plus'?'selected':'' }}>6+ Months</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Budget Range (USD)</label>
                                <select name="budget_range" class="form-select">
                                    <option value="">Select Budget</option>
                                    <option value="under_5k" {{ old('budget_range')=='under_5k'?'selected':'' }}>Under $5,000</option>
                                    <option value="5k_10k" {{ old('budget_range')=='5k_10k'?'selected':'' }}>$5,000 - $10,000</option>
                                    <option value="10k_20k" {{ old('budget_range')=='10k_20k'?'selected':'' }}>$10,000 - $20,000</option>
                                    <option value="20k_plus" {{ old('budget_range')=='20k_plus'?'selected':'' }}>$20,000+</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Accommodation Preference</label>
                                <select name="accommodation_pref" class="form-select">
                                    <option value="">No Preference</option>
                                    <option value="budget" {{ old('accommodation_pref')=='budget'?'selected':'' }}>Budget</option>
                                    <option value="standard" {{ old('accommodation_pref')=='standard'?'selected':'' }}>Standard</option>
                                    <option value="premium" {{ old('accommodation_pref')=='premium'?'selected':'' }}>Premium</option>
                                    <option value="luxury" {{ old('accommodation_pref')=='luxury'?'selected':'' }}>Luxury</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Number of Companions</label>
                                <input type="number" name="companions_count" class="form-control" value="{{ old('companions_count', 0) }}" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Needs --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-semibold"><i class="fas fa-concierge-bell me-2 text-primary"></i>Additional Services</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="needs_visa_assistance" value="1" id="visa" class="form-check-input" {{ old('needs_visa_assistance') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="visa"><i class="fas fa-passport me-1 text-muted"></i>Visa Assistance</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="needs_airport_transfer" value="1" id="transfer" class="form-check-input" {{ old('needs_airport_transfer') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="transfer"><i class="fas fa-taxi me-1 text-muted"></i>Airport Transfer</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="needs_interpreter" value="1" id="interpreter" class="form-check-input" {{ old('needs_interpreter') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="interpreter"><i class="fas fa-language me-1 text-muted"></i>Interpreter</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Additional Notes</label>
                            <textarea name="additional_notes" class="form-control" rows="3" placeholder="Any other information you'd like to share">{{ old('additional_notes') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Contact Preferences --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-semibold"><i class="fas fa-bell me-2 text-primary"></i>Contact Preferences</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">WhatsApp Number (optional)</label>
                                <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number') }}" placeholder="+1234567890">
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-3">
                            <div class="form-check">
                                <input type="checkbox" name="whatsapp_opt_in" value="1" id="whatsapp_opt" class="form-check-input" {{ old('whatsapp_opt_in') ? 'checked' : '' }}>
                                <label class="form-check-label" for="whatsapp_opt">Contact me via WhatsApp</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="email_opt_in" value="1" id="email_opt" class="form-check-input" {{ old('email_opt_in', '1') ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_opt">Contact me via Email</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Submit Inquiry — Get Free Quote
                    </button>
                </div>
                <p class="text-muted text-center small mt-3">Your information is secure and will only be used to assist with your medical journey.</p>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('specialty_id').addEventListener('change', function() {
    var specialtyId = this.value;
    var treatmentSelect = document.getElementById('treatment_id');
    Array.from(treatmentSelect.options).forEach(function(opt) {
        if (opt.value === '') { opt.style.display = ''; return; }
        opt.style.display = (!specialtyId || opt.dataset.specialty === specialtyId) ? '' : 'none';
    });
    treatmentSelect.value = '';
});
</script>
@endpush
