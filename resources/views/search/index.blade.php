@extends('layouts.app')
@section('title', 'Search Results')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-2">{{ __('Search Results') }}</h1>
        <form action="{{ route('search') }}" method="GET" class="d-flex gap-2" style="max-width:500px;">
            <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="{{ __('Search hospitals, doctors, treatments...') }}">
            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
        </form>
    </div>
</div>
<div class="container py-4">
    @if(!request('q'))
        <p class="text-muted">{{ __('Please enter a search term.') }}</p>
    @else
    <p class="text-muted mb-4">{{ __('Results for:') }} <strong>{{ request('q') }}</strong></p>
    @if(isset($hospitals) && $hospitals->count())
    <h5 class="fw-bold mb-3">{{ __('Hospitals') }}</h5>
    <div class="row g-3 mb-4">
        @foreach($hospitals as $h)
        <div class="col-md-4"><a href="{{ route('hospitals.show', $h->slug) }}" class="text-decoration-none"><div class="card border-0 shadow-sm p-3 card-hover"><h6 class="fw-bold mb-1">{{ $h->name }}</h6><p class="text-muted small mb-0">{{ $h->city?->name }}</p></div></a></div>
        @endforeach
    </div>
    @endif
    @if(isset($doctors) && $doctors->count())
    <h5 class="fw-bold mb-3">{{ __('Doctors') }}</h5>
    <div class="row g-3 mb-4">
        @foreach($doctors as $d)
        <div class="col-md-4"><a href="{{ route('doctors.show', $d->slug) }}" class="text-decoration-none"><div class="card border-0 shadow-sm p-3 card-hover"><h6 class="fw-bold mb-1">{{ $d->full_name }}</h6><p class="text-muted small mb-0">{{ $d->designation }}</p></div></a></div>
        @endforeach
    </div>
    @endif
    @if(isset($treatments) && $treatments->count())
    <h5 class="fw-bold mb-3">{{ __('Treatments') }}</h5>
    <div class="row g-3 mb-4">
        @foreach($treatments as $t)
        <div class="col-md-4"><a href="{{ route('treatments.show', $t->slug) }}" class="text-decoration-none"><div class="card border-0 shadow-sm p-3 card-hover"><h6 class="fw-bold mb-1">{{ $t->name }}</h6><p class="text-muted small mb-0">{{ $t->specialty?->name }}</p></div></a></div>
        @endforeach
    </div>
    @endif
    @if(isset($specialties) && $specialties->count())
    <h5 class="fw-bold mb-3">{{ __('Specialties') }}</h5>
    <div class="row g-3">
        @foreach($specialties as $s)
        <div class="col-md-4"><a href="{{ route('specialties.show', $s->slug) }}" class="text-decoration-none"><div class="card border-0 shadow-sm p-3 card-hover"><h6 class="fw-bold mb-0">{{ $s->name }}</h6></div></a></div>
        @endforeach
    </div>
    @endif
    @if((!isset($hospitals) || !$hospitals->count()) && (!isset($doctors) || !$doctors->count()) && (!isset($treatments) || !$treatments->count()) && (!isset($specialties) || !$specialties->count()))
    <div class="text-center py-5 text-muted">
        <i class="fas fa-search fa-3x mb-3"></i>
        <p>{{ __('No results found for ":query".', ['query' => request('q')]) }}</p>
        <a href="{{ route('get_quote') }}" class="btn btn-primary">{{ __('Ask Our Experts') }}</a>
    </div>
    @endif
    @endif
</div>
@endsection
