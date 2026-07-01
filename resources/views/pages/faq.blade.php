@extends('layouts.app')
@section('title', 'Frequently Asked Questions')
@section('content')

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="display-6 fw-bold mb-3">{{ __('Frequently Asked Questions') }}</h1>
    <p class="lead text-muted">{{ __('Everything you need to know about medical tourism in India') }}</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        @foreach($faq_groups ?? $faqs_by_category ?? [] as $category => $faqs)
          <h2 class="h5 fw-bold mb-3 mt-4">{{ Str::headline($category) }}</h2>
          <div class="accordion mb-4" id="faq-{{ $category }}">
            @foreach($faqs as $i => $faq)
              <div class="accordion-item border-0 mb-2 shadow-sm">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed fw-medium"
                          type="button" data-bs-toggle="collapse"
                          data-bs-target="#faq-{{ $category }}-{{ $i }}">
                    {{ $faq->question }}
                  </button>
                </h3>
                <div id="faq-{{ $category }}-{{ $i }}" class="accordion-collapse collapse">
                  <div class="accordion-body text-muted">
                    {!! nl2br(e($faq->answer)) !!}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach

        <div class="text-center mt-5 p-4 bg-primary-subtle rounded-3">
          <h3 class="h5 fw-bold mb-2">{{ __('Still have questions?') }}</h3>
          <p class="text-muted mb-3">{{ __('Our medical consultants are ready to help.') }}</p>
          <a href="{{ route('contact') }}" class="btn btn-primary">{{ __('Contact Us') }}</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
