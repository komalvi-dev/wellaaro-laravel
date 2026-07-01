@extends('layouts.app')

@section('title', 'List Your Hospital with Wellaaro — Reach Global Patients')

@section('description', 'Join Wellaaro\'s network of world-class hospitals. Free profile, professional photography, global patient reach, and detailed analytics — all included.')

@section('content')

<!-- Hero -->
<div class="bg-primary py-5 text-white">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <p class="text-white-50 fw-semibold mb-2 text-uppercase small ls-1">{{ __('For Healthcare Providers') }}</p>
        <h1 class="display-5 fw-bold mb-3">{{ __('Why List with Wellaaro?') }}</h1>
        <p class="lead opacity-90 mb-4">{{ __('Connect with thousands of international patients actively searching for the care you provide — at no upfront cost.') }}</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg fw-semibold px-5">{{ __('Create Your Free Profile') }}</a>
      </div>
      <div class="col-lg-5 text-center d-none d-lg-block">
        <i class="bi bi-hospital" style="font-size:8rem;opacity:0.25;"></i>
      </div>
    </div>
  </div>
</div>

<!-- Stats bar -->
<div class="bg-white border-bottom py-4">
  <div class="container">
    <div class="row g-3 text-center">
      <div class="col-6 col-md-3">
        <div class="fs-3 fw-bold text-primary">50,000+</div>
        <div class="text-muted small">{{ __('Monthly Patient Searches') }}</div>
      </div>
      <div class="col-6 col-md-3">
        <div class="fs-3 fw-bold text-primary">80+</div>
        <div class="text-muted small">{{ __('Countries Represented') }}</div>
      </div>
      <div class="col-6 col-md-3">
        <div class="fs-3 fw-bold text-primary">{{ __('Free') }}</div>
        <div class="text-muted small">{{ __('To Join & List') }}</div>
      </div>
      <div class="col-6 col-md-3">
        <div class="fs-3 fw-bold text-primary">24/7</div>
        <div class="text-muted small">{{ __('Patient Inquiries') }}</div>
      </div>
    </div>
  </div>
</div>

<!-- Why Wellaaro benefits -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">{{ __('Everything included, nothing hidden') }}</h2>
      <p class="text-muted col-md-6 mx-auto">{{ __('Every provider on Wellaaro gets the same powerful tools — regardless of size or specialty.') }}</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-person-badge fs-4 text-primary"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Free Provider Profile') }}</h3>
          <p class="text-muted mb-0">{{ __('Creating your profile costs nothing. Build a comprehensive, differentiated listing that showcases your specialty, accreditations, and outcomes — then connect with patients who need exactly what you offer.') }}</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-sliders fs-4 text-success"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __("You're in Control") }}</h3>
          <p class="text-muted mb-0">{{ __('Define the services and procedures you offer so inquiries come only from patients who are the right fit. No irrelevant leads, no wasted time.') }}</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-camera fs-4 text-warning"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Professional Photography — Free') }}</h3>
          <p class="text-muted mb-0">{{ __('Once you sign up, we send a team of professionals to capture high-resolution images of your team and facility at no charge. When patients choose care online, visuals make the difference.') }}</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-globe2 fs-4 text-info"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Global & Online Reach') }}</h3>
          <p class="text-muted mb-0">{{ __("Tap into Wellaaro's growing international patient base across 80+ countries. Our network of satisfied patients and trusted referrers actively drives new inquiries to listed providers.") }}</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-bar-chart-line fs-4 text-danger"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Detailed Analytics') }}</h3>
          <p class="text-muted mb-0">{{ __('Understand where your traffic comes from, which services attract the most interest, and how to optimise your profile — all through a clear analytics dashboard built for providers.') }}</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-headset fs-4 text-primary"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Dedicated Support') }}</h3>
          <p class="text-muted mb-0">{{ __('A dedicated account manager helps you set up your profile, respond to patient inquiries, and make the most of the platform from day one.') }}</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How it works for providers -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">{{ __('Get listed in 3 simple steps') }}</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-4 text-center">
          <div class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width:52px;height:52px;">
            01
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Create Your Free Profile') }}</h3>
          <p class="text-muted mb-0">{{ __('Sign up and fill in your specialty, services, team, and accreditations. Takes less than 10 minutes.') }}</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-4 text-center">
          <div class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width:52px;height:52px;">
            02
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('We Verify & Photograph') }}</h3>
          <p class="text-muted mb-0">{{ __('Our team verifies your credentials and arranges a free professional photography session at your facility.') }}</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-4 text-center">
          <div class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width:52px;height:52px;">
            03
          </div>
          <h3 class="h5 fw-bold mb-2">{{ __('Start Receiving Patients') }}</h3>
          <p class="text-muted mb-0">{{ __('Go live and receive qualified international patient inquiries directly to your dashboard.') }}</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">{{ __('Ready to reach patients worldwide?') }}</h2>
    <p class="text-muted mb-4 col-md-5 mx-auto">{{ __('Join hundreds of hospitals and clinics already listed on Wellaaro. Your profile is free — always.') }}</p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
      <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">{{ __('Create Free Profile') }}</a>
      <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-lg px-5">{{ __('Contact Us') }}</a>
    </div>
  </div>
</section>

@endsection
