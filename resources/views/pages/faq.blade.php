@extends('layouts.app')
@section('title', 'Frequently Asked Questions')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Frequently Asked Questions</h1>
        <p class="text-muted mb-0">Find answers to common questions about medical tourism in India</p>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-9">
            @php $grouped = $faqs->groupBy('category'); @endphp
            @foreach($grouped as $category => $items)
            <h5 class="fw-bold mb-3 mt-4 {{ $loop->first ? 'mt-0' : '' }}">{{ ucwords(str_replace('_', ' ', $category ?: 'General')) }}</h5>
            <div class="accordion mb-4" id="faq_{{ Str::slug($category ?: 'general') }}">
                @foreach($items as $i => $faq)
                <div class="accordion-item border-0 shadow-sm mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $i>0?'collapsed':'' }}" type="button" data-bs-toggle="collapse" data-bs-target="#f{{ $faq->id }}">{{ $faq->question }}</button>
                    </h2>
                    <div id="f{{ $faq->id }}" class="accordion-collapse collapse {{ $i===0?'show':'' }}" data-bs-parent="#faq_{{ Str::slug($category ?: 'general') }}">
                        <div class="accordion-body text-muted">{{ $faq->answer }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            @if($faqs->isEmpty())
            <p class="text-muted">No FAQs available yet.</p>
            @endif
        </div>
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top:80px;">
                <div class="card-body text-center">
                    <i class="fas fa-headset fa-2x text-primary mb-2"></i>
                    <h6 class="fw-bold">Still have questions?</h6>
                    <p class="text-muted small mb-3">Our medical coordinators are here to help</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Contact Us</a>
                    <a href="{{ route('get_quote') }}" class="btn btn-primary btn-sm w-100">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
