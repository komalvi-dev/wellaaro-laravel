<nav class="sidebar d-flex flex-column">
    <div class="brand">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-heartbeat me-2"></i>{{ config('app.name', 'Wellaaro') }}</a>
        <div class="text-white-50 small mt-1">Admin Panel</div>
    </div>
    <div class="flex-grow-1 py-2">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>

        <div class="nav-section">Inquiries</div>
        <a href="{{ route('admin.inquiries.index') }}" class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
            <i class="fas fa-file-medical me-2"></i>Inquiries
        </a>
        <a href="{{ route('admin.patients.index') }}" class="nav-link {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
            <i class="fas fa-users me-2"></i>Patients
        </a>
        <a href="{{ route('admin.appointments.index') }}" class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt me-2"></i>Appointments
        </a>

        <div class="nav-section">Medical</div>
        <a href="{{ route('admin.hospitals.index') }}" class="nav-link {{ request()->routeIs('admin.hospitals.*') ? 'active' : '' }}">
            <i class="fas fa-hospital me-2"></i>Hospitals
        </a>
        <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
            <i class="fas fa-user-md me-2"></i>Doctors
        </a>
        <a href="{{ route('admin.specialties.index') }}" class="nav-link {{ request()->routeIs('admin.specialties.*') ? 'active' : '' }}">
            <i class="fas fa-stethoscope me-2"></i>Specialties
        </a>
        <a href="{{ route('admin.treatments.index') }}" class="nav-link {{ request()->routeIs('admin.treatments.*') ? 'active' : '' }}">
            <i class="fas fa-pills me-2"></i>Treatments
        </a>
        <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
            <i class="fas fa-box-open me-2"></i>Packages
        </a>
        <a href="{{ route('admin.destinations.index') }}" class="nav-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
            <i class="fas fa-map-marked-alt me-2"></i>Destinations
        </a>

        <div class="nav-section">Content</div>
        <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
            <i class="fas fa-blog me-2"></i>Blog Posts
        </a>
        <a href="{{ route('admin.blog-categories.index') }}" class="nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags me-2"></i>Blog Categories
        </a>
        <a href="{{ route('admin.cms-pages.index') }}" class="nav-link {{ request()->routeIs('admin.cms-pages.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i>CMS Pages
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
            <i class="fas fa-question-circle me-2"></i>FAQs
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="fas fa-star me-2"></i>Testimonials
        </a>

        <div class="nav-section">System</div>
        <a href="{{ route('admin.staff.index') }}" class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
            <i class="fas fa-id-badge me-2"></i>Staff
        </a>
        <a href="{{ route('admin.newsletter-subscribers.index') }}" class="nav-link {{ request()->routeIs('admin.newsletter-subscribers.*') ? 'active' : '' }}">
            <i class="fas fa-envelope me-2"></i>Newsletter
        </a>
        <a href="{{ route('admin.reports.inquiries') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar me-2"></i>Reports
        </a>
        <a href="{{ route('admin.settings.show') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fas fa-cog me-2"></i>Settings
        </a>
        <a href="{{ route('admin.audit-logs.index') }}" class="nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
            <i class="fas fa-history me-2"></i>Audit Logs
        </a>
    </div>
</nav>
