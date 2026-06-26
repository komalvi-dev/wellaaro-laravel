@extends('layouts.app')
@section('title', 'How It Works — Your Medical Journey')
@section('content')

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="display-5 fw-bold mb-3">How It Works</h1>
    <p class="lead text-muted col-md-8 mx-auto">
      We make medical tourism simple, safe, and stress-free. Our expert team handles everything from initial consultation to your safe return home.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-5">
      @php
        $steps = [
          ['icon' => 'chat-dots',             'num' => '01', 'title' => 'Submit Your Inquiry',    'color' => '#1a6bcc',
           'desc' => 'Fill in our simple form with your medical condition, treatment preferences, and travel dates. It takes less than 5 minutes.'],
          ['icon' => 'person-check',          'num' => '02', 'title' => 'Medical Review',          'color' => '#0d47a1',
           'desc' => 'Our medical team reviews your case and matches you with the best hospitals and specialists for your specific condition.'],
          ['icon' => 'file-earmark-medical',  'num' => '03', 'title' => 'Receive Treatment Plan', 'color' => '#1565c0',
           'desc' => 'Get a detailed treatment plan and transparent cost quotation covering all aspects including hospital stay, surgery, and recovery.'],
          ['icon' => 'airplane',              'num' => '04', 'title' => 'Travel Arrangements',    'color' => '#1976d2',
           'desc' => 'We assist with visa documentation, travel bookings, airport pickup, and accommodation near the hospital.'],
          ['icon' => 'hospital',              'num' => '05', 'title' => 'Medical Treatment',      'color' => '#1a6bcc',
           'desc' => 'Receive world-class medical care from experienced specialists in JCI-accredited hospitals.'],
          ['icon' => 'heart-pulse',           'num' => '06', 'title' => 'Follow-up & Recovery',  'color' => '#0d47a1',
           'desc' => 'After your treatment, we coordinate post-operative care, follow-up consultations, and assist with your return journey.'],
        ];
      @endphp

      @foreach($steps as $step)
        <div class="col-md-6 col-lg-4">
          <div class="d-flex gap-3">
            <div class="flex-shrink-0">
              <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                   style="width:60px;height:60px;background:{{ $step['color'] }};">
                {{ $step['num'] }}
              </div>
            </div>
            <div>
              <div class="mb-2">
                <i class="bi bi-{{ $step['icon'] }} text-primary fs-4"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">{{ $step['title'] }}</h3>
              <p class="text-muted">{{ $step['desc'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-2">Why Choose Wellaaro</h2>
    <p class="text-muted mb-5 col-md-6 mx-auto">Everything you need for a safe, seamless medical journey — handled by experts who care.</p>
    <div class="row g-4 justify-content-center">
      @php
        $features = [
          ['icon' => 'shield-check',      'title' => 'Independent Hospital Selection', 'desc' => 'We recommend hospitals based on outcomes, not commissions.'],
          ['icon' => 'receipt',           'title' => 'Transparent Service Fees',        'desc' => 'No hidden costs — every fee is disclosed upfront.'],
          ['icon' => 'person-lines-fill', 'title' => 'Dedicated Case Management',       'desc' => 'A single point of contact guides you from inquiry to recovery.'],
          ['icon' => 'heart-pulse',       'title' => 'End-to-End Patient Support',      'desc' => 'Travel, accommodation, translation, and aftercare all covered.'],
        ];
      @endphp
      @foreach($features as $feature)
        <div class="col-6 col-md-3">
          <div class="card border-0 shadow-sm p-4 h-100">
            <div class="mb-3">
              <i class="bi bi-{{ $feature['icon'] }} fs-1 text-primary"></i>
            </div>
            <h3 class="h6 fw-bold mb-2">{{ $feature['title'] }}</h3>
            <p class="text-muted small mb-0">{{ $feature['desc'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-5">
      <a href="{{ route('get_quote') }}" class="btn btn-primary btn-lg px-5">Start Your Journey</a>
    </div>
  </div>
</section>

@endsection
