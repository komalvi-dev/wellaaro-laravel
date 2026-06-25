@extends('layouts.app')

@section('title', 'World-Class Medical Tourism in India')

@section('content')

<section class="hero-section position-relative overflow-hidden"
         style="background: rgba(10,20,45,0.65) url('/images/hero-image.jpeg') center/contain no-repeat;
                background-blend-mode: multiply;
                min-height: clamp(520px, 60vw, 820px);">

    <div style="position:absolute;inset:0;background:rgba(10,20,45,0.45);"></div>

    <div style="position:relative;z-index:1;display:flex;align-items:center;min-height:inherit;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 fs-6">Trusted by 10,000+ Patients</span>
                    <h1 class="display-4 fw-bold mb-4">World-Class Healthcare at <span class="text-warning">Affordable Prices</span></h1>
                    <p class="lead mb-4 text-white-75">Access the best hospitals and doctors in India. Save up to 70% on medical treatments without compromising on quality.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('get_quote') }}" class="btn btn-warning btn-lg fw-bold px-5">
                            <i class="bi bi-send me-2"></i>Get Free Consultation
                        </a>
                        <a href="{{ route('how_it_works') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-play-circle me-2"></i>How It Works
                        </a>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-shield-check" style="color:#4ade80;"></i> Dedicated case manager
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-translate" style="color:#60a5fa;"></i> Multilingual support
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-airplane" style="color:#fbbf24;"></i> Travel & visa assistance
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-patch-check-fill" style="color:#a78bfa;"></i> Verified, accredited hospitals
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-headset" style="color:#f9a8d4;"></i> 24/7 Patient assistance
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-file-medical" style="color:#fbbf24;"></i> Free expert medical opinions
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-lightning-charge-fill" style="color:#f472b6;"></i> Fast inquiry response
                        </span>
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.35rem 0.85rem;font-size:0.8rem;font-weight:600;color:#fff;">
                            <i class="bi bi-bar-chart-line-fill" style="color:#34d399;"></i> Price comparison
                        </span>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3"><i class="bi bi-chat-text me-2 text-primary"></i>Get a Free Consultation</h5>
                            <form action="{{ route('inquiries.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="first_name" placeholder="Your Name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" placeholder="Email Address" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <select name="country_of_residence" class="form-select">
                                        <option value="">Select Country</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Canada</option>
                                        <option>Australia</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                        <option>UAE</option>
                                        <option>Saudi Arabia</option>
                                        <option>Kuwait</option>
                                        <option>Nigeria</option>
                                        <option>Kenya</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="phone" placeholder="Phone Number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <select name="specialty_id" class="form-select">
                                        <option value="">Select Specialty</option>
                                        @foreach(\App\Models\Specialty::published()->ordered()->get() as $sp)
                                            <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea name="condition_description" placeholder="Describe your condition or treatment needed" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg fw-bold">Submit Inquiry</button>
                                </div>
                                <p class="text-muted small text-center mt-2 mb-0">
                                    By submitting the form I agree to the <a href="{{ route('terms') }}" class="text-primary text-decoration-none">Terms of Use</a> and <a href="{{ route('privacy_policy') }}" class="text-primary text-decoration-none">Privacy Policy</a>.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-2">Simple Process</span>
            <h2 class="fw-bold">How It Works</h2>
            <p class="text-muted">Your journey to better health in 4 simple steps</p>
        </div>
        <div class="row g-4">
            @foreach([
                ['step'=>'1','icon'=>'bi-send','color'=>'primary','title'=>'Submit Inquiry','desc'=>'Fill out our simple form with your medical needs and contact details.'],
                ['step'=>'2','icon'=>'bi-file-medical','color'=>'success','title'=>'Receive Treatment Plan','desc'=>'Our experts review your case and send you a personalised treatment plan with costs.'],
                ['step'=>'3','icon'=>'bi-airplane','color'=>'warning','title'=>'Travel to India','desc'=>'We arrange your visa, airport pickup, accommodation and hospital appointment.'],
                ['step'=>'4','icon'=>'bi-heart-pulse','color'=>'danger','title'=>'Treatment & Recovery','desc'=>'Receive world-class treatment and enjoy full post-operative support from our team.'],
            ] as $step)
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="bg-{{ $step['color'] }} bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                        <i class="bi {{ $step['icon'] }} fs-2 text-{{ $step['color'] }}"></i>
                    </div>
                    <div class="badge bg-{{ $step['color'] }} mb-2">{{ $step['step'] }}</div>
                    <h5 class="fw-bold">{{ $step['title'] }}</h5>
                    <p class="text-muted small">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Medical Specialties</h2>
                <p class="text-muted mb-0">Explore our comprehensive range of medical specialties</p>
            </div>
            <a href="{{ route('specialties.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row g-3">
            @foreach($specialties as $specialty)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('specialties.show', $specialty->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm text-center p-3 h-100 specialty-card hover-lift">
                        <div class="mb-2" style="height:56px;display:flex;align-items:center;justify-content:center;">
                            @if($specialty->icon_svg)
                                <div style="max-height:56px;max-width:100%;">{!! $specialty->icon_svg !!}</div>
                            @else
                                <i class="bi {{ $specialty->icon_class ?: 'bi-heart-pulse' }} fs-2 text-primary"></i>
                            @endif
                        </div>
                        <div class="fw-semibold small">{{ $specialty->name }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Top Partner Hospitals</h2>
                <p class="text-muted mb-0">JCI &amp; NABH accredited hospitals across India</p>
            </div>
            <a href="{{ route('hospitals.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row g-4">
            @foreach($hospitals as $hospital)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('hospitals.show', $hospital->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:160px;overflow:hidden;">
                            @if($hospital->featured_image_url)
                                <img src="{{ $hospital->featured_image_url }}" alt="{{ $hospital->name }}" class="img-fluid" style="object-fit:cover;width:100%;height:100%;">
                            @else
                                <i class="bi bi-hospital text-muted" style="font-size:3rem;"></i>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-1 mb-2">
                                @if($hospital->is_jci_accredited)
                                    <span class="badge bg-success-subtle text-success small">JCI</span>
                                @endif
                                @if($hospital->is_nabh_accredited)
                                    <span class="badge bg-primary-subtle text-primary small">NABH</span>
                                @endif
                            </div>
                            <h6 class="fw-bold text-dark mb-1">{{ $hospital->name }}</h6>
                            <div class="text-muted small">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $hospital->city->name ?? '' }}{{ ($hospital->city && $hospital->country) ? ', ' : '' }}{{ $hospital->country->name ?? '' }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Expert Doctors</h2>
                <p class="text-muted mb-0">Internationally trained specialists</p>
            </div>
            <a href="{{ route('doctors.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row g-4">
            @foreach($doctors as $doctor)
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('doctors.show', $doctor->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 hover-lift">
                        <div class="mx-auto mb-3" style="width:80px;height:80px;border-radius:50%;overflow:hidden;background:#e9ecef;">
                            @if($doctor->photo_url)
                                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->full_name }}" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <i class="bi bi-person-fill text-muted" style="font-size:3rem;line-height:80px;"></i>
                            @endif
                        </div>
                        <h6 class="fw-bold text-dark mb-1">{{ $doctor->full_name }}</h6>
                        <div class="text-muted small mb-1">{{ $doctor->specialties->first()?->name }}</div>
                        <div class="text-muted small">{{ $doctor->experience_years }} yrs experience</div>
                        @if($doctor->online_consultation)
                            <span class="badge bg-success-subtle text-success mt-2">Online Consultation</span>
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if($packages->count())
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Treatment Packages</h2>
                <p class="text-muted mb-0">All-inclusive packages for popular treatments</p>
            </div>
            <a href="{{ route('packages.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row g-4">
            @foreach($packages as $pkg)
            <div class="col-md-4">
                <a href="{{ route('packages.show', $pkg->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <span class="badge bg-primary-subtle text-primary mb-2">{{ $pkg->specialty?->name }}</span>
                            <h5 class="fw-bold text-dark mb-2">{{ $pkg->name }}</h5>
                            <p class="text-muted small mb-3">{{ $pkg->tagline }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-primary fw-bold fs-5">From ${{ number_format($pkg->price_usd_from) }}</div>
                                    <div class="text-muted small">{{ $pkg->duration_days_min }}–{{ $pkg->duration_days_max }} days</div>
                                </div>
                                <span class="btn btn-outline-primary btn-sm">View Details</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose Us</h2>
            <p class="text-muted">Everything you need for a successful medical journey</p>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon'=>'bi-cash-coin','color'=>'success','title'=>'Save Up to 70%','desc'=>'Get the same quality treatment at a fraction of the cost compared to Western countries.'],
                ['icon'=>'bi-award','color'=>'warning','title'=>'JCI Accredited Hospitals','desc'=>'All partner hospitals meet international quality standards with JCI or NABH accreditation.'],
                ['icon'=>'bi-person-lines-fill','color'=>'primary','title'=>'Dedicated Case Manager','desc'=>'A personal coordinator guides you every step of the way from inquiry to recovery.'],
                ['icon'=>'bi-airplane-fill','color'=>'info','title'=>'Travel & Visa Support','desc'=>'We assist with visa letters, airport transfers, hotel bookings and local transport.'],
                ['icon'=>'bi-translate','color'=>'success','title'=>'Multilingual Support','desc'=>'Our team speaks 10+ languages to ensure clear communication throughout your journey.'],
                ['icon'=>'bi-shield-check','color'=>'primary','title'=>'Verified Reviews','desc'=>'Authentic patient testimonials from people who have completed their treatment with us.'],
            ] as $f)
            <div class="col-md-4">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                        <div class="bg-{{ $f['color'] }} bg-opacity-10 rounded-3 p-3">
                            <i class="bi {{ $f['icon'] }} fs-4 text-{{ $f['color'] }}"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">{{ $f['title'] }}</h6>
                        <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if($testimonials->count())
