@extends('layouts.app')

@section('title', 'Hospital Accreditations')

@section('content')
<div class="bg-primary text-white py-5">
    <div class="container py-3">
        <h1 class="fw-bold display-5">Accreditations & Certifications</h1>
        <p class="lead opacity-75 mb-0">We partner only with internationally accredited hospitals</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <p class="lead text-muted">All hospitals in our network hold internationally recognized certifications that guarantee the highest standards of patient care, safety, and clinical excellence.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3 fw-bold" style="width:50px;height:50px;">JCI</div>
                            <div>
                                <h5 class="fw-bold mb-0">Joint Commission International</h5>
                                <small class="text-muted">Gold Standard in Global Healthcare</small>
                            </div>
                        </div>
                        <p class="text-muted mb-0">JCI accreditation is the most respected global certification for hospital quality and patient safety. Our partner hospitals meet the same standards as the world's leading medical centers.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3 fw-bold" style="width:50px;height:50px;">NABH</div>
                            <div>
                                <h5 class="fw-bold mb-0">National Accreditation Board for Hospitals</h5>
                                <small class="text-muted">India's Premier Hospital Accreditation</small>
                            </div>
                        </div>
                        <p class="text-muted mb-0">NABH is India's prestigious accreditation body under the Quality Council of India, ensuring hospitals maintain the highest domestic and international standards.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3 fw-bold" style="width:50px;height:50px;">ISO</div>
                            <div>
                                <h5 class="fw-bold mb-0">ISO 9001:2015 Certified</h5>
                                <small class="text-muted">Quality Management Systems</small>
                            </div>
                        </div>
                        <p class="text-muted mb-0">ISO certification ensures hospitals maintain consistent quality management systems, continuous improvement, and patient-centered service delivery.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3 fw-bold" style="width:50px;height:50px;">NABL</div>
                            <div>
                                <h5 class="fw-bold mb-0">National Accreditation Board for Laboratories</h5>
                                <small class="text-muted">Diagnostic Excellence</small>
                            </div>
                        </div>
                        <p class="text-muted mb-0">NABL-accredited laboratories in our partner hospitals ensure the highest accuracy and reliability in diagnostic testing and pathology.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('hospitals.index') }}" class="btn btn-primary btn-lg px-5">View Accredited Hospitals</a>
        </div>
    </div>
</section>
@endsection
