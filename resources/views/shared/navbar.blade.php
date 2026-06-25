<header id="main-header">

    <div id="header-top">
        <div class="container d-flex align-items-center gap-3">

            <a href="{{ route('home') }}" class="flex-shrink-0 d-flex align-items-center">
                <img src="/images/image_with_context.jpeg" style="height:38px;width:auto;object-fit:contain;" alt="Logo">
            </a>

            <form action="{{ route('search') }}" method="get" role="search"
                  class="header-search flex-grow-1" style="max-width:460px;">
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <i class="bi bi-search" style="font-size:0.875rem;"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" type="search" name="q"
                           placeholder="Search treatments, hospitals, doctors…"
                           aria-label="Search">
                </div>
            </form>

            <div class="ms-auto d-flex align-items-center gap-2 flex-shrink-0">

                <a href="{{ route('get_quote') }}" class="btn-quote d-none d-md-inline-block">Get a Free Quote</a>

                @auth
                    <div class="dropdown">
                        <button class="user-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="avatar">
                                {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->email, 0, 1)) }}
                            </span>
                            <span class="d-none d-md-inline" style="max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                {{ auth()->user()->full_name ?? auth()->user()->email }}
                            </span>
                            <i class="bi bi-chevron-down" style="font-size:0.65rem;color:#9ca3af;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="min-width:210px;">
                            <li>
                                <div class="px-3 py-2 border-bottom">
                                    <div class="fw-semibold text-dark" style="font-size:0.875rem;">{{ auth()->user()->full_name ?? 'Account' }}</div>
                                    <div class="text-muted" style="font-size:0.75rem;">{{ auth()->user()->email }}</div>
                                </div>
                            </li>
                            @if(auth()->user()->isAdmin() || auth()->user()->isCaseManager())
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-grid text-primary"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-shield-check text-secondary"></i> Admin Panel
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('patient.dashboard') }}" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-grid text-primary"></i> Dashboard
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger border-0 bg-transparent w-100 text-start">
                                        <i class="bi bi-box-arrow-right"></i> Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary d-none d-md-inline-block">Login</a>
                @endauth

                <button id="mobile-toggle" class="btn btn-sm border-0 p-1" type="button"
                        aria-label="Toggle navigation" onclick="document.getElementById('header-nav').classList.toggle('nav-open')">
                    <i class="bi bi-list" style="font-size:1.4rem;color:#374151;"></i>
                </button>

            </div>
        </div>
    </div>

    <div id="header-nav">
        <div class="container d-flex align-items-center justify-content-between">

            <ul class="nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Treatments
                    </a>
                    <div class="dropdown-menu p-3" style="min-width:580px;">
                        <div class="row g-1">
                            @foreach(\App\Models\Specialty::published()->featured()->ordered()->limit(8)->get() as $navSpecialty)
                                <div class="col-6">
                                    <a href="{{ route('specialties.show', $navSpecialty->slug) }}" class="dropdown-item rounded py-1">
                                        @if($navSpecialty->icon_class)
                                            <i class="bi {{ $navSpecialty->icon_class }} me-2 text-primary"></i>
                                        @endif
                                        {{ $navSpecialty->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <hr class="my-2">
                        <a href="{{ route('treatments.index') }}" class="dropdown-item fw-semibold text-primary">View All Treatments</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Hospitals
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('hospitals.index') }}" class="dropdown-item">Top Partner Hospitals</a></li>
                        <li><a href="{{ route('hospitals.index') }}" class="dropdown-item">By Specialty</a></li>
                        <li><a href="{{ route('hospitals.index') }}?jci=1" class="dropdown-item">JCI Accredited</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('doctors.index') }}" class="nav-link">Doctors</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('why_india') }}" class="nav-link">Why India</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link">About Us</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>
            </ul>

            <div class="d-block d-lg-none w-100 mt-2 pt-2" style="border-top:1px solid rgba(255,255,255,0.15);">
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isCaseManager())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="bi bi-grid me-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('patient.dashboard') }}" class="nav-link">
                            <i class="bi bi-grid me-2"></i>Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent text-start w-100">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign out
                        </button>
                    </form>
                @else
                    <a href="{{ route('get_quote') }}" class="nav-link fw-semibold">
                        <i class="bi bi-file-earmark-text me-2"></i>Get a Free Quote
                    </a>
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="bi bi-person me-2"></i>Login
                    </a>
                @endauth
            </div>

        </div>
    </div>

</header>
