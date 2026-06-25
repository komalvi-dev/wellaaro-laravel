@extends('layouts.app')

@section('title', 'For Healthcare Providers')

@section('content')
<div class="bg-primary text-white py-5">
    <div class="container py-3">
        <h1 class="fw-bold display-5">For Healthcare Providers</h1>
        <p class="lead opacity-75 mb-0">Partner with us to reach international patients</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Why Partner with Us?</h2>
                <p class="text-muted mb-4">Join our network of premier healthcare providers and gain access to a steady stream of international patients actively seeking quality medical care in India.</p>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0 me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                    <div><strong>Verified International Patients</strong> — We pre-qualify all patients before connecting them to your facility.</div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0 me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                    <div><strong>Streamlined Communication</strong> — Our platform manages all pre-arrival coordination, documentation, and follow-up.</div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0 me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                    <div><strong>Marketing & Visibility</strong> — Your hospital is featured prominently across our platform and marketing channels.</div>
                </div>
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                    <div><strong>Performance Analytics</strong> — Track inquiries, conversions, and revenue through your hospital dashboard.</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Interested in Partnering?</h5>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subject" value="Provider Partnership Inquiry">
                            <div class="mb-3">
                                <label class="form-label">Hospital / Clinic Name</label>
                                <input type="text" name="name" class="form-control" required placeholder="Your hospital name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="3" placeholder="Tell us about your facility and specialties..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Partnership Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
