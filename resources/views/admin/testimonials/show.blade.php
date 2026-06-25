@extends('layouts.admin')
@section('title', 'Testimonial')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $testimonial->patient_name }}</h1>
    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <p class="fst-italic text-muted">"{{ $testimonial->short_quote }}"</p>
        <dl class="row mt-3">
            <dt class="col-sm-3 small text-muted">Country</dt><dd class="col-sm-9">{{ $testimonial->country ?? '—' }}</dd>
            <dt class="col-sm-3 small text-muted">Treatment</dt><dd class="col-sm-9">{{ $testimonial->treatment ?? '—' }}</dd>
            <dt class="col-sm-3 small text-muted">Rating</dt><dd class="col-sm-9">{{ str_repeat('★', (int)$testimonial->rating) }}</dd>
            <dt class="col-sm-3 small text-muted">Status</dt><dd class="col-sm-9"><span class="badge {{ $testimonial->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $testimonial->published ? 'Published' : 'Draft' }}</span></dd>
        </dl>
        @if($testimonial->full_story)<p class="mt-3">{{ $testimonial->full_story }}</p>@endif
    </div>
</div>
@endsection
