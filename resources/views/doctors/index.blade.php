@extends('layouts.app')
@section('title', 'Our Doctors')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Our Doctors</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Doctors</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            <form method="GET" class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Filters</h6>
                <div class="mb-3">
                    <input type="text" name="q" class="form-control form-control-sm" value="{{ request('q') }}" placeholder="Search doctor...">
                </div>
                <div class="mb-3">
                    <select name="specialty_id" class="form-select form-select-sm">
                        <option value="">All Specialties</option>
                        @foreach($specialties ?? [] as $s)
                            <option value="{{ $s->id }}" {{ request('specialty_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            </form>
        </div>
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($doctors as $doctor)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="text-decoration-none">
                        <div class="card card-hover h-100 border-0 shadow-sm text-center">
                            <div class="pt-4">
                                @if($doctor->photo_url)
                                    <img src="{{ $doctor->photo_url }}" class="rounded-circle mx-auto" width="80" height="80" style="object-fit:cover;" alt="{{ $doctor->full_name }}">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width:80px;height:80px;font-size:2rem;">{{ substr($doctor->first_name,0,1) }}</div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">{{ $doctor->full_name }}</h6>
                                <p class="text-muted small mb-1">{{ $doctor->designation }}</p>
                                <p class="text-muted small mb-2">{{ $doctor->qualifications }}</p>
                                @if($doctor->experience_years)<span class="badge bg-light text-muted">{{ $doctor->experience_years }} yrs experience</span>@endif
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">No doctors found.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $doctors->appends(request()->query())->links() }}</div>
        </div>
    </div>
</div>
@endsection
