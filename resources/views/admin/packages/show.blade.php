@extends('layouts.admin')
@section('title', $package->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $package->name }}</h1>
    <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>

<div class="row g-4">

    {{-- Left column: content --}}
    <div class="col-md-8">

        {{-- Featured image --}}
        @if($package->featured_image_url)
        <div class="mb-4">
            <img src="{{ $package->featured_image_url }}" alt="{{ $package->name }}" class="img-fluid rounded shadow-sm" style="max-height:320px;object-fit:cover;width:100%;">
        </div>
        @endif

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-medium">Package Details</div>
            <div class="card-body">
                @if($package->tagline)
                    <p class="text-muted fw-semibold mb-2">{{ $package->tagline }}</p>
                @endif
                @if($package->description)
                    <p class="mb-0">{!! nl2br(e($package->description)) !!}</p>
                @endif
            </div>
        </div>

        {{-- Highlights --}}
        @if(!empty($package->highlights))
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-medium">Highlights</div>
            <div class="card-body">
                <ul class="mb-0 ps-3">
                    @foreach($package->highlights as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Inclusions & Exclusions --}}
        @if(!empty($package->inclusions) || !empty($package->exclusions))
        <div class="row g-3 mb-4">
            @if(!empty($package->inclusions))
            <div class="col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white fw-medium">Inclusions</div>
                    <div class="card-body">
                        <ul class="mb-0 ps-3">
                            @foreach($package->inclusions as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @if(!empty($package->exclusions))
            <div class="col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white fw-medium">Exclusions</div>
                    <div class="card-body">
                        <ul class="mb-0 ps-3">
                            @foreach($package->exclusions as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Itinerary --}}
        @if(!empty($package->itinerary))
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-medium">Itinerary</div>
            <div class="card-body">
                @foreach($package->itinerary as $index => $day)
                <div class="{{ !$loop->last ? 'mb-3 pb-3 border-bottom' : '' }}">
                    <strong>Day {{ $index + 1 }}{{ isset($day['title']) ? ': ' . $day['title'] : '' }}</strong>
                    @if(isset($day['description']))<p class="mb-0 mt-1 text-muted small">{{ $day['description'] }}</p>@endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Treatments --}}
        @if($package->treatments->isNotEmpty())
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-medium">Treatments</div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    @foreach($package->treatments as $treatment)
                        <span class="badge bg-info text-dark">{{ $treatment->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- Right column: meta --}}
    <div class="col-md-4">

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-medium">Summary</div>
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">Status</dt>
                    <dd>
                        <span class="badge {{ $package->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $package->published ? 'Published' : 'Draft' }}
                        </span>
                        @if($package->featured)
                            <span class="badge bg-primary ms-1">Featured</span>
                        @endif
                    </dd>

                    <dt class="small text-muted mt-2">Package Type</dt>
                    <dd>{{ $package->package_type ? ucfirst(str_replace('_', ' ', $package->package_type)) : '—' }}</dd>

                    <dt class="small text-muted mt-2">Destination</dt>
                    <dd>{{ $package->destination?->name ?? '—' }}</dd>

                    <dt class="small text-muted mt-2">Specialty</dt>
                    <dd>{{ $package->specialty?->name ?? '—' }}</dd>

                    <dt class="small text-muted mt-2">Hospital</dt>
                    <dd>{{ $package->hospital?->name ?? '—' }}</dd>

                    <dt class="small text-muted mt-2">Duration</dt>
                    <dd>
                        @if($package->duration_days_min && $package->duration_days_max)
                            @if($package->duration_days_min === $package->duration_days_max)
                                {{ $package->duration_days_min }} {{ Str::plural('day', $package->duration_days_min) }}
                            @else
                                {{ $package->duration_days_min }}–{{ $package->duration_days_max }} days
                            @endif
                        @elseif($package->duration_days_min)
                            From {{ $package->duration_days_min }} {{ Str::plural('day', $package->duration_days_min) }}
                        @elseif($package->duration_days_max)
                            Up to {{ $package->duration_days_max }} {{ Str::plural('day', $package->duration_days_max) }}
                        @else
                            —
                        @endif
                    </dd>

                    <dt class="small text-muted mt-2">Price From</dt>
                    <dd>{{ $package->price_usd_from ? '$' . number_format($package->price_usd_from) : '—' }}</dd>

                    @if($package->price_note)
                    <dt class="small text-muted mt-2">Price Note</dt>
                    <dd class="text-muted small">{{ $package->price_note }}</dd>
                    @endif

                    <dt class="small text-muted mt-2">Position</dt>
                    <dd>{{ $package->position }}</dd>
                </dl>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-medium">SEO</div>
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">Slug</dt>
                    <dd class="font-monospace small">{{ $package->slug }}</dd>

                    <dt class="small text-muted mt-2">Meta Title</dt>
                    <dd>{{ $package->meta_title ?: '—' }}</dd>

                    <dt class="small text-muted mt-2">Meta Description</dt>
                    <dd class="text-muted small">{{ $package->meta_description ?: '—' }}</dd>

                    <dt class="small text-muted mt-2">Meta Keywords</dt>
                    <dd class="text-muted small">{{ $package->meta_keywords ?: '—' }}</dd>
                </dl>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-medium">Timestamps</div>
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">Created</dt>
                    <dd class="small">{{ $package->created_at->format('d M Y, H:i') }}</dd>
                    <dt class="small text-muted mt-2">Updated</dt>
                    <dd class="small">{{ $package->updated_at->format('d M Y, H:i') }}</dd>
                </dl>
            </div>
        </div>

    </div>
</div>
@endsection
