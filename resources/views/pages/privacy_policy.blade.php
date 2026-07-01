@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h1 class="fw-bold mb-1">{{ __('Privacy Policy') }}</h1>
      <p class="text-muted mb-4">{{ __('Last updated: May 2026') }}</p>

      <div class="card border-0 shadow-sm p-4">

        <h5 class="fw-bold mt-4 mb-2">{{ __('1. Information We Collect') }}</h5>
        <p class="text-muted">{{ __('We collect information you provide directly — including your name, email address, phone number, country of residence, and medical condition details when you submit an inquiry. We also collect usage data such as pages visited, time spent, and referring URLs through cookies and analytics tools.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('2. How We Use Your Information') }}</h5>
        <p class="text-muted">{{ __('Your personal and medical information is used solely to match you with appropriate hospitals and doctors, prepare treatment quotes, coordinate your care journey, and for related hospital communications and support services. We do not sell, rent, or share your information with third parties outside our vetted hospital network without your explicit consent.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('3. Medical Information') }}</h5>
        <p class="text-muted">{{ __('Medical records and health information you share are treated with the highest level of confidentiality. This information is shared only with the specific hospitals and healthcare providers you choose to engage with, strictly for the purpose of providing you with treatment quotes and care.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('4. Data Security') }}</h5>
        <p class="text-muted">{{ __('We employ industry-standard security measures including SSL encryption, secure servers, and access controls. Only authorised staff can access patient information, and all access is logged and audited.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('5. Cookies') }}</h5>
        <p class="text-muted">{{ __('We use cookies to improve your browsing experience, remember your preferences, and analyse site traffic. You can disable cookies in your browser settings, though this may affect some functionality.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('6. Your Rights') }}</h5>
        <p class="text-muted">{{ __('You have the right to access, correct, or delete your personal data at any time. To exercise these rights, contact us at') }} <a href="mailto:care@wellaaro.com" class="text-primary text-decoration-none">care@wellaaro.com</a>. {{ __('We will respond within 30 days.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __("7. Children's Privacy") }}</h5>
        <p class="text-muted">{{ __('Wellaaro may provide coordination and facilitation services for patients under the age of 18 through their parent, legal guardian, or authorised representative. We do not knowingly collect personal information directly from children without the consent of a parent or legal guardian.') }}</p>
        <p class="text-muted">{{ __('Any medical records, personal information, or treatment-related details relating to a minor will only be processed for the purpose of facilitating medical care and treatment coordination, and only with appropriate parental or guardian authorisation.') }}</p>
        <p class="text-muted">{{ __("Parents or legal guardians may contact us at any time to review, update, or request deletion of a minor's personal information, subject to applicable legal and medical record retention requirements.") }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('8. Changes to This Policy') }}</h5>
        <p class="text-muted">{{ __('We may update this Privacy Policy periodically. We will notify you of significant changes via email or a prominent notice on our website. Continued use of our services after changes constitutes acceptance of the updated policy.') }}</p>

        <h5 class="fw-bold mt-4 mb-2">{{ __('9. Contact Us') }}</h5>
        <p class="text-muted">{{ __('For any privacy-related questions or concerns, please contact our Data Protection Officer at') }} <a href="mailto:care@wellaaro.com" class="text-primary text-decoration-none">care@wellaaro.com</a> {{ __('or write to us at our registered address.') }}</p>

      </div>
    </div>
  </div>
</div>
@endsection
