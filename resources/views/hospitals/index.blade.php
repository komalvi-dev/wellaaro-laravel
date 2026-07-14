@extends('layouts.app')
@section('title', 'Top Hospitals in India')
@section('content')

<section class="py-4 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Hospitals') }}</li>
            </ol>
        </nav>
        <x-breadcrumb-schema :items="[
            ['name' => __('Home'), 'url' => route('home')],
            ['name' => __('Hospitals')],
        ]" />
        @if(false)
        <h1 class="h2 fw-bold">{{ __('Find the Right Hospital for You') }}</h1>
        <p class="text-muted">{{ __("Independent recommendations based on your medical needs — not fixed partnerships.") }}</p>
        @endif
    </div>
</section>

@if(false)
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Filters sidebar -->
            <div class="col-lg-3">
                <form method="GET" action="{{ route('hospitals.index') }}" id="filter-form" class="card border-0 shadow-sm p-3 sticky-top" style="top:80px;">
                    <h6 class="fw-bold mb-3">{{ __('Filter Hospitals') }}</h6>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">{{ __('Search') }}</label>
                        <input type="text" name="q" class="form-control form-control-sm" value="{{ request('q') }}" placeholder="{{ __('Hospital name...') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">{{ __('Specialty') }}</label>
                        <select name="specialty_id" class="form-select form-select-sm">
                            <option value="">{{ __('All Specialties') }}</option>
                            @foreach($specialties ?? [] as $s)
                                <option value="{{ $s->id }}" {{ request('specialty_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">{{ __('City') }}</label>
                        <select name="city_id" class="form-select form-select-sm">
                            <option value="">{{ __('All Cities') }}</option>
                            @foreach($cities ?? [] as $c)
                                <option value="{{ $c->id }}" {{ request('city_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jci" value="1" class="form-check-input" id="filter_jci" {{ request('jci') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="filter_jci">{{ __('JCI Accredited') }}</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="nabh" value="1" class="form-check-input" id="filter_nabh" {{ request('nabh') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="filter_nabh">{{ __('NABH Accredited') }}</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">{{ __('Apply Filters') }}</button>
                        <a href="{{ route('hospitals.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('Clear') }}</a>
                    </div>
                </form>
            </div>

            <!-- Hospital listing -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0 text-muted"><strong>{{ $hospitals->total() }}</strong> {{ __('hospitals found') }}</p>
                    <div class="d-flex align-items-center gap-2">
                        <label class="small text-muted">{{ __('Sort by:') }}</label>
                        <select name="sort" class="form-select form-select-sm" style="width:auto;" onchange="this.form.submit()" form="filter-form">
                            <option value="featured" {{ request('sort') == 'featured' || !request('sort') ? 'selected' : '' }}>{{ __('Featured') }}</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Rating') }}</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('Name') }}</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($hospitals as $hospital)
                    <div class="col-md-4">
                        <a href="{{ route('hospitals.show', $hospital->slug) }}" class="text-decoration-none">
                            <div class="card card-hover h-100 border-0 shadow-sm">
                                @if($hospital->featured_image_url)
                                    <img src="{{ $hospital->featured_image_url }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $hospital->name }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:160px;"><i class="bi bi-hospital fs-1 text-secondary"></i></div>
                                @endif
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">{{ $hospital->name }}</h6>
                                    <p class="text-muted small mb-2">{{ $hospital->city?->name }}, {{ $hospital->country?->name }}</p>
                                    <div class="d-flex flex-wrap gap-1">
                                        @if($hospital->is_jci_accredited)<span class="badge bg-success-subtle text-success small">{{ __('JCI Accredited') }}</span>@endif
                                        @if($hospital->is_nabh_accredited)<span class="badge bg-primary-subtle text-primary small">{{ __('NABH') }}</span>@endif
                                        @if($hospital->bed_count)<span class="badge bg-light text-muted small">{{ $hospital->bed_count }} {{ __('Beds') }}</span>@endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">{{ __('No hospitals found.') }}</div>
                    @endforelse
                </div>

                <div class="mt-5">
                    {{ $hospitals->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">{{ __('How We Select Hospitals for You') }}</h2>
            <p class="text-muted mb-3">{{ __('Independent. Transparent. Patient-First.') }}</p>
            <p class="mx-auto" style="max-width:720px;">{{ __("Every recommendation is made in the patient's best interest. At Wellaaro, we do not recommend hospitals based on commissions or exclusive partnerships. Instead, every hospital recommendation is carefully evaluated according to the patient's medical condition, treatment goals, budget, travel preferences, and quality standards.") }}</p>
            <p class="fw-semibold mb-0">{{ __('Our objective is simple: help every patient find the right hospital — not just a hospital.') }}</p>
        </div>

        <h3 class="fw-bold text-center mb-4">{{ __('Our Hospital Selection Criteria') }}</h3>
        <div class="row g-4 mb-5">
            @foreach([
                ['icon' => 'bi-heart-pulse', 'title' => 'Medical Expertise', 'desc' => 'We assess whether the hospital has experienced specialists and dedicated departments for your specific condition — including Cardiac Surgery, Orthopaedics & Joint Replacement, Spine Surgery, Neurosurgery, Urology, Oncology, Organ Transplant, IVF and Dental Care. The hospital must demonstrate consistent experience in treating similar cases.'],
                ['icon' => 'bi-patch-check-fill', 'title' => 'International Accreditation', 'desc' => 'Preference is given to hospitals holding recognised quality certifications such as JCI Accreditation, NABH Accreditation and NABL Certified Laboratories, indicating internationally recognised quality and safety standards.'],
                ['icon' => 'bi-mortarboard-fill', 'title' => 'Doctor Experience', 'desc' => "We evaluate years of clinical experience, super-speciality expertise, surgical volume, complex case management, academic contributions and international training where applicable — to select doctors most suitable for the patient's medical needs."],
                ['icon' => 'bi-graph-up-arrow', 'title' => 'Treatment Success & Clinical Outcomes', 'desc' => 'Whenever available, we review success rates, infection control measures, patient safety protocols, ICU facilities, post-operative care and rehabilitation services.'],
                ['icon' => 'bi-cpu-fill', 'title' => 'Technology & Infrastructure', 'desc' => 'Hospitals equipped with modern medical technology are generally preferred — including Robotic Surgery, Hybrid Operating Theatres, Advanced Cath Labs, 3 Tesla MRI, PET CT, Image Guided Surgery and Digital ICU Monitoring.'],
                ['icon' => 'bi-currency-dollar', 'title' => 'Transparent Treatment Cost', 'desc' => 'Cost recommendations are based on treatment complexity, expected hospital stay, implant requirements, ICU needs, medication and diagnostic investigations. Patients receive estimated treatment costs before making any decision whenever possible.'],
                ['icon' => 'bi-wallet2', 'title' => 'Patient Budget', 'desc' => 'Not every patient requires the most expensive hospital. Recommendations are customised across budget-friendly, mid-range and premium hospitals, to provide the best possible care within the patient\'s financial comfort.'],
                ['icon' => 'bi-airplane-fill', 'title' => 'International Patient Services', 'desc' => 'We also consider hospitals that offer visa assistance, airport pickup, language interpreters, international patient coordinators, accommodation support and currency assistance, to improve the overall treatment journey.'],
                ['icon' => 'bi-geo-alt-fill', 'title' => 'Location Preference', 'desc' => 'Recommendations may consider city preference, climate, airport connectivity, family accommodation, local transportation and follow-up convenience.'],
                ['icon' => 'bi-shield-check', 'title' => 'Ethical Medical Practice', 'desc' => 'We prioritise hospitals known for ethical treatment recommendations, evidence-based medical care, transparent communication, patient safety and respect for patient rights.'],
            ] as $i => $criterion)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi {{ $criterion['icon'] }} text-primary fs-4"></i>
                        <span class="badge bg-primary-subtle text-primary rounded-pill">{{ $i + 1 }}</span>
                    </div>
                    <h6 class="fw-bold mb-2">{{ __($criterion['title']) }}</h6>
                    <p class="text-muted small mb-0">{{ __($criterion['desc']) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <h5 class="fw-bold mb-2">{{ __('Our Promise') }}</h5>
                    <p class="mb-2">{{ __('We believe every patient deserves unbiased guidance. Our recommendations are based on medical suitability — not financial incentives.') }}</p>
                    <p class="mb-0">{{ __('If multiple hospitals are appropriate for your treatment, we will explain the differences so you can make an informed decision.') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <h5 class="fw-bold mb-2">{{ __('Important Note') }}</h5>
                    <p class="mb-2">{{ __('Hospital recommendations may change depending on your diagnosis, medical reports, doctor\'s opinion, treatment urgency, budget and availability of specialists.') }}</p>
                    <p class="mb-0">{{ __('For this reason, every recommendation is personalised rather than generated from a fixed hospital list.') }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-4 p-4 p-md-5 mt-5" style="background: linear-gradient(135deg, #1a6bcc 0%, #123f80 100%);">
            <div class="text-center mb-4">
                <i class="bi bi-shield-fill-check text-white" style="font-size:2rem;"></i>
                <h4 class="fw-bold text-white mt-2 mb-0">{{ __('Why Patients Trust Wellaaro') }}</h4>
            </div>
            <div class="row g-3">
                @foreach([
                    ['icon' => 'bi-compass', 'text' => 'Independent hospital recommendations'],
                    ['icon' => 'bi-heart', 'text' => 'Patient-first approach'],
                    ['icon' => 'bi-eye', 'text' => 'Transparent selection process'],
                    ['icon' => 'bi-link-45deg', 'text' => 'No exclusive hospital tie-ups'],
                    ['icon' => 'bi-sliders', 'text' => 'Personalised treatment options'],
                    ['icon' => 'bi-columns-gap', 'text' => 'Multiple hospital comparisons'],
                    ['icon' => 'bi-gem', 'text' => 'Focus on quality, safety and value'],
                    ['icon' => 'bi-signpost-2', 'text' => 'Guidance from first enquiry until return home'],
                ] as $point)
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex flex-column align-items-center text-center gap-2 h-100 p-3 rounded-3" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15);">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:44px;height:44px;background:rgba(255,255,255,0.15);">
                            <i class="bi {{ $point['icon'] }} text-white fs-5"></i>
                        </div>
                        <span class="text-white small fw-medium">{{ __($point['text']) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
