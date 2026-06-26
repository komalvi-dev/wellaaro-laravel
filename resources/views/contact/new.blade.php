@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="text-center mb-5">
          <h1 class="display-6 fw-bold">Get in Touch</h1>
        </div>

        <div class="row g-5">
          <div class="col-lg-4">
            <div class="d-flex flex-column gap-4">
              <div class="d-flex gap-3">
                <div class="flex-shrink-0">
                  <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                       style="width:50px;height:50px;">
                    <i class="bi bi-telephone-fill text-primary"></i>
                  </div>
                </div>
                <div>
                  <h6 class="fw-bold mb-1">Phone / WhatsApp</h6>
                  <p class="text-muted small mb-0">+91 72111 36620</p>
                </div>
              </div>

              <div class="d-flex gap-3">
                <div class="flex-shrink-0">
                  <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                       style="width:50px;height:50px;">
                    <i class="bi bi-envelope-fill text-primary"></i>
                  </div>
                </div>
                <div>
                  <h6 class="fw-bold mb-1">Email</h6>
                  <p class="text-muted small">info@wellaaro.com</p>
                </div>
              </div>

              <div class="d-flex gap-3">
                <div class="flex-shrink-0">
                  <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                       style="width:50px;height:50px;">
                    <i class="bi bi-clock-fill text-primary"></i>
                  </div>
                </div>
                <div>
                  <h6 class="fw-bold mb-2">Working Hours</h6>
                  <table class="table table-sm table-borderless mb-0" style="font-size:0.8125rem;">
                    <tr>
                      <td class="ps-0 text-muted py-1">Monday</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">9am – 8pm</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">Tuesday</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">9am – 8pm</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">Wednesday</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">9am – 8pm</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">Thursday</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">9am – 8pm</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">Friday</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">9am – 8pm</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">Saturday</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">9am – 8pm</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">Sunday</td>
                      <td class="text-end pe-0 py-1 text-danger fw-medium">Closed</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
              <h3 class="h5 fw-bold mb-4">Send us a Message</h3>
              <form action="{{ route('contact.store') }}" method="POST" class="needs-validation">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="John Doe">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="john@example.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Phone</label>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 234 567 8900">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country') }}" placeholder="Your country">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-medium">Subject <span class="text-danger">*</span></label>
                    <select name="subject" class="form-select @error('subject') is-invalid @enderror" required>
                      <option value="">Select subject</option>
                      @foreach(["General Inquiry", "Treatment Information", "Cost Estimation", "Appointment Booking", "Travel Assistance", "Other"] as $option)
                        <option value="{{ $option }}" {{ old('subject') === $option ? 'selected' : '' }}>{{ $option }}</option>
                      @endforeach
                    </select>
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-medium">Message <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required placeholder="Tell us about your medical needs...">{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
                    <p class="text-muted small mt-2 mb-0">
                      By submitting the form I agree to the <a href="{{ route('terms') }}" class="text-primary text-decoration-none">Terms of Use</a> and <a href="{{ route('privacy_policy') }}" class="text-primary text-decoration-none">Privacy Policy</a> of Wellaaro Health.
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
