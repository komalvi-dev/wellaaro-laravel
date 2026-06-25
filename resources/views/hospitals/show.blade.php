@extends('layouts.app')
@section('title', $hospital->name)
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('hospitals.index') }}">Hospitals</a></li><li class="breadcrumb-item active">{{ $hospital->name }}</li></ol></nav>
        <div class="d-flex align-items-start gap-3">
            @if($hospital->logo_url)<img src="{{ $hospital->logo_url }}" height="60" class="rounded" alt="{{ $hospital->name }}">@endif
            <div>
                <h1 class="h2 fw-bold mb-1">{{ $hospital->name }}</h1>
                <p class="text-muted mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $hospital->address ?? $hospital->city?->name }}, {{ $hospital->country?->name }}</p>
                <div class="d-flex gap-1">
                    @if($hospital->is_jci_accredited)<span class="badge bg-success">JCI Accredited</span>@endif
                    @if($hospital->is_nabh_accredited)<span class="badge bg-info">NABH Accredited</span>@endif
                    @if($hospital->international_patient_desk)<span class="badge bg-primary">International Patient Desk</span>@endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            <ul class="nav nav-tabs mb-4" id="hospitalTabs">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview">Overview</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#specialties">Specialties</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#doctors">Doctors</button></li>
                @if($hospital->gallery->count())<li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#gallery">Gallery</button></li>@endif
                @if($hospital->facilities->count())<li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#facilities">Facilities</button></li>@endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="overview">
                    @if($hospital->description)<p>{{ $hospital->description }}</p>@endif
                    @if($hospital->about)<div class="mt-3">{!! nl2br(e($hospital->about)) !!}</div>@endif
                    <div class="row g-3 mt-2">
                        @if($hospital->established_year)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ $hospital->established_year }}</div><div class="text-muted small">Established</div></div>@endif
                        @if($hospital->bed_count)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ $hospital->bed_count }}</div><div class="text-muted small">Beds</div></div>@endif
                        @if($hospital->ot_count)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ $hospital->ot_count }}</div><div class="text-muted small">OTs</div></div>@endif
                        @if($hospital->annual_patients)<div class="col-6 col-md-3 text-center"><div class="fw-bold text-primary">{{ number_format($hospital->annual_patients) }}</div><div class="text-muted small">Patients/Year</div></div>@endif
                    </div>
                </div>
                <div class="tab-pane fade" id="specialties">
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
                <div class="tab-pane fade" id="doctors">
                    <div class="row g-3">
                        @foreach($hospital->doctors()->published()->get() as $doctor)
                        <div class="col-md-6">
                            <a href="{{ route('doctors.show', $doctor->slug) }}" class="text-decoration-none">
                                <div class="card card-hover border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3">
                                    @if($doctor->photo_url)<img src="{{ $doctor->photo_url }}" class="rounded-circle" width="48" height="48" style="object-fit:cover;">@else<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:48px;height:48px;min-width:48px;">{{ substr($doctor->first_name,0,1) }}</div>@endif
                                    <div><div class="fw-semibold">{{ $doctor->full_name }}</div><div class="text-muted small">{{ $doctor->designation }}</div></div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @if($hospital->gallery->count())
                <div class="tab-pane fade" id="gallery">
                    <div class="row g-3">
                        @foreach($hospital->gallery as $img)
                        <div class="col-4 col-md-3"><img src="{{ $img->image_url }}" class="img-fluid rounded" alt="{{ $img->caption }}"></div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($hospital->facilities->count())
                <div class="tab-pane fade" id="facilities">
                    <div class="row g-2">
                        @foreach($hospital->facilities as $f)
                        <div class="col-md-4"><div class="d-flex align-items-center gap-2 p-2 border rounded"><i class="{{ $f->icon_class ?? 'fas fa-check' }} text-primary"></i><span class="small">{{ $f->name }}</span></div></div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Get Treatment at {{ $hospital->name }}</h6>
                    <a href="{{ route('get_quote') }}?hospital={{ $hospital->id }}" class="btn btn-primary w-100 mb-2">Request Quote</a>
                    @if($hospital->phone)<a href="tel:{{ $hospital->phone }}" class="btn btn-outline-success w-100 btn-sm mb-2"><i class="fas fa-phone me-1"></i>Call Hospital</a>@endif
                </div>
            </div>
            @if($hospital->phone || $hospital->email || $hospital->website)
            <div class="card border-0 shadow-sm">
                <div class="card-body small">
                    <h6 class="fw-bold mb-2">Contact</h6>
                    @if($hospital->phone)<p class="mb-1"><i class="fas fa-phone me-2 text-muted"></i>{{ $hospital->phone }}</p>@endif
                    @if($hospital->email)<p class="mb-1"><i class="fas fa-envelope me-2 text-muted"></i>{{ $hospital->email }}</p>@endif
                    @if($hospital->website)<p class="mb-0"><i class="fas fa-globe me-2 text-muted"></i><a href="{{ $hospital->website }}" target="_blank">Website</a></p>@endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
