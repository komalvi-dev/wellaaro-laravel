@extends('layouts.app')
@section('title', 'Patient Stories')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">{{ __('Patient Stories') }}</h1>
        <p class="text-muted mb-0">{{ __('Real experiences from patients who chose India for their treatment') }}</p>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        @forelse($testimonials as $t)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('patient_story', $t->id) }}" class="text-decoration-none">
                <div class="card card-hover h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-warning mb-2">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star small"></i>@endfor</div>
                        <p class="text-muted fst-italic mb-3">"{{ Str::limit($t->short_quote, 120) }}"</p>
                        <div class="d-flex align-items-center gap-2 mt-auto">
                            @if($t->photo_url)<img src="{{ $t->photo_url }}" class="rounded-circle" width="44" height="44" style="object-fit:cover;">@else<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:44px;height:44px;">{{ substr($t->patient_name,0,1) }}</div>@endif
                            <div><div class="fw-semibold small">{{ $t->patient_name }}</div><div class="text-muted small">{{ $t->country }} &bull; {{ $t->treatment }}</div></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">{{ __('No patient stories yet.') }}</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $testimonials->links() }}</div>
</div>
@endsection
