@extends('layouts.app')
@section('title', $testimonial->patient_name . '\'s Story')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-4"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('patient_stories') }}">Patient Stories</a></li><li class="breadcrumb-item active">{{ $testimonial->patient_name }}</li></ol></nav>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        @if($testimonial->photo_url)<img src="{{ $testimonial->photo_url }}" class="rounded-circle" width="64" height="64" style="object-fit:cover;">@else<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:64px;height:64px;font-size:1.5rem;">{{ substr($testimonial->patient_name,0,1) }}</div>@endif
                        <div>
                            <h5 class="fw-bold mb-0">{{ $testimonial->patient_name }}</h5>
                            <p class="text-muted mb-1 small">{{ $testimonial->country }} &bull; {{ $testimonial->treatment }}</p>
                            <div class="text-warning">@for($i=0;$i<$testimonial->rating;$i++)<i class="fas fa-star small"></i>@endfor</div>
                        </div>
                    </div>
                    @if($testimonial->is_video && $testimonial->video_url)
                    <div class="ratio ratio-16x9 mb-4"><iframe src="{{ $testimonial->video_url }}" allowfullscreen></iframe></div>
                    @endif
                    <blockquote class="blockquote border-start border-4 border-primary ps-3 mb-4">
                        <p class="fst-italic">"{{ $testimonial->short_quote }}"</p>
                    </blockquote>
                    @if($testimonial->full_story)
                    <div>{!! nl2br(e($testimonial->full_story)) !!}</div>
                    @endif
                    <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                        @if($testimonial->hospital)<a href="{{ route('hospitals.show', $testimonial->hospital->slug) }}" class="badge bg-light text-muted text-decoration-none">{{ $testimonial->hospital->name }}</a>@endif
                        @if($testimonial->doctor)<a href="{{ route('doctors.show', $testimonial->doctor->slug) }}" class="badge bg-light text-muted text-decoration-none">{{ $testimonial->doctor->full_name }}</a>@endif
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('get_quote') }}" class="btn btn-primary">Start Your Journey Like {{ $testimonial->patient_name }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
