<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4 pb-4 border-bottom border-secondary">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('home') }}">
                    <img src="/images/logo.jpeg" class="rounded mb-3" style="height:80px;width:auto;object-fit:contain;" alt="Logo">
                </a>
                <p class="text-white small">Connecting patients worldwide with world-class healthcare at affordable costs. Your trusted medical tourism partner.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="https://youtube.com/@wellaaro?si=Y7W0cnBxgeSXk0i-" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.facebook.com/share/1BsY6LNm38/?mibextid=wwXIfr" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="https://x.com/wellaaro?s=11" class="text-white fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.instagram.com/wellaaro_?igsh=dzMwaXNwN210dWxu&utm_source=qr" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.threads.com/@wellaaro_?igshid=NTc4MTIwNjQ2YQ==" class="text-white fs-5"><i class="bi bi-threads"></i></a>
                    <a href="https://www.linkedin.com/in/harsh-panara-0a1479410?utm_source=share_via&utm_content=profile&utm_medium=member_ios" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="https://wa.me/917211136620" class="text-white fs-5" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-semibold text-white mb-3">Patient Support</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1"><a href="{{ route('travel_guide') }}" class="text-white text-decoration-none">Travel Guide</a></li>
                    <li class="mb-1"><a href="{{ route('faq') }}" class="text-white text-decoration-none">FAQ</a></li>
                    <li class="mb-1"><a href="{{ route('patient_stories') }}" class="text-white text-decoration-none">Patient Testimonials</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-semibold text-white mb-3">Company / Discover</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1"><a href="{{ route('services') }}" class="text-white text-decoration-none">Our Services</a></li>
                    <li class="mb-1"><a href="{{ route('how_it_works') }}" class="text-white text-decoration-none">How It Works</a></li>
                    <li class="mb-1"><a href="{{ route('accreditations') }}" class="text-white text-decoration-none">Accreditations</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-semibold text-white mb-3">Contact Us</h6>
                <ul class="list-unstyled small text-white">
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i>care@wellaaro.com</li>
                    <li class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i><a href="https://wa.me/917211136620" class="text-white text-decoration-none" target="_blank" rel="noopener">+91 72111 36620</a></li>
                </ul>
            </div>

            <div class="col-12">
                <p class="small text-secondary">Note: Wellaaro Health does not provide medical advice, diagnosis or treatment. The services and information offered on www.Wellaaro.com are intended solely for informational purposes and cannot replace the professional consultation or treatment by a physician. Wellaaro Health discourages copying, cloning of its webpages and its content and it will follow the legal procedures to protect its intellectual property.</p>
            </div>
        </div>

        <div class="row mt-3 align-items-center">
            <div class="col-md-6 small text-white">
                &copy; {{ date('Y') }} Wellaaro. All rights reserved.
            </div>
            <div class="col-md-6 text-md-end small">
                <a href="{{ route('privacy_policy') }}" class="text-white me-3">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-white me-3">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
