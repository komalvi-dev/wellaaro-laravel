<div class="topbar d-flex justify-content-between align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            @yield('breadcrumb')
        </ol>
    </nav>
    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="btn btn-sm btn-light position-relative" data-bs-toggle="dropdown">
                <i class="fas fa-bell"></i>
                @php $unread = auth()->user()->unreadNotificationsCount(); @endphp
                @if($unread > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.6rem;">{{ $unread }}</span>
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="min-width:300px;">
                <li class="dropdown-header">Notifications</li>
                <li><div class="dropdown-item text-muted small">No new notifications</div></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->full_name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item small" href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i>View Site</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item small"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