<section class="py-5 bg-primary bg-opacity-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Patient Stories</h2>
            <p class="text-muted">Real experiences from patients around the world</p>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <div class="d-flex gap-1 mb-3 text-warning">
                        {{ str_repeat('★', $testimonial->rating) }}
                    </div>
                    <blockquote class="mb-3 text-muted fst-italic">"{{ $testimonial->short_quote }}"</blockquote>
                    <div class="d-flex align-items-center gap-3 mt-auto">
                        @if($testimonial->photo_url)
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->patient_name }}" class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;">
                                {{ strtoupper(substr($testimonial->patient_name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="fw-semibold small">{{ $testimonial->patient_name }}</div>
                            <div class="text-muted small">{{ $testimonial->country }} • {{ $testimonial->treatment }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('patient_stories') }}" class="btn btn-outline-primary">Read All Stories</a>
        </div>
    </div>
</section>
@endif

@if($blogPosts->count())
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Health & Travel Blog</h2>
                <p class="text-muted mb-0">Expert advice on medical tourism and treatments</p>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row g-4">
            @foreach($blogPosts as $post)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    @if($post->featured_image_url)
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="card-img-top" style="height:180px;object-fit:cover;">
                    @endif
                    <div class="card-body">
                        @if($post->category)
                            <span class="badge bg-primary-subtle text-primary mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h6 class="fw-bold">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                        </h6>
                        <p class="text-muted small">{{ Str::limit($post->excerpt, 100) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 small text-muted">
                        <i class="bi bi-clock me-1"></i>{{ $post->read_time_minutes }} min read •
                        {{ $post->published_at?->format('M d, Y') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section style="background: linear-gradient(rgba(10,20,45,0.75), rgba(10,20,45,0.75)), url('https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=1920&q=80') 50% 30%/cover no-repeat; padding: 5rem 0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3 text-white">Ready to Start Your Medical Journey?</h2>
        <p class="lead mb-4" style="color:rgba(255,255,255,0.75);">Get a free consultation from our medical experts today.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('get_quote') }}" class="btn btn-warning btn-lg fw-bold px-5">
                <i class="bi bi-send me-2"></i>Get Free Quote
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-5">
                <i class="bi bi-chat me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>

@endsection
