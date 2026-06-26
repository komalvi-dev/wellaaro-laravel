@extends('layouts.app')
@section('title', $hospital->meta_title ?? $hospital->name)
@section('description', $hospital->meta_description ?? '')
@section('content')

<section class="hospital-hero py-5" style="background:linear-gradient(135deg,#f8f9fa,#e3f2fd);">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hospitals.index') }}">Hospitals</a></li>
                <li class="breadcrumb-item active">{{ $hospital->name }}</li>
            </ol>
        </nav>

        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-start gap-3 mb-3">
                    @if($hospital->logo_url)
                        <img src="{{ $hospital->logo_url }}" class="rounded-3" alt="{{ $hospital->name }}"
                             style="width:80px;height:80px;object-fit:contain;background:#fff;padding:8px;">
                    @endif
                    <div>
                        <h1 class="h2 fw-bold mb-1">{{ $hospital->name }}</h1>
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt me-1"></i>{{ $hospital->address ?? $hospital->city?->name }}, {{ $hospital->country?->name }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            @if($hospital->is_jci_accredited)
                                <span class="badge bg-warning text-dark"><i class="bi bi-patch-check me-1"></i>JCI Accredited</span>
                            @endif
                            @if($hospital->is_nabh_accredited)
                                <span class="badge bg-info text-dark"><i class="bi bi-patch-check me-1"></i>NABH Accredited</span>
                            @endif
                            @if($hospital->international_patient_desk)
                                <span class="badge bg-primary">International Patient Desk</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    @if($hospital->average_rating)
                        <div class="d-flex align-items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($hospital->average_rating))
                                    <i class="bi bi-star-fill text-warning"></i>
                                @else
                                    <i class="bi bi-star text-warning"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-muted small">{{ number_format($hospital->average_rating, 1) }} ({{ $hospital->reviews()->count() }} reviews)</span>
                    @endif
                    @if($hospital->established_year)
                        <span class="text-muted small">Est. {{ $hospital->established_year }}</span>
                    @endif
                </div>

                <div class="d-flex gap-3">
                    <a href="{{ route('get_quote') }}?hospital={{ $hospital->id }}" class="btn btn-primary btn-lg">Get Free Quote</a>
                    @if($hospital->phone)
                        <a href="tel:{{ $hospital->phone }}" class="btn btn-outline-success btn-lg">
                            <i class="bi bi-telephone me-2"></i>Call Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nav tabs -->
<div class="sticky-top bg-white border-bottom shadow-sm" style="top:70px;z-index:100;">
    <div class="container">
        <nav class="nav">
            <a class="nav-link" href="#overview">Overview</a>
            <a class="nav-link" href="#specialties">Departments</a>
            <a class="nav-link" href="#doctors">Doctors</a>
            @if($hospital->gallery->count())<a class="nav-link" href="#gallery">Gallery</a>@endif
            <a class="nav-link" href="#reviews">Reviews</a>
        </nav>
    </div>
</div>

<section class="py-5" id="overview">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="h4 fw-bold mb-3">About {{ $hospital->name }}</h2>
                <div class="text-muted">
                    @if($hospital->description)<p>{{ $hospital->description }}</p>@endif
                    @if($hospital->about)<div class="mt-3">{!! nl2br(e($hospital->about)) !!}</div>@endif
                </div>

                <div class="row g-3 mt-2">
                    @if($hospital->established_year)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ $hospital->established_year }}</div><div class="text-muted small">Established</div></div>@endif
                    @if($hospital->bed_count)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ $hospital->bed_count }}</div><div class="text-muted small">Beds</div></div>@endif
                    @if($hospital->ot_count)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ $hospital->ot_count }}</div><div class="text-muted small">OTs</div></div>@endif
                    @if($hospital->annual_patients)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ number_format($hospital->annual_patients) }}</div><div class="text-muted small">Patients/Year</div></div>@endif
                </div>

                @if($hospital->facilities->count())
                    <h3 class="h5 fw-bold mt-5 mb-3">Facilities &amp; Amenities</h3>
                    <div class="row g-2">
                        @foreach($hospital->facilities as $f)
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-2 p-2 rounded bg-light">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <span class="small">{{ $f->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="h6 fw-bold mb-3">Hospital Information</h3>
                    <ul class="list-unstyled">
                        @if($hospital->bed_count)
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted small">Beds</span>
                                <span class="fw-medium small">{{ $hospital->bed_count }}+</span>
                            </li>
                        @endif
                        @if($hospital->phone)
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted small"><i class="bi bi-telephone-fill me-1"></i>Phone</span>
                                <span class="fw-medium small">{{ $hospital->phone }}</span>
                            </li>
                        @endif
                        @if($hospital->email)
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted small"><i class="bi bi-envelope-fill me-1"></i>Email</span>
                                <span class="fw-medium small">{{ $hospital->email }}</span>
                            </li>
                        @endif
                        @if($hospital->website)
                            <li class="py-2">
                                <a href="{{ $hospital->website }}" class="small text-primary" target="_blank" rel="noopener">
                                    <i class="bi bi-globe me-1"></i>Visit Website
                                </a>
                            </li>
                        @endif
                    </ul>
                    <hr>
                    <a href="{{ route('get_quote') }}?hospital={{ $hospital->id }}" class="btn btn-primary w-100">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

@if($hospital->specialties->count())
<section class="py-5 bg-light" id="specialties">
    <div class="container">
        <h2 class="h4 fw-bold mb-4">Departments &amp; Specialties</h2>
        <div class="row g-3">
            @foreach($hospital->specialties as $s)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3">
                        <div class="fw-semibold">{{ $s->name }}</div>
                        @if($s->pivot->is_center_of_excellence)<span class="badge bg-warning text-dark small">Centre of Excellence</span>@endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($hospital->doctors()->published()->count())
<section class="py-5 bg-light" id="doctors">
    <div class="container">
        <h2 class="h4 fw-bold mb-4">Our Specialists</h2>
        <div class="row g-4">
            @foreach($hospital->doctors()->published()->get() as $doctor)
                <div class="col-md-6">
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="text-decoration-none">
                        <div class="card card-hover border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3">
                            @if($doctor->photo_url)
                                <img src="{{ $doctor->photo_url }}" class="rounded-circle" width="48" height="48" style="object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:48px;height:48px;min-width:48px;">{{ substr($doctor->first_name, 0, 1) }}</div>
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $doctor->full_name }}</div>
                                <div class="text-muted small">{{ $doctor->designation }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($hospital->gallery->count())
<section class="py-5" id="gallery">
    <div class="container">
        <h2 class="h4 fw-bold mb-4">Gallery</h2>
        <div class="row g-3">
            @foreach($hospital->gallery as $img)
                <div class="col-4 col-md-3"><img src="{{ $img->image_url }}" class="img-fluid rounded" alt="{{ $img->caption }}"></div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($hospital->reviews()->count())
<section class="py-5" id="reviews">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="h4 fw-bold mb-4">Patient Reviews</h2>
                @foreach($hospital->reviews as $review)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <span class="fw-medium">{{ $review->patient_name ?? 'Anonymous Patient' }}</span>
                                    @if($review->is_verified)
                                        <span class="badge bg-success-subtle text-success ms-2 small">Verified</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($review->overall_rating))
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-muted mb-1">{{ $review->content }}</p>
                            <span class="text-muted small">{{ $review->created_at->format('F Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection
