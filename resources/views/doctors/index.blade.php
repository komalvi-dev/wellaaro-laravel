@extends('layouts.app')
@section('title', 'Find Top Doctors')
@section('content')
<section class="py-4 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Doctors') }}</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold">{{ __('How We Select the Right Doctor') }}</h1>
        <p class="text-muted">{{ __('Every recommendation is tailored to your medical needs.') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm p-3 sticky-top" style="top:80px;">
                    <h6 class="fw-bold mb-3">{{ __('Filter Doctors') }}</h6>
                    <form method="GET" action="{{ route('doctors.index') }}">
                        <div class="mb-3">
                            <label for="specialty_id" class="form-label small fw-medium">{{ __('Specialty') }}</label>
                            <select name="specialty_id" id="specialty_id" class="form-select form-select-sm">
                                <option value="">{{ __('All Specialties') }}</option>
                                @foreach($specialties ?? [] as $s)
                                    <option value="{{ $s->id }}" {{ request('specialty_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hospital_id" class="form-label small fw-medium">{{ __('Hospital') }}</label>
                            <select name="hospital_id" id="hospital_id" class="form-select form-select-sm">
                                <option value="">{{ __('All Hospitals') }}</option>
                                @foreach($hospitals ?? [] as $h)
                                    <option value="{{ $h->id }}" {{ request('hospital_id') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="online_consultation" id="online_consultation" value="1" class="form-check-input" {{ request('online_consultation') == '1' ? 'checked' : '' }}>
                                <label for="online_consultation" class="form-check-label small">{{ __('Online Consultation') }}</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">{{ __('Apply') }}</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="mb-4">
                    <p class="text-muted"><strong>{{ $doctors->total() }}</strong> {{ __('specialists found') }}</p>
                </div>
                <div class="row g-4">
                    @forelse($doctors as $doctor)
                    <div class="col-md-6">
                        <a href="{{ route('doctors.show', $doctor->slug) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm hover-lift">
                                <div class="card-body d-flex gap-3">
                                    @if($doctor->photo_url)
                                        <img src="{{ $doctor->photo_url }}" class="rounded-circle flex-shrink-0" width="80" height="80" style="object-fit:cover;" alt="{{ $doctor->full_name }}">
                                    @else
                                        <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center flex-shrink-0" style="width:80px;height:80px;">
                                            <i class="bi bi-person-fill text-primary fs-2"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h5 class="card-title fw-bold text-dark mb-1">{{ __('Dr.') }} {{ $doctor->first_name }} {{ $doctor->last_name }}</h5>
                                        <p class="text-primary small mb-1">{{ $doctor->designation }}</p>
                                        @if($doctor->experience_years)
                                            <p class="text-muted small mb-1">{{ $doctor->experience_years }} {{ __('years experience') }}</p>
                                        @endif
                                        @if($doctor->primary_hospital ?? null)
                                            <p class="text-muted small mb-0">
                                                <i class="bi bi-building me-1"></i>{{ $doctor->primary_hospital->name }}
                                            </p>
                                        @endif
                                        @if($doctor->online_consultation ?? false)
                                            <span class="badge bg-success-subtle text-success mt-1 small">
                                                <i class="bi bi-camera-video me-1"></i>{{ __('Online Consultation') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">{{ __('No doctors found.') }}</div>
                    @endforelse
                </div>

                <div class="mt-4">{{ $doctors->appends(request()->query())->links() }}</div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">{{ __('How We Select the Right Doctor') }}</h2>
            <p class="text-muted mb-3">{{ __('Every recommendation is tailored to your medical needs.') }}</p>
            <p class="mx-auto" style="max-width:720px;">{{ __('Finding the right doctor is just as important as choosing the right hospital. At Wellaaro, we carefully review your medical reports before recommending specialists who best match your diagnosis, treatment requirements and personal preferences.') }}</p>
            <p class="fw-semibold mb-0">{{ __('Our recommendations are based on a structured evaluation process — not a fixed list of doctors.') }}</p>
        </div>

        <h3 class="fw-bold text-center mb-4">{{ __('Our Doctor Selection Criteria') }}</h3>
        <div class="row g-4 mb-5">
            @foreach([
                ['icon' => 'bi-heart-pulse', 'title' => 'Medical Specialisation', 'desc' => "The doctor's expertise matches your condition."],
                ['icon' => 'bi-mortarboard-fill', 'title' => 'Years of Experience', 'desc' => 'Preference for experienced consultants with a strong clinical record.'],
                ['icon' => 'bi-graph-up-arrow', 'title' => 'Procedure Volume', 'desc' => 'Doctors who regularly perform the required procedure.'],
                ['icon' => 'bi-clipboard2-pulse', 'title' => 'Subspecialty Expertise', 'desc' => 'Specialists focused on your exact disease or surgery.'],
                ['icon' => 'bi-hospital', 'title' => 'Hospital Quality', 'desc' => 'Associated with reputable, accredited hospitals.'],
                ['icon' => 'bi-award', 'title' => 'Treatment Outcomes', 'desc' => 'Strong reputation for patient care and clinical results.'],
                ['icon' => 'bi-chat-dots-fill', 'title' => 'Patient Communication', 'desc' => 'Clear explanation of diagnosis, treatment options and expected outcomes.'],
                ['icon' => 'bi-shield-plus', 'title' => 'Complex Case Experience', 'desc' => 'Ability to manage challenging or high-risk medical conditions.'],
                ['icon' => 'bi-people-fill', 'title' => 'Second Opinion Availability', 'desc' => 'Whenever appropriate, we can help arrange independent second opinions.'],
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

        <div class="card border-0 shadow-sm p-4">
            <h5 class="fw-bold mb-2">{{ __('Our Promise') }}</h5>
            <p class="mb-2">{{ __('Every patient is unique. The doctor we recommend depends on your diagnosis, medical history, age, budget and treatment goals.') }}</p>
            <p class="mb-0">{{ __('There is no "one best doctor" for every patient. Our goal is to help you find the most appropriate specialist for your individual case.') }}</p>
        </div>
    </div>
</section>
@endsection
