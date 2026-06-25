<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Patient Portal - @yield('title', 'Dashboard') | {{ config('app.name', 'MedTourism') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        .patient-sidebar { width: 240px; min-height: 100vh; background: #fff; border-right: 1px solid #e5e7eb; position: fixed; top: 0; left: 0; z-index: 1000; }
        .patient-sidebar .brand { padding: 1.25rem 1.5rem; border-bottom: 1px solid #e5e7eb; }
        .patient-sidebar .nav-link { color: #374151; padding: .6rem 1.5rem; font-size: .875rem; border-radius: 6px; margin: 2px 8px; }
        .patient-sidebar .nav-link:hover, .patient-sidebar .nav-link.active { background: #eff6ff; color: #1d4ed8; }
        .patient-sidebar .nav-link i { width: 20px; }
        .patient-main { margin-left: 240px; min-height: 100vh; }
        .patient-topbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: .75rem 1.5rem; }
        .patient-content { padding: 1.5rem; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <nav class="patient-sidebar">
            <div class="brand">
                <a href="{{ route('home') }}" class="text-decoration-none text-primary fw-bold">
                    <i class="fas fa-heartbeat me-2"></i>{{ config('app.name', 'MedTourism') }}
                </a>
            </div>
            <div class="py-3">
                <a href="{{ route('patient.dashboard') }}" class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="{{ route('patient.inquiries.index') }}" class="nav-link {{ request()->routeIs('patient.inquiries.*') ? 'active' : '' }}">
                    <i class="fas fa-file-medical me-2"></i>My Inquiries
                </a>
                <a href="{{ route('patient.quotations.index') }}" class="nav-link {{ request()->routeIs('patient.quotations.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar me-2"></i>My Quotations
                </a>
                <a href="{{ route('patient.appointments.index') }}" class="nav-link {{ request()->routeIs('patient.appointments.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check me-2"></i>Appointments
                </a>
                <a href="{{ route('patient.medical_records.index') }}" class="nav-link {{ request()->routeIs('patient.medical_records.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open me-2"></i>Medical Records
                </a>
                <a href="{{ route('patient.payments.index') }}" class="nav-link {{ request()->routeIs('patient.payments.*') ? 'active' : '' }}">
                    <i class="fas fa-credit-card me-2"></i>Payments
                </a>
                <a href="{{ route('patient.profile.show') }}" class="nav-link {{ request()->routeIs('patient.profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle me-2"></i>My Profile
                </a>
                <hr class="mx-3">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-globe me-2"></i>Back to Site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link w-100 text-start">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </nav>
        <div class="patient-main flex-grow-1">
            <div class="patient-topbar d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-muted">@yield('title', 'Dashboard')</h6>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small">{{ auth()->user()->full_name }}</span>
                </div>
            </div>
            <div class="patient-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
