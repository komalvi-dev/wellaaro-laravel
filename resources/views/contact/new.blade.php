@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="text-center mb-5">
          <h1 class="display-6 fw-bold">{{ __('Get in Touch') }}</h1>
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
                  <h6 class="fw-bold mb-1">{{ __('Phone / WhatsApp') }}</h6>
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
                  <h6 class="fw-bold mb-1">{{ __('Email') }}</h6>
                  <p class="text-muted small">care@wellaaro.com</p>
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
                  <h6 class="fw-bold mb-2">{{ __('Working Hours') }}</h6>
                  <table class="table table-sm table-borderless mb-0" style="font-size:0.8125rem;">
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Monday') }}</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">{{ __('9am – 8pm') }}</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Tuesday') }}</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">{{ __('9am – 8pm') }}</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Wednesday') }}</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">{{ __('9am – 8pm') }}</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Thursday') }}</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">{{ __('9am – 8pm') }}</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Friday') }}</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">{{ __('9am – 8pm') }}</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Saturday') }}</td>
                      <td class="text-end pe-0 py-1 fw-medium text-dark">{{ __('9am – 8pm') }}</td>
                    </tr>
                    <tr>
                      <td class="ps-0 text-muted py-1">{{ __('Sunday') }}</td>
                      <td class="text-end pe-0 py-1 text-danger fw-medium">{{ __('Closed') }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
              <h3 class="h5 fw-bold mb-4">{{ __('Send us a Message') }}</h3>
              <form action="{{ route('contact.store') }}" method="POST" class="needs-validation">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-medium">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="{{ __('John Doe') }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="john@example.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">{{ __('Phone') }}</label>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 234 567 8900">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-medium">{{ __('Country') }}</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country') }}" placeholder="{{ __('Your country') }}">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-medium">{{ __('Subject') }} <span class="text-danger">*</span></label>
                    <select name="subject" class="form-select @error('subject') is-invalid @enderror" required>
                      <option value="">{{ __('Select subject') }}</option>
                      @foreach(["General Inquiry", "Treatment Information", "Cost Estimation", "Appointment Booking", "Travel Assistance", "Other"] as $option)
                        <option value="{{ $option }}" {{ old('subject') === $option ? 'selected' : '' }}>{{ __($option) }}</option>
                      @endforeach
                    </select>
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-medium">{{ __('Message') }} <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required placeholder="{{ __('Tell us about your medical needs...') }}">{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg px-5">{{ __('Send Message') }}</button>
                    <p class="text-muted small mt-2 mb-0">
                      {{ __('By submitting the form I agree to the') }} <a href="{{ route('terms') }}" class="text-primary text-decoration-none">{{ __('Terms of Use') }}</a> {{ __('and') }} <a href="{{ route('privacy_policy') }}" class="text-primary text-decoration-none">{{ __('Privacy Policy') }}</a> {{ __('of Wellaaro Health.') }}
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
