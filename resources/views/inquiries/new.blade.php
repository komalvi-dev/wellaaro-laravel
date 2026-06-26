@extends('layouts.app')
@section('title', 'Get Free Medical Quote')
@section('content')

<div class="bg-primary py-4">
    <div class="container">
        <h1 class="text-white fw-bold mb-0">Get Your Free Treatment Quote</h1>
        <p class="text-white-75 mb-0">Fill in your details and receive quotes from top hospitals within 24 hours</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        {{-- Form --}}
        <div class="col-lg-8">
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('inquiries.store') }}" method="POST" id="inquiry-form">
                        @csrf

                        {{-- Step Indicators --}}
                        <div class="d-flex gap-2 mb-4 flex-wrap" id="step-indicators">
                            @php $labels = ['Personal Info', 'Treatment', 'Medical Details', 'Travel & Submit']; @endphp
                            @foreach($labels as $i => $label)
                                <div class="step-indicator d-flex align-items-center gap-2">
                                    <div class="step-number rounded-circle d-flex align-items-center justify-content-center fw-bold {{ $i === 0 ? 'bg-primary text-white' : 'bg-light text-muted' }}" style="width:32px;height:32px;font-size:14px;">
                                        {{ $i + 1 }}
                                    </div>
                                    <span class="small d-none d-md-inline {{ $i === 0 ? 'text-primary fw-semibold' : 'text-muted' }}">{{ $label }}</span>
                                    @if($i < 3)<i class="bi bi-chevron-right text-muted small mx-1"></i>@endif
                                </div>
                            @endforeach
                        </div>

                        {{-- Step 1: Personal Info --}}
                        <div class="form-step" id="step-1">
                            <h5 class="fw-bold mb-4"><i class="bi bi-person-fill me-2 text-primary"></i>Personal Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="Your first name" required>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Your last name" required>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="you@example.com" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Country of Residence</label>
                                    <select name="country_of_residence" id="quote-country-select" class="form-select" onchange="updateQuotePhoneCode(this.value)">
                                        <option value="">Select your country</option>
                                        @php
                                        $countriesList = [
                                            'Afghanistan'=>'AF','Albania'=>'AL','Algeria'=>'DZ','Argentina'=>'AR','Australia'=>'AU',
                                            'Austria'=>'AT','Azerbaijan'=>'AZ','Bahrain'=>'BH','Bangladesh'=>'BD','Belarus'=>'BY',
                                            'Belgium'=>'BE','Bolivia'=>'BO','Brazil'=>'BR','Bulgaria'=>'BG','Cambodia'=>'KH',
                                            'Canada'=>'CA','Chile'=>'CL','China'=>'CN','Colombia'=>'CO','Croatia'=>'HR',
                                            'Czech Republic'=>'CZ','Denmark'=>'DK','Ecuador'=>'EC','Egypt'=>'EG','Ethiopia'=>'ET',
                                            'Finland'=>'FI','France'=>'FR','Georgia'=>'GE','Germany'=>'DE','Ghana'=>'GH',
                                            'Greece'=>'GR','Hungary'=>'HU','India'=>'IN','Indonesia'=>'ID','Iran'=>'IR',
                                            'Iraq'=>'IQ','Ireland'=>'IE','Israel'=>'IL','Italy'=>'IT','Japan'=>'JP',
                                            'Jordan'=>'JO','Kazakhstan'=>'KZ','Kenya'=>'KE','Kuwait'=>'KW','Kyrgyzstan'=>'KG',
                                            'Lebanon'=>'LB','Libya'=>'LY','Malaysia'=>'MY','Maldives'=>'MV','Mexico'=>'MX',
                                            'Morocco'=>'MA','Myanmar'=>'MM','Nepal'=>'NP','Netherlands'=>'NL','New Zealand'=>'NZ',
                                            'Nigeria'=>'NG','Norway'=>'NO','Oman'=>'OM','Pakistan'=>'PK','Palestine'=>'PS',
                                            'Peru'=>'PE','Philippines'=>'PH','Poland'=>'PL','Portugal'=>'PT','Qatar'=>'QA',
                                            'Romania'=>'RO','Russia'=>'RU','Saudi Arabia'=>'SA','Serbia'=>'RS','Singapore'=>'SG',
                                            'South Africa'=>'ZA','South Korea'=>'KR','Spain'=>'ES','Sri Lanka'=>'LK','Sudan'=>'SD',
                                            'Sweden'=>'SE','Switzerland'=>'CH','Syria'=>'SY','Taiwan'=>'TW','Tajikistan'=>'TJ',
                                            'Tanzania'=>'TZ','Thailand'=>'TH','Tunisia'=>'TN','Turkey'=>'TR','Turkmenistan'=>'TM',
                                            'Uganda'=>'UG','Ukraine'=>'UA','United Arab Emirates'=>'AE','United Kingdom'=>'GB',
                                            'United States'=>'US','Uzbekistan'=>'UZ','Venezuela'=>'VE','Vietnam'=>'VN','Yemen'=>'YE','Zimbabwe'=>'ZW',
                                        ];
                                        @endphp
                                        @foreach($countriesList as $name => $code)
                                            <option value="{{ $name }}" {{ old('country_of_residence') == $name ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone / WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text fw-semibold" id="quote-phone-code" style="min-width:54px;justify-content:center;">+</span>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone / WhatsApp" required>
                                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Age</label>
                                    <input type="number" name="age" class="form-control" value="{{ old('age') }}" min="1" max="120">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Select</option>
                                        <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                                        <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                                        <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-primary px-5" onclick="nextStep(2)">
                                    Next: Treatment Details <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 2: Treatment --}}
                        <div class="form-step d-none" id="step-2">
                            <h5 class="fw-bold mb-4"><i class="bi bi-heart-pulse me-2 text-primary"></i>Treatment Details</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Treatment Category <span class="text-danger">*</span></label>
                                    <select name="specialty_id" id="specialty-select" class="form-select @error('specialty_id') is-invalid @enderror" required onchange="filterTreatments(this.value)">
                                        <option value="">Select Specialty</option>
                                        @foreach($specialties as $s)
                                            <option value="{{ $s->id }}" {{ old('specialty_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialty_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Specific Treatment</label>
                                    <select name="treatment_id" id="treatment-select" class="form-select">
                                        <option value="">Select treatment first</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">When do you plan to travel?</label>
                                    <select name="preferred_timeline" class="form-select">
                                        <option value="">Select Timeline</option>
                                        <option value="asap" {{ old('preferred_timeline')=='asap'?'selected':'' }}>As Soon As Possible</option>
                                        <option value="1_3_months" {{ old('preferred_timeline')=='1_3_months'?'selected':'' }}>1–3 Months</option>
                                        <option value="3_6_months" {{ old('preferred_timeline')=='3_6_months'?'selected':'' }}>3–6 Months</option>
                                        <option value="6_plus" {{ old('preferred_timeline')=='6_plus'?'selected':'' }}>6+ Months</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Budget Range (USD)</label>
                                    <select name="budget_range" class="form-select">
                                        <option value="">Select budget (optional)</option>
                                        <option value="0-5000" {{ old('budget_range')=='0-5000'?'selected':'' }}>Under $5,000</option>
                                        <option value="5000-10000" {{ old('budget_range')=='5000-10000'?'selected':'' }}>$5,000–$10,000</option>
                                        <option value="10000-25000" {{ old('budget_range')=='10000-25000'?'selected':'' }}>$10,000–$25,000</option>
                                        <option value="25000+" {{ old('budget_range')=='25000+'?'selected':'' }}>$25,000+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary px-4" onclick="prevStep(1)">
                                    <i class="bi bi-arrow-left me-1"></i> Back
                                </button>
                                <button type="button" class="btn btn-primary px-5" onclick="nextStep(3)">
                                    Next: Medical Details <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 3: Medical Details --}}
                        <div class="form-step d-none" id="step-3">
                            <h5 class="fw-bold mb-4"><i class="bi bi-file-medical me-2 text-primary"></i>Medical Information</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Describe your condition <span class="text-danger">*</span></label>
                                    <textarea name="condition_description" class="form-control @error('condition_description') is-invalid @enderror" rows="4" required placeholder="Please describe your current medical condition, symptoms, and any previous diagnoses...">{{ old('condition_description') }}</textarea>
                                    @error('condition_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Current Medications</label>
                                    <textarea name="current_medications" class="form-control" rows="2" placeholder="List any medications you are currently taking...">{{ old('current_medications') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Previous Treatments Attempted</label>
                                    <textarea name="previous_treatments" class="form-control" rows="2" placeholder="List any treatments or procedures already tried...">{{ old('previous_treatments') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Upload Medical Reports</label>
                                    <div class="border rounded-3 p-4 text-center bg-light" id="upload-dropzone">
                                        <input type="file" name="medical_reports[]" id="medical-reports-input" multiple style="position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;">
                                        <i class="bi bi-cloud-upload fs-1 text-muted d-block mb-2"></i>
                                        <label for="medical-reports-input" class="btn btn-outline-primary mb-2" style="cursor:pointer;">
                                            <i class="bi bi-upload me-2"></i>Choose Files
                                        </label>
                                        <p class="text-muted small mb-0">Any format accepted (PDF, JPG, PNG, DOCX&hellip;) &bull; Multiple files at once</p>
                                    </div>
                                    <div id="selected-files-list" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary px-4" onclick="prevStep(2)">
                                    <i class="bi bi-arrow-left me-1"></i> Back
                                </button>
                                <button type="button" class="btn btn-primary px-5" onclick="nextStep(4)">
                                    Next: Travel Details <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 4: Travel & Submit --}}
                        <div class="form-step d-none" id="step-4">
                            <h5 class="fw-bold mb-4"><i class="bi bi-airplane me-2 text-primary"></i>Travel & Preferences</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Number of Companions</label>
                                    <input type="number" name="companions_count" class="form-control" value="{{ old('companions_count', 0) }}" min="0" max="10">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Accommodation Preference</label>
                                    <select name="accommodation_pref" class="form-select">
                                        <option value="">Select preference</option>
                                        <option value="budget" {{ old('accommodation_pref')=='budget'?'selected':'' }}>Budget (3-star)</option>
                                        <option value="standard" {{ old('accommodation_pref')=='standard'?'selected':'' }}>Standard (4-star)</option>
                                        <option value="premium" {{ old('accommodation_pref')=='premium'?'selected':'' }}>Premium (5-star)</option>
                                        <option value="luxury" {{ old('accommodation_pref')=='luxury'?'selected':'' }}>Luxury</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold d-block mb-2">Services Required</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="needs_visa_assistance" value="1" id="visa" class="form-check-input" {{ old('needs_visa_assistance') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="visa"><i class="bi bi-passport me-1"></i>Visa Assistance</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="needs_airport_transfer" value="1" id="transfer" class="form-check-input" {{ old('needs_airport_transfer') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="transfer"><i class="bi bi-car-front me-1"></i>Airport Transfer</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="needs_interpreter" value="1" id="interpreter" class="form-check-input" {{ old('needs_interpreter') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="interpreter"><i class="bi bi-translate me-1"></i>Interpreter</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Additional Notes</label>
                                    <textarea name="additional_notes" class="form-control" rows="3" placeholder="Any other information or special requirements...">{{ old('additional_notes') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light rounded-3 p-3">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" name="whatsapp_opt_in" value="1" id="whatsapp_opt" class="form-check-input" {{ old('whatsapp_opt_in') ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="whatsapp_opt">
                                                <i class="bi bi-whatsapp text-success me-1"></i>Contact me via WhatsApp for faster updates
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="email_opt_in" value="1" id="email_opt" class="form-check-input" checked>
                                            <label class="form-check-label small" for="email_opt">
                                                <i class="bi bi-envelope me-1"></i>Send me health articles and treatment updates by email
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary px-4" onclick="prevStep(3)">
                                    <i class="bi bi-arrow-left me-1"></i> Back
                                </button>
                                <button type="submit" class="btn btn-success btn-lg px-5 fw-bold">Submit My Inquiry &rarr;</button>
                            </div>
                            <p class="text-muted small text-end mt-2 mb-0">
                                By submitting I agree to the <a href="{{ route('terms') }}" class="text-primary text-decoration-none">Terms of Use</a> and <a href="{{ route('privacy_policy') }}" class="text-primary text-decoration-none">Privacy Policy</a>.
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-shield-check me-2"></i>What Happens Next?</h6>
                    <ol class="small mb-0 ps-3">
                        <li class="mb-2">Our medical coordinator reviews your inquiry within 24 hours</li>
                        <li class="mb-2">We match you with the most suitable hospitals and doctors</li>
                        <li class="mb-2">You receive detailed cost estimates with full breakdown</li>
                        <li class="mb-2">We assist with travel planning once you're ready to proceed</li>
                    </ol>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Need Help?</h6>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-whatsapp fs-4 text-success"></i>
                        <div>
                            <div class="fw-semibold small">WhatsApp</div>
                            <div class="text-muted small">+91 72111 36620</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill fs-4 text-primary"></i>
                        <div>
                            <div class="fw-semibold small">Email</div>
                            <div class="text-muted small">support@wellaaro.com</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 bg-success bg-opacity-10 border-success-subtle">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-success mb-2"><i class="bi bi-check-circle me-2"></i>Patient-First Policy</h6>
                    <p class="small text-muted mb-0">We do not accept hospital commissions for referrals. Our recommendations remain independent and unbiased. We charge a transparent service fee for case management and patient support.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function nextStep(n) {
    document.querySelectorAll('.form-step').forEach(function(el) { el.classList.add('d-none'); });
    document.getElementById('step-' + n).classList.remove('d-none');
    updateStepIndicators(n);
    window.scrollTo({ top: 200, behavior: 'smooth' });
}
function prevStep(n) { nextStep(n); }

function updateStepIndicators(active) {
    document.querySelectorAll('.step-number').forEach(function(el, i) {
        var step = i + 1;
        if (step === active) {
            el.className = 'step-number rounded-circle d-flex align-items-center justify-content-center fw-bold bg-primary text-white';
        } else if (step < active) {
            el.className = 'step-number rounded-circle d-flex align-items-center justify-content-center fw-bold bg-success text-white';
        } else {
            el.className = 'step-number rounded-circle d-flex align-items-center justify-content-center fw-bold bg-light text-muted';
        }
    });
    document.querySelectorAll('.step-indicator span').forEach(function(el, i) {
        var step = i + 1;
        el.className = 'small d-none d-md-inline ' + (step === active ? 'text-primary fw-semibold' : 'text-muted');
    });
}

var allTreatments = @json($treatments->map(fn($t) => ['value' => $t->id, 'text' => $t->name, 'specialty' => $t->specialty_id]));

function filterTreatments(specialtyId) {
    var select = document.getElementById('treatment-select');
    while (select.options.length > 1) select.remove(1);
    select.value = '';
    if (!specialtyId) { select.options[0].textContent = 'Select treatment first'; return; }
    var matching = allTreatments.filter(function(t) { return t.specialty == specialtyId; });
    if (matching.length === 0) matching = allTreatments;
    matching.forEach(function(t) {
        var opt = document.createElement('option');
        opt.value = t.value;
        opt.textContent = t.text;
        select.appendChild(opt);
    });
    select.options[0].textContent = matching.length ? 'Select specific treatment (optional)' : 'All treatments shown';
}

var PHONE_CODES = {
    'Afghanistan':'+93','Albania':'+355','Algeria':'+213','Argentina':'+54','Australia':'+61',
    'Austria':'+43','Azerbaijan':'+994','Bahrain':'+973','Bangladesh':'+880','Belarus':'+375',
    'Belgium':'+32','Bolivia':'+591','Brazil':'+55','Bulgaria':'+359','Cambodia':'+855',
    'Canada':'+1','Chile':'+56','China':'+86','Colombia':'+57','Croatia':'+385',
    'Czech Republic':'+420','Denmark':'+45','Ecuador':'+593','Egypt':'+20','Ethiopia':'+251',
    'Finland':'+358','France':'+33','Georgia':'+995','Germany':'+49','Ghana':'+233',
    'Greece':'+30','Hungary':'+36','India':'+91','Indonesia':'+62','Iran':'+98',
    'Iraq':'+964','Ireland':'+353','Israel':'+972','Italy':'+39','Japan':'+81',
    'Jordan':'+962','Kazakhstan':'+7','Kenya':'+254','Kuwait':'+965','Kyrgyzstan':'+996',
    'Lebanon':'+961','Libya':'+218','Malaysia':'+60','Maldives':'+960','Mexico':'+52',
    'Morocco':'+212','Myanmar':'+95','Nepal':'+977','Netherlands':'+31','New Zealand':'+64',
    'Nigeria':'+234','Norway':'+47','Oman':'+968','Pakistan':'+92','Palestine':'+970',
    'Peru':'+51','Philippines':'+63','Poland':'+48','Portugal':'+351','Qatar':'+974',
    'Romania':'+40','Russia':'+7','Saudi Arabia':'+966','Serbia':'+381','Singapore':'+65',
    'South Africa':'+27','South Korea':'+82','Spain':'+34','Sri Lanka':'+94','Sudan':'+249',
    'Sweden':'+46','Switzerland':'+41','Syria':'+963','Taiwan':'+886','Tajikistan':'+992',
    'Tanzania':'+255','Thailand':'+66','Tunisia':'+216','Turkey':'+90','Turkmenistan':'+993',
    'Uganda':'+256','Ukraine':'+380','United Arab Emirates':'+971','United Kingdom':'+44',
    'United States':'+1','Uzbekistan':'+998','Venezuela':'+58','Vietnam':'+84','Yemen':'+967','Zimbabwe':'+263'
};

function updateQuotePhoneCode(country) {
    var badge = document.getElementById('quote-phone-code');
    if (badge) badge.textContent = PHONE_CODES[country] || '+';
}

var fileAccumulator = (typeof DataTransfer !== 'undefined') ? new DataTransfer() : null;

document.addEventListener('DOMContentLoaded', function() {
    var sel = document.getElementById('quote-country-select');
    if (sel && sel.value) updateQuotePhoneCode(sel.value);

    var specialtySelect = document.getElementById('specialty-select');
    if (specialtySelect && specialtySelect.value) {
        filterTreatments(specialtySelect.value);
    }

    var fileInput = document.getElementById('medical-reports-input');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (fileAccumulator) {
                var existing = new Set();
                for (var i = 0; i < fileAccumulator.files.length; i++) {
                    existing.add(fileAccumulator.files[i].name + '|' + fileAccumulator.files[i].size);
                }
                for (var j = 0; j < fileInput.files.length; j++) {
                    var key = fileInput.files[j].name + '|' + fileInput.files[j].size;
                    if (!existing.has(key)) fileAccumulator.items.add(fileInput.files[j]);
                }
                fileInput.files = fileAccumulator.files;
            }
            updateFileList();
        });
    }
});

function formatFileSize(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / 1048576).toFixed(1) + ' MB';
}

function fileIcon(name) {
    var ext = name.split('.').pop().toLowerCase();
    if (ext === 'pdf') return 'bi-file-earmark-pdf text-danger';
    if (['jpg','jpeg','png','heic','webp'].includes(ext)) return 'bi-file-earmark-image text-primary';
    if (['doc','docx'].includes(ext)) return 'bi-file-earmark-word text-primary';
    return 'bi-file-earmark-medical text-secondary';
}

function updateFileList() {
    var input = document.getElementById('medical-reports-input');
    var container = document.getElementById('selected-files-list');
    if (!input || !container) return;
    var files = input.files;
    if (!files || files.length === 0) { container.innerHTML = ''; return; }
    var html = '<div class="border rounded-3 p-3 bg-white">';
    html += '<div class="d-flex align-items-center justify-content-between mb-2">';
    html += '<span class="small fw-semibold text-success"><i class="bi bi-check-circle me-1"></i>' + files.length + ' file' + (files.length > 1 ? 's' : '') + ' selected</span>';
    html += '<button type="button" class="btn btn-link btn-sm text-danger p-0 text-decoration-none" onclick="clearAllFiles()">Clear all</button>';
    html += '</div><ul class="list-unstyled mb-0">';
    for (var i = 0; i < files.length; i++) {
        html += '<li class="d-flex align-items-center justify-content-between py-1' + (i < files.length - 1 ? ' border-bottom' : '') + '">';
        html += '<span class="d-flex align-items-center gap-2 text-truncate me-2" style="min-width:0;"><i class="bi ' + fileIcon(files[i].name) + ' flex-shrink-0"></i>';
        html += '<span class="small text-truncate">' + files[i].name + '</span></span>';
        html += '<span class="d-flex align-items-center gap-2 flex-shrink-0"><span class="badge bg-light text-muted">' + formatFileSize(files[i].size) + '</span>';
        html += '<button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="removeFile(' + i + ')"><i class="bi bi-x-lg"></i></button></span></li>';
    }
    html += '</ul></div>';
    container.innerHTML = html;
}

function removeFile(index) {
    var input = document.getElementById('medical-reports-input');
    var dt = new DataTransfer();
    for (var i = 0; i < input.files.length; i++) {
        if (i !== index) dt.items.add(input.files[i]);
    }
    input.files = dt.files;
    fileAccumulator = dt;
    updateFileList();
}

function clearAllFiles() {
    var input = document.getElementById('medical-reports-input');
    input.value = '';
    fileAccumulator = (typeof DataTransfer !== 'undefined') ? new DataTransfer() : null;
    updateFileList();
}
</script>
@endpush
