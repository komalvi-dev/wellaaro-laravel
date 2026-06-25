@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">Privacy Policy</h1>
        <p class="text-muted mb-0">Last updated: {{ date('F j, Y') }}</p>
    </div>
</div>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h5 class="fw-bold">1. Information We Collect</h5>
                    <p class="text-muted">We collect information you provide directly to us, including:</p>
                    <ul class="text-muted">
                        <li><strong>Personal Information:</strong> Name, email address, phone number, nationality, date of birth</li>
                        <li><strong>Medical Information:</strong> Medical condition, treatment history, diagnostic reports uploaded by you</li>
                        <li><strong>Financial Information:</strong> Payment details processed through our secure payment gateway</li>
                        <li><strong>Travel Information:</strong> Passport details, visa information, travel dates</li>
                        <li><strong>Usage Data:</strong> Pages visited, search queries, device and browser information</li>
                    </ul>

                    <h5 class="fw-bold mt-4">2. How We Use Your Information</h5>
                    <p class="text-muted">We use your information to:</p>
                    <ul class="text-muted">
                        <li>Facilitate your medical treatment arrangements</li>
                        <li>Communicate with hospitals and doctors on your behalf</li>
                        <li>Process payments and send billing information</li>
                        <li>Send appointment reminders and treatment updates</li>
                        <li>Improve our services and user experience</li>
                        <li>Comply with legal obligations</li>
                    </ul>

                    <h5 class="fw-bold mt-4">3. Information Sharing</h5>
                    <p class="text-muted">We share your information only with:</p>
                    <ul class="text-muted">
                        <li><strong>Healthcare Providers:</strong> Hospitals and doctors you choose for treatment (medical information only)</li>
                        <li><strong>Service Partners:</strong> Visa agencies, accommodation providers, transportation services (relevant details only)</li>
                        <li><strong>Legal Requirements:</strong> When required by law or legal process</li>
                    </ul>
                    <p class="text-muted">We never sell your personal information to third parties.</p>

                    <h5 class="fw-bold mt-4">4. Data Security</h5>
                    <p class="text-muted">We implement industry-standard security measures including SSL encryption, secure data storage, and access controls. Medical documents are encrypted at rest and in transit. Only authorized staff can access medical information on a need-to-know basis.</p>

                    <h5 class="fw-bold mt-4">5. Data Retention</h5>
                    <p class="text-muted">We retain your personal data for as long as your account is active or as needed to provide services. Medical records are retained for 7 years as required by applicable regulations. You may request deletion of your data subject to legal retention requirements.</p>

                    <h5 class="fw-bold mt-4">6. Your Rights</h5>
                    <p class="text-muted">You have the right to:</p>
                    <ul class="text-muted">
                        <li>Access the personal information we hold about you</li>
                        <li>Correct inaccurate information</li>
                        <li>Request deletion of your data (subject to legal obligations)</li>
                        <li>Withdraw consent for non-essential communications</li>
                        <li>Lodge a complaint with data protection authorities</li>
                    </ul>

                    <h5 class="fw-bold mt-4">7. Cookies</h5>
                    <p class="text-muted">We use cookies to improve your browsing experience, remember your preferences, and analyze site traffic. You can control cookie settings through your browser. Disabling cookies may affect some functionality.</p>

                    <h5 class="fw-bold mt-4">8. Contact Us</h5>
                    <p class="text-muted mb-0">For privacy-related requests or questions, contact our Data Protection Officer at <a href="mailto:privacy@medtourism.com">privacy@medtourism.com</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
