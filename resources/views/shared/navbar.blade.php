<header id="main-header">

    <div id="header-top">
        <div class="container d-flex align-items-center gap-3">

            <a href="{{ route('home') }}" class="flex-shrink-0 d-flex align-items-center">
                <img src="/images/image_with_context.jpeg" style="height:52px;width:auto;object-fit:contain;" alt="Logo">
            </a>

            <form action="{{ route('search') }}" method="get" role="search"
                  class="header-search flex-grow-1" style="max-width:460px;">
                <div class="input-group">
                    <span class="input-group-text border-end-0">
                        <i class="bi bi-search" style="font-size:0.875rem;"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" type="search" name="q"
                           placeholder="{{ __('Search treatments, hospitals, doctors…') }}"
                           aria-label="Search">
                </div>
            </form>

            <div class="ms-auto d-flex align-items-center gap-2 flex-shrink-0">

                <a href="{{ route('get_quote') }}" class="btn-quote d-none d-md-inline-block">{{ __('Get a Free Quote') }}</a>

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
                                        <i class="bi bi-grid text-primary"></i> {{ __('Dashboard') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-shield-check text-secondary"></i> {{ __('Admin Panel') }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('patient.dashboard') }}" class="dropdown-item d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-grid text-primary"></i> {{ __('Dashboard') }}
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger border-0 bg-transparent w-100 text-start">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Sign out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary d-none d-md-inline-block">{{ __('Login') }}</a>
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
                    <a href="{{ route('home') }}" class="nav-link">{{ __('Home') }}</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Treatments') }}
                    </a>
                    <div class="dropdown-menu p-3" style="min-width:580px;">
                        <div class="row g-1">
                            @foreach(\App\Models\Specialty::published()->featured()->ordered()->limit(8)->get() as $navSpecialty)
                                <div class="col-6">
                                    <a href="{{ route('specialties.show', $navSpecialty->slug) }}" class="dropdown-item rounded py-1 d-flex align-items-center">
                                        @if($navSpecialty->featured_image_url)
                                            <img src="{{ $navSpecialty->featured_image_url }}" alt="" style="width:20px;height:20px;object-fit:cover;border-radius:3px;" class="me-2">
                                        @endif
                                        {{ $navSpecialty->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <hr class="my-2">
                        <a href="{{ route('treatments.index') }}" class="dropdown-item fw-semibold text-primary">{{ __('View All Treatments') }}</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Hospitals') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('hospitals.index') }}" class="dropdown-item">{{ __('Top Partner Hospitals') }}</a></li>
                        <li><a href="{{ route('hospitals.index') }}" class="dropdown-item">{{ __('By Specialty') }}</a></li>
                        <li><a href="{{ route('hospitals.index') }}?jci=1" class="dropdown-item">{{ __('JCI Accredited') }}</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('doctors.index') }}" class="nav-link">{{ __('Doctors') }}</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('why_india') }}" class="nav-link">{{ __('Why India') }}</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blog.index') }}" class="nav-link">{{ __('Blog') }}</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link">{{ __('About Us') }}</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">{{ __('Contact') }}</a>
                </li>
            </ul>

            <div class="dropdown lang-switcher d-none d-lg-block">
                <button class="lang-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe2 me-1"></i>{{ config('locales.available.' . app()->getLocale() . '.flag') }} {{ config('locales.available.' . app()->getLocale() . '.name') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach(config('locales.available') as $code => $lang)
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['locale' => $code]) }}"
                               class="dropdown-item {{ app()->getLocale() === $code ? 'active fw-semibold' : '' }}">
                                {{ $lang['flag'] }} {{ $lang['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="d-block d-lg-none w-100 mt-2 pt-2" style="border-top:1px solid rgba(255,255,255,0.15);">
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isCaseManager())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="bi bi-grid me-2"></i>{{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('patient.dashboard') }}" class="nav-link">
                            <i class="bi bi-grid me-2"></i>{{ __('Dashboard') }}
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent text-start w-100">
                            <i class="bi bi-box-arrow-right me-2"></i>{{ __('Sign out') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('get_quote') }}" class="nav-link fw-semibold">
                        <i class="bi bi-file-earmark-text me-2"></i>{{ __('Get a Free Quote') }}
                    </a>
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="bi bi-person me-2"></i>{{ __('Login') }}
                    </a>
                @endauth

                <div class="pt-2 mt-1" style="border-top:1px solid rgba(255,255,255,0.12);">
                    <div class="px-0 py-1" style="font-size:0.75rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;">{{ __('Language') }}</div>
                    <div class="d-flex flex-wrap gap-2 pb-1">
                        @foreach(config('locales.available') as $code => $lang)
                            <a href="{{ request()->fullUrlWithQuery(['locale' => $code]) }}"
                               class="lang-btn {{ app()->getLocale() === $code ? 'active' : '' }}" style="{{ app()->getLocale() === $code ? 'background:rgba(255,255,255,0.18);' : '' }}">
                                {{ $lang['flag'] }} {{ $lang['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

</header>
