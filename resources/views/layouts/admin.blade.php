<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title', 'Dashboard') | {{ config('app.name', 'MedTourism') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        .sidebar { width: 260px; min-height: 100vh; background: #1a1a2e; position: fixed; top: 0; left: 0; z-index: 1000; overflow-y: auto; }
        .sidebar .brand { padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar .brand a { color: #fff; font-weight: 700; font-size: 1.2rem; text-decoration: none; }
        .sidebar .nav-link { color: rgba(255,255,255,.75); padding: .5rem 1.5rem; font-size: .875rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.1); border-radius: 4px; }
        .sidebar .nav-section { padding: .75rem 1.5rem .25rem; font-size: .7rem; text-transform: uppercase; letter-spacing: .08em; color: rgba(255,255,255,.4); }
        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: .75rem 1.5rem; position: sticky; top: 0; z-index: 999; }
        .content-area { padding: 1.5rem; }
        .stat-card { border: 0; border-radius: 12px; }
        .stat-card .icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        @include('admin.shared.sidebar')
        <div class="main-content flex-grow-1">
            @include('admin.shared.topbar')
            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error') || session('alert'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') ?? session('alert') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @stack('scripts')
</body>
</html>
