@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Contact Us</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Contact</li></ol></nav>
    </div>
</div>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Send us a Message</h5>
                    <form action="{{ route('contact.create') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject *</label>
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message *</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-2"></i>Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <h5 class="fw-bold mb-4">Get in Touch</h5>
            <div class="d-flex gap-3 mb-3"><div class="text-primary mt-1"><i class="fas fa-envelope fa-lg"></i></div><div><strong>Email</strong><br><a href="mailto:info@medtourism.com" class="text-muted">info@medtourism.com</a></div></div>
            <div class="d-flex gap-3 mb-3"><div class="text-primary mt-1"><i class="fas fa-phone fa-lg"></i></div><div><strong>Phone</strong><br><a href="tel:+919876543210" class="text-muted">+91 98765 43210</a></div></div>
            <div class="d-flex gap-3 mb-3"><div class="text-primary mt-1"><i class="fab fa-whatsapp fa-lg"></i></div><div><strong>WhatsApp</strong><br><span class="text-muted">+91 98765 43210</span></div></div>
            <div class="d-flex gap-3"><div class="text-primary mt-1"><i class="fas fa-map-marker-alt fa-lg"></i></div><div><strong>Office</strong><br><span class="text-muted">123 Medical Hub, Mumbai 400001, India</span></div></div>
            <div class="mt-4 p-3 bg-primary-subtle rounded">
                <h6 class="fw-semibold mb-2">For Medical Queries</h6>
                <p class="small text-muted mb-2">For detailed medical consultations, please use our inquiry form for faster response.</p>
                <a href="{{ route('get_quote') }}" class="btn btn-primary btn-sm">Get Free Quote</a>
            </div>
        </div>
    </div>
</div>
@endsection
