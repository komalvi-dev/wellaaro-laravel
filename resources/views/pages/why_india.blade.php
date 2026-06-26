@extends('layouts.app')

@section('title', 'Why Choose India for Medical Treatment')
@section('meta_description', 'India offers world-class healthcare at 60-80% lower costs. JCI-accredited hospitals, internationally trained doctors, zero waiting times.')

@section('content')
<div class="bg-primary py-5 text-white">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2">Why Choose India for Medical Treatment?</h1>
        <p class="lead opacity-90">World-class care at a fraction of Western costs — discover why 700,000+ patients choose India every year.</p>
    </div>
</div>

<div class="container py-5">

    <!-- Key Stats -->
    <div class="row g-4 mb-5">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center h-100 p-3">
                <i class="bi bi-currency-dollar fs-1 text-success mb-2"></i>
                <div class="fs-3 fw-bold">60–80%</div>
                <div class="text-muted small">Cost Savings vs USA/UK</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center h-100 p-3">
                <i class="bi bi-people-fill fs-1 text-primary mb-2"></i>
                <div class="fs-3 fw-bold">700K+</div>
                <div class="text-muted small">International Patients/Year</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center h-100 p-3">
                <i class="bi bi-building-check fs-1 text-warning mb-2"></i>
                <div class="fs-3 fw-bold">25+</div>
                <div class="text-muted small">JCI Accredited Hospitals</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center h-100 p-3">
                <i class="bi bi-clock fs-1 text-info mb-2"></i>
                <div class="fs-3 fw-bold">Zero</div>
                <div class="text-muted small">Waiting Time</div>
            </div>
        </div>
    </div>

    <!-- Reasons -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-4">Top Reasons to Choose India</h2>

            <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-patch-check-fill text-primary"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">World-Class Accreditation</h6>
                    <p class="text-muted small mb-0">India has more JCI-accredited hospitals than any other Asian country. Apollo, Fortis, Medanta, and Manipal are globally recognised for clinical excellence.</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-mortarboard-fill text-success"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Internationally Trained Doctors</h6>
                    <p class="text-muted small mb-0">Over 50,000 Indian doctors have trained or practiced in the USA, UK, or Europe. Many hold dual board certifications and publish in top medical journals.</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-translate text-warning"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">English-Speaking Medical Staff</h6>
                    <p class="text-muted small mb-0">India is the world's second-largest English-speaking country. All top hospitals communicate fully in English with international patients.</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-activity text-danger"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Advanced Technology</h6>
                    <p class="text-muted small mb-0">Indian hospitals invest heavily in the latest medical technology — robotic surgery, proton therapy, 3D laparoscopy, and AI-assisted diagnostics.</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-globe-americas text-info"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Holistic Wellness Options</h6>
                    <p class="text-muted small mb-0">Combine your treatment with yoga, Ayurveda, and wellness retreats. India offers a unique mind-body recovery experience unavailable elsewhere.</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-airplane-fill text-secondary"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Easy Accessibility</h6>
                    <p class="text-muted small mb-0">Direct flights from the USA, UK, Middle East, Africa, and Southeast Asia. Medical visas are fast-tracked with our assistance in under 2 weeks.</p>
                </div>
            </div>
        </div>

        <!-- Cost Comparison -->
        <div class="col-lg-6">
            <h2 class="fw-bold mb-4">Cost Comparison</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Procedure</th>
                                <th>USA</th>
                                <th>India</th>
                                <th class="text-success">Savings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-medium">Heart Bypass (CABG)</td>
                                <td class="text-danger">$80,000</td>
                                <td class="text-success fw-semibold">$6,000–9,000</td>
                                <td><span class="badge bg-success">90%</span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Knee Replacement</td>
                                <td class="text-danger">$45,000</td>
                                <td class="text-success fw-semibold">$4,000–6,000</td>
                                <td><span class="badge bg-success">88%</span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Hip Replacement</td>
                                <td class="text-danger">$40,000</td>
                                <td class="text-success fw-semibold">$5,000–7,000</td>
                                <td><span class="badge bg-success">85%</span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">IVF (per cycle)</td>
                                <td class="text-danger">$15,000</td>
                                <td class="text-success fw-semibold">$2,500–4,000</td>
                                <td><span class="badge bg-success">80%</span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Spinal Fusion</td>
                                <td class="text-danger">$60,000</td>
                                <td class="text-success fw-semibold">$5,000–8,000</td>
                                <td><span class="badge bg-success">87%</span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Liver Transplant</td>
                                <td class="text-danger">$300,000</td>
                                <td class="text-success fw-semibold">$25,000–40,000</td>
                                <td><span class="badge bg-success">90%</span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Dental Implant</td>
                                <td class="text-danger">$3,500</td>
                                <td class="text-success fw-semibold">$500–800</td>
                                <td><span class="badge bg-success">80%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="text-muted small mt-2">* Approximate figures. Exact costs depend on hospital, complexity, and individual case.</p>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-primary rounded-4 text-white text-center p-5">
        <h3 class="fw-bold mb-2">Ready to Explore Your Treatment Options?</h3>
        <p class="mb-4 opacity-90">Get a free personalised quote from top Indian hospitals within 24 hours.</p>
        <a href="{{ route('get_quote') }}" class="btn btn-light btn-lg fw-bold px-5">Get Free Quote</a>
    </div>

</div>
@endsection
