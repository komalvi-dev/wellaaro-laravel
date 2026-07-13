<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('locales.available.' . app()->getLocale() . '.rtl') ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Wellaaro')) - Medical Tourism India</title>
    <meta name="description" content="@yield('meta_description', 'World-class medical treatments in India at affordable prices.')">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <meta name="theme-color" content="#1a6bcc">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    @if(config('locales.available.' . app()->getLocale() . '.rtl'))
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; color: #374151; line-height: 1.6; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', 'Inter', sans-serif; }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.12) !important; }
        #main-header { position: sticky; top: 0; z-index: 1030; background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        #header-top { border-bottom: 1px solid #f0f0f0; padding: 0.55rem 0; }
        #header-top .header-search .input-group-text { background: #f8f9fa; border-right: none; border-radius: 8px 0 0 8px; color: #9ca3af; }
        #header-top .header-search .form-control { background: #f8f9fa; border-left: none; border-radius: 0 8px 8px 0; font-size: 0.875rem; }
        #header-top .header-search .form-control:focus { box-shadow: none; border-color: #dee2e6; background: #fff; }
        #header-top .btn-quote { background: #1a6bcc; color: #fff; font-weight: 600; font-size: 0.875rem; padding: 0.45rem 1.1rem; border-radius: 8px; border: none; white-space: nowrap; text-decoration: none; transition: background 0.15s; }
        #header-top .btn-quote:hover { background: #1559aa; color: #fff; }
        #header-nav { padding: 0; background: #1e293b; }
        #header-nav .nav-link { font-size: 0.875rem; font-weight: 500; color: rgba(255,255,255,0.88); padding: 0.7rem 0.75rem; border-bottom: 2px solid transparent; border-radius: 0; transition: color 0.15s, border-color 0.15s; white-space: nowrap; }
        #header-nav .nav-link:hover, #header-nav .nav-link.active { color: #fff; border-bottom-color: rgba(255,255,255,0.7); }
        #header-nav .dropdown-menu { border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15); border-radius: 12px; margin-top: 0; }
        #header-nav .lang-btn { font-size: 0.8125rem; color: rgba(255,255,255,0.88); border: 1px solid rgba(255,255,255,0.35); padding: 0.35rem 0.75rem; border-radius: 20px; background: transparent; font-weight: 500; white-space: nowrap; }
        #header-nav .lang-btn:hover { background: rgba(255,255,255,0.12); color: #fff; }
        @media (min-width: 992px) { #header-nav { display: block; } #mobile-toggle { display: none !important; } }
        @media (max-width: 991px) { #header-nav { display: none; } #header-nav.nav-open { display: block; } #header-nav .container { flex-direction: column; align-items: flex-start; padding: 0.5rem 1rem 1rem; } #header-nav .nav { flex-direction: column; width: 100%; } #header-nav .nav-link { padding: 0.6rem 0; border-bottom: none; border-top: 1px solid rgba(255,255,255,0.12); } #header-nav .dropdown-menu { position: static !important; transform: none !important; box-shadow: none; padding-left: 1rem; } #header-top .header-search { display: none !important; } }
        .user-pill { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.3rem 0.65rem 0.3rem 0.3rem; border: 1px solid #e5e7eb; border-radius: 20px; background: transparent; cursor: pointer; font-size: 0.875rem; font-weight: 500; color: #374151; transition: background 0.15s; }
        .user-pill:hover { background: #f9fafb; }
        .user-pill .avatar { width: 26px; height: 26px; border-radius: 50%; background: #1a6bcc; color: #fff; font-size: 0.7rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .hero-section::before { content: ''; position: absolute; inset: 0; pointer-events: none; }
        .text-white-75 { color: rgba(255,255,255,0.75); }
        .specialty-card { cursor: pointer; transition: all 0.2s; }
        .specialty-card:hover { background: #e8f0fb !important; border-color: #1a6bcc !important; transform: translateY(-3px); }
        .patient-dashboard-body { background: #f8fafc; }
        .patient-sidebar { width: 240px; min-height: 100vh; position: sticky; top: 0; height: 100vh; overflow-y: auto; }
        .patient-sidebar .nav-link { border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.875rem; }
        .patient-sidebar .nav-link.active, .patient-sidebar .nav-link:hover { background: #dbeafe; color: #1a6bcc !important; }
        .admin-body { background: #f1f5f9; font-size: 0.875rem; }
        .admin-sidebar { position: sticky; top: 0; height: 100vh; overflow-y: auto; }
        .admin-sidebar .nav-link { border-radius: 6px; padding: 0.45rem 0.75rem; font-size: 0.8125rem; }
        .admin-sidebar .nav-link.active, .admin-sidebar .nav-link:hover { background: rgba(255,255,255,0.1); color: #fff !important; }
        .admin-sidebar small { font-size: 0.65rem; color: rgba(255,255,255,0.35); }
        #admin-content { min-height: 100vh; }
        .admin-main { max-width: 1400px; }
        .form-control, .form-select { border-radius: 8px; border-color: #d1d5db; }
        .form-control:focus, .form-select:focus { border-color: #1a6bcc; box-shadow: 0 0 0 3px rgba(26,107,204,0.1); }
        .form-step { animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .badge { font-weight: 500; letter-spacing: 0.3px; }
        .table th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; font-weight: 600; }
        .table td { vertical-align: middle; }
        .card { border-radius: 12px; }
        footer a:hover { color: #fff !important; }
    </style>
    @stack('styles')
    @php
        $orgAddressParts = array_map('trim', explode(',', \App\Models\SiteSetting::get('address', 'Ahmedabad, Gujarat, India')));
        $orgSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => \App\Models\SiteSetting::get('site_name', config('app.name', 'Wellaaro')),
            'url' => config('app.url'),
            'logo' => asset('images/logo.jpeg'),
            'description' => \App\Models\SiteSetting::get('meta_description', \App\Models\SiteSetting::get('site_tagline', '')),
            'email' => \App\Models\SiteSetting::get('contact_email', 'care@wellaaro.com'),
            'telephone' => \App\Models\SiteSetting::get('phone', '+91 72111 36620'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $orgAddressParts[0] ?? null,
                'addressRegion' => $orgAddressParts[1] ?? null,
                'addressCountry' => $orgAddressParts[2] ?? null,
            ],
            'sameAs' => [
                'https://youtube.com/@wellaaro?si=Y7W0cnBxgeSXk0i-',
                'https://www.facebook.com/share/1BsY6LNm38/?mibextid=wwXIfr',
                'https://x.com/wellaaro?s=11',
                'https://www.instagram.com/wellaaro_?igsh=dzMwaXNwN210dWxu&utm_source=qr',
                'https://www.threads.com/@wellaaro_?igshid=NTc4MTIwNjQ2YQ==',
                'https://www.linkedin.com/in/harsh-panara-0a1479410?utm_source=share_via&utm_content=profile&utm_medium=member_ios',
                'https://wa.me/917211136620',
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($orgSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</head>
<body>
    @include('shared.navbar')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error') || session('alert'))
        <div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container">{{ session('error') ?? session('alert') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('shared.footer')

    @include('shared.chat-widget')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function() {
        window.cookieconsent.initialise({
            palette: {
                popup: {
                    background: "#252e39"
                },
                button: {
                    background: "#14a7d0"
                }
            },
            theme: "classic",
            position: "bottom",
            content: {
                message: "{{ __('We use cookies to enhance your browsing experience and personalise content.') }}",
                dismiss: "{{ __('Accept All') }}",
                link: "{{ __('Learn more') }}",
                href: "/privacy-policy"
            }
        });
    });
    </script>
    @stack('scripts')
</body>
</html>
