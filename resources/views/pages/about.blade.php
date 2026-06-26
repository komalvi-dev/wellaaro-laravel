@extends('layouts.app')
@section('title', 'About Us — Medical Tourism Experts')
@section('content')

{{-- ── Hero ── --}}
<section class="py-5" style="background:linear-gradient(135deg,#e3f2fd,#f8f9fa);">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 text-center">
        <img src="{{ asset('images/ceo_image.jpeg') }}" class="img-fluid rounded-4 shadow" style="width:100%;object-fit:contain;">
        <p class="fst-italic text-muted mt-3 mb-0 px-2">"Medicine taught me how important healthcare is. Meeting people from different cultures taught me how important trust is. Wellaaro was created to bring both together."</p>
      </div>
      <div class="col-lg-6">
        <p class="display-6 fw-bold mb-4">About Founder</p>

        <h2 class="h4 fw-bold mb-3">Meet the Founder</h2>

        <p class="text-muted">My journey began with a dream of becoming a doctor and a passion for understanding people from different cultures and backgrounds.</p>

        <p class="text-muted">After completing my schooling, I moved abroad to pursue my medical education, where I spent more than six years studying medicine and gaining valuable exposure to international healthcare environments. During this journey, I had the opportunity to interact with people from diverse countries, cultures, and communities, which helped me better understand the challenges individuals face when seeking quality healthcare.</p>

        <p class="text-muted">While exploring the healthcare industry, I discovered the growing field of medical tourism. Through extensive research, I realized that many international patients struggle to find reliable information, trusted hospitals, transparent guidance, and personalized support when considering treatment abroad.</p>

        <p class="text-muted">This inspired me to establish Wellaaro.</p>

        <p class="text-muted">My goal is simple: to help patients from around the world access India's world-class healthcare system with clarity, confidence, and trusted guidance. By combining medical knowledge with patient-focused support, I aim to contribute meaningfully to the global healthcare community and help patients make informed decisions about their treatment journey.</p>

        <p class="text-muted">— Founder, Wellaaro</p>
        <div class="d-flex gap-3 mt-4">
          <a href="{{ route('get_quote') }}" class="btn btn-primary btn-lg">Start Free Consultation</a>
          <a href="{{ route('how_it_works') }}" class="btn btn-outline-primary btn-lg">How It Works</a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Company Story ── --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <h2 class="h4 fw-bold mb-3">Our Journey</h2>
        <p class="text-muted fw-medium mb-3">Wellaaro was founded with a simple belief:</p>
        <p class="text-primary fw-semibold fs-5 mb-4">Access to quality healthcare should not be limited by geography.</p>
        <p class="text-muted">India is home to some of the world's leading hospitals, highly skilled specialists, and advanced medical treatments. Yet many international patients face challenges when trying to understand treatment options, compare hospitals, estimate costs, arrange travel, and navigate an unfamiliar healthcare system.</p>
        <p class="text-muted fw-medium">Wellaaro was created to bridge that gap.</p>
        <p class="text-muted">We help international patients explore treatment options in India by providing transparent information, personalized guidance, hospital coordination, and ongoing support throughout their healthcare journey.</p>
        <p class="text-muted">As a healthcare-focused startup founded by a medical professional, our mission is not to sell treatments but to help patients make informed decisions with confidence.</p>
        <h2 class="h4 fw-bold mb-3">Beyond Treatment, Towards Trust.</h2>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['🌍', 'Global Perspective',  'Built on years of international exposure and interaction with people from diverse cultures, helping us better understand the needs of patients travelling abroad for treatment.'],
            ['🩺', 'Medical Background',  'Founded by a medical professional with healthcare education and a deep understanding of patient concerns, treatment pathways, and healthcare decision-making.'],
            ['🏥', 'Hospital Access',     'We help patients explore leading hospitals in India based on their treatment needs, preferences, and budget considerations.']
          ] as [$emoji, $title, $desc])
            <div class="col-12">
              <div class="card border-0 shadow-sm text-center p-3">
                <div class="display-6 fw-bold text-primary mb-1">{{ $emoji }}</div>
                <p class="fw-medium small mb-1">{{ $title }}</p>
                <p class="text-muted small mb-0">{{ $desc }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Vision & Mission ── --}}
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                 style="width:52px;height:52px;">
              <i class="bi bi-eye-fill text-white fs-5"></i>
            </div>
            <h2 class="h4 fw-bold mb-0">Our Vision</h2>
          </div>
          <p class="text-muted mb-0">
            To redefine how patients access global healthcare with trust, transparency, and human care.
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                 style="width:52px;height:52px;">
              <i class="bi bi-bullseye text-white fs-5"></i>
            </div>
            <h2 class="h4 fw-bold mb-0">Our Mission</h2>
          </div>
          <p class="text-muted mb-0">
            To simplify global healthcare access by connecting patients with world-class treatment &amp; seamless care experiences.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Goals ── --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Our Goals</h2>
      <p class="text-muted">What we strive to achieve for every patient we serve</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['1', 'arrow-down-circle-fill', 'text-primary', 'Make Healthcare Affordable',
          "Eliminate financial barriers to quality medical care by leveraging India's cost advantage — delivering savings of up to 80% compared to Western countries without any compromise on clinical outcomes."],
        ['2', 'patch-check-fill', 'text-success', 'Ensure Quality at Every Step',
          'Partner exclusively with JCI and NABH-accredited hospitals and board-certified specialists, so patients receive the same standard of care they would expect in their home country.'],
        ['3', 'globe2', 'text-info', 'Create Seamless Global Access',
          'Remove the complexity of cross-border healthcare through dedicated case managers, visa assistance, travel coordination, and real-time support from first inquiry to full recovery.'],
        ['4', 'heart-pulse-fill', 'text-danger', 'Champion Patient-Centred Care',
          "Place the patient's wellbeing, comfort, and informed consent at the centre of every decision — ensuring each care plan is personalised, compassionate, and built around individual needs."]
      ] as [$num, $icon, $icon_class, $title, $desc])
        <div class="col-md-6 col-lg-3">
          <div class="card border-0 shadow-sm h-100 p-4 text-center">
            <div class="mx-auto mb-3">
              <i class="bi bi-{{ $icon }} {{ $icon_class }}" style="font-size:2.2rem;"></i>
            </div>
            <h5 class="fw-bold mb-2">{{ $title }}</h5>
            <p class="text-muted small mb-0">{{ $desc }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ── Core Values ── --}}
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Our Core Values</h2>
      <p class="text-muted">The principles that guide everything we do</p>
    </div>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['1', 'shield-check-fill', 'Safety',
          'Patient safety is non-negotiable. Every hospital, procedure, and recommendation is held to the highest clinical and safety standards. We never compromise on accreditation, infection control, or surgical protocols — because your life depends on it.'],
        ['2', 'award-fill', 'Excellence',
          'We pursue excellence relentlessly — in the specialists we recommend, the hospitals we partner with, and the service we deliver. Mediocrity has no place in healthcare, and it has no place in how we serve our patients.'],
        ['3', 'hand-thumbs-up-fill', 'Trust',
          'We earn trust by being honest, transparent, and consistent. We disclose fees upfront, share unbiased hospital comparisons, and stand by our patients long after treatment ends — because a trusted partner is worth more than any transaction.']
      ] as [$num, $icon, $title, $desc])
        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                   style="width:52px;height:52px;">
                <span class="fw-bold text-primary fs-5">{{ $num }}</span>
              </div>
              <div>
                <i class="bi bi-{{ $icon }} text-primary me-1"></i>
                <span class="fw-bold fs-5">{{ $title }}</span>
              </div>
            </div>
            <p class="text-muted mb-0">{{ $desc }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ── CTA ── --}}
<section class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">Ready to Begin Your Healthcare Journey?</h2>
    <p class="lead mb-4 opacity-75">Talk to our team today — free consultation, no obligations.</p>
    <a href="{{ route('get_quote') }}" class="btn btn-light btn-lg px-5">Get a Free Quote</a>
  </div>
</section>

@endsection
