@extends('layouts.app')

@section('title', 'Our Services — Wellaaro Medical Tourism')

@section('description', 'From medical opinion and visa assistance to airport transfers and post-treatment follow-up — a dedicated case manager supports you every step of the way.')

@section('content')
<!-- Hero -->
<div class="bg-primary py-5 text-white">
  <div class="container text-center">
    <h1 class="display-5 fw-bold mb-3">Our Services Cover Every Need</h1>
    <p class="lead opacity-90 col-md-7 mx-auto">A Dedicated Case Manager Assists You Every Step Of The Way</p>
  </div>
</div>

<!-- Services grid -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-file-earmark-medical fs-4 text-primary"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Medical Opinion &amp; Cost Estimation</h3>
          <p class="text-muted mb-0">Expert review of your medical reports and transparent cost estimates from multiple top-tier hospitals.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-camera-video fs-4 text-success"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Pre-Travel Consultation</h3>
          <p class="text-muted mb-0">Detailed tele-consultations with specialists before you decide to travel.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-card-checklist fs-4 text-info"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Medical Visa Assistance</h3>
          <p class="text-muted mb-0">Prompt issuance of Medical Visa Invitation Letters (VIL) to expedite your visa process.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-currency-exchange fs-4 text-warning"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Money Exchange Support</h3>
          <p class="text-muted mb-0">Assistance with currency exchange at competitive rates upon arrival.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-translate fs-4 text-danger"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Interpreters &amp; Translators</h3>
          <p class="text-muted mb-0">Professional language interpreters to ensure clear communication with doctors.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-car-front fs-4 text-primary"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Airport Transfers</h3>
          <p class="text-muted mb-0">Complimentary pick-up and drop-off services in comfortable, sanitized vehicles.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-building fs-4 text-success"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Accommodation Arrangements</h3>
          <p class="text-muted mb-0">Booking hotels or guest houses near the hospital that fit your budget and preferences.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-hospital fs-4 text-info"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Hospital Admission Assistance</h3>
          <p class="text-muted mb-0">Priority admission process with zero waiting time at partner hospitals.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-calendar-check fs-4 text-warning"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Appointment Scheduling</h3>
          <p class="text-muted mb-0">Pre-booked priority appointments for OPD consultations and diagnostic tests.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-capsule fs-4 text-danger"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Pharmacy Support</h3>
          <p class="text-muted mb-0">Assistance in procuring prescribed medicines for your treatment and return journey.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-person-hearts fs-4 text-primary"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Private Duty Nursing</h3>
          <p class="text-muted mb-0">Arranging professional nursing care at your accommodation if required post-discharge.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-headset fs-4 text-success"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">24/7 Patient Support</h3>
          <p class="text-muted mb-0">Round-the-clock assistance from a dedicated case manager throughout your stay.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-folder2-open fs-4 text-info"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Medical Records Coordination</h3>
          <p class="text-muted mb-0">Organizing and digitizing all your medical reports and discharge summaries.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-arrow-repeat fs-4 text-warning"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Post-Treatment Follow-Up</h3>
          <p class="text-muted mb-0">Facilitating online follow-up consultations with your treating doctor after you return home.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3">
            <span class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:52px;height:52px;">
              <i class="bi bi-shield-exclamation fs-4 text-danger"></i>
            </span>
          </div>
          <h3 class="h5 fw-bold mb-2">Emergency Assistance</h3>
          <p class="text-muted mb-0">Immediate support and coordination in case of any medical emergencies during your stay.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">Ready to begin your medical journey?</h2>
    <p class="text-muted mb-4 col-md-5 mx-auto">Tell us about your condition and we'll match you with the right hospital, handle every detail, and keep you informed at every step.</p>
    <a href="{{ route('get_quote') }}" class="btn btn-primary btn-lg px-5">Get a Free Quote</a>
  </div>
</section>
@endsection
