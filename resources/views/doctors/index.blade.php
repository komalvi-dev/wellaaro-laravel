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
        <h1 class="h2 fw-bold">{{ __('Find a Specialist') }}</h1>
        <p class="text-muted">{{ __('Connect with leading specialists across top accredited hospitals') }}</p>
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
@endsection
