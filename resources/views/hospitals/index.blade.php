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
        <h1 class="h2 fw-bold">{{ __('Top Hospitals') }}</h1>
        <p class="text-muted">{{ __('Find JCI & NABH accredited hospitals with world-class facilities') }}</p>
    </div>
</section>

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

@endsection
