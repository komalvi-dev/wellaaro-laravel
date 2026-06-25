@extends('layouts.app')
@section('title', 'Terms & Conditions')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Terms & Conditions</h1>
        <p class="text-muted mb-0">Last updated: {{ date('F j, Y') }}</p>
    </div>
</div>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h5 class="fw-bold">1. Acceptance of Terms</h5>
                    <p class="text-muted">By accessing and using our medical tourism facilitation services, you accept and agree to be bound by these Terms and Conditions. If you do not agree, please do not use our services.</p>

                    <h5 class="fw-bold mt-4">2. Services Description</h5>
                    <p class="text-muted">We are a medical tourism facilitation company. We connect patients with hospitals and doctors. We do not provide medical advice, diagnosis, or treatment. All medical decisions remain with the patient and their chosen healthcare providers.</p>

                    <h5 class="fw-bold mt-4">3. Patient Responsibilities</h5>
                    <ul class="text-muted">
                        <li>Provide accurate and complete medical information</li>
                        <li>Obtain necessary travel documents and visas</li>
                        <li>Secure adequate travel and medical insurance</li>
                        <li>Follow all medical advice given by treating physicians</li>
                        <li>Inform us promptly of any changes to your condition or plans</li>
                    </ul>

                    <h5 class="fw-bold mt-4">4. Our Role as Facilitator</h5>
                    <p class="text-muted">We act solely as an intermediary between patients and healthcare providers. We do not guarantee medical outcomes. The medical treatment is provided by the hospital/doctor, not by us. We are not liable for any medical malpractice or negligence by healthcare providers.</p>

                    <h5 class="fw-bold mt-4">5. Quotations and Pricing</h5>
                    <p class="text-muted">Cost quotations provided are estimates based on information available at the time. Final costs may vary based on the patient's specific medical condition, length of stay, complications, and exchange rate fluctuations. Quotations are valid for 30 days unless otherwise stated.</p>

                    <h5 class="fw-bold mt-4">6. Cancellation Policy</h5>
                    <p class="text-muted">Cancellations must be notified in writing. Refund policies vary by hospital and service provider. Our facilitation fees are non-refundable once services have been rendered. We recommend purchasing comprehensive travel insurance.</p>

                    <h5 class="fw-bold mt-4">7. Privacy and Data Protection</h5>
                    <p class="text-muted">We handle your personal and medical information in accordance with our <a href="{{ route('privacy_policy') }}">Privacy Policy</a>. Medical information is shared only with the healthcare providers you choose and only as necessary for your treatment.</p>

                    <h5 class="fw-bold mt-4">8. Limitation of Liability</h5>
                    <p class="text-muted">Our liability is limited to the facilitation fees paid to us. We are not liable for medical outcomes, travel disruptions, accommodation issues, or any consequential damages arising from the use of our services.</p>

                    <h5 class="fw-bold mt-4">9. Governing Law</h5>
                    <p class="text-muted">These terms are governed by the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts of New Delhi, India.</p>

                    <h5 class="fw-bold mt-4">10. Contact</h5>
                    <p class="text-muted mb-0">For questions about these terms, contact us at <a href="mailto:legal@medtourism.com">legal@medtourism.com</a> or visit our <a href="{{ route('contact') }}">contact page</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
