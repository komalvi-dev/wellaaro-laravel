@extends('layouts.app')

@section('title', $condition->name)
@section('meta_description', $condition->meta_description ?? "Learn about {$condition->name} and treatment options available in India.")

@section('content')
<div class="bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active">{{ $condition->name }}</li>
            </ol>
        </nav>
        <x-breadcrumb-schema :items="[
            ['name' => __('Home'), 'url' => route('home')],
            ['name' => $condition->name],
        ]" />
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3">{{ $condition->name }}</h1>

                @if($condition->description)
                <div class="lead text-muted mb-4">
                    {!! nl2br(e($condition->description)) !!}
                </div>
                @endif

                @if($condition->content)
                <div class="mb-5">
                    {!! $condition->content !!}
                </div>
                @endif

                @if($condition->treatments && $condition->treatments->isNotEmpty())
                <div class="mt-5">
                    <h3 class="fw-bold mb-4">{{ __('Available Treatments') }}</h3>
                    <div class="row g-3">
                        @foreach($condition->treatments as $treatment)
                        <div class="col-sm-6">
                            <a href="{{ route('treatments.show', $treatment) }}" class="card border-0 shadow-sm text-decoration-none card-hover">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-dark mb-1">{{ $treatment->name }}</h6>
                                    @if($treatment->description)
                                    <p class="text-muted small mb-0 text-truncate">{{ $treatment->description }}</p>
                                    @endif
                                    @if($treatment->cost_from)
                                    <div class="text-primary fw-semibold small mt-2">
                                        {{ __('From') }} ${{ number_format($treatment->cost_from, 0) }}
                                    </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4 text-center">
                        <div class="text-primary mb-3"><i class="fas fa-user-md fa-3x"></i></div>
                        <h6 class="fw-bold mb-2">{{ __('Get Expert Opinion') }}</h6>
                        <p class="text-muted small mb-3">{{ __('Connect with our specialists for a personalized treatment plan.') }}</p>
                        <a href="{{ route('get_quote') }}" class="btn btn-primary w-100">{{ __('Get Free Quote') }}</a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="text-success mb-3"><i class="fab fa-whatsapp fa-3x"></i></div>
                        <h6 class="fw-bold mb-2">{{ __('Chat with Us') }}</h6>
                        <p class="text-muted small mb-3">{{ __('Have questions? Chat with our medical team on WhatsApp.') }}</p>
                        <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="btn btn-success w-100">
                            <i class="fab fa-whatsapp me-1"></i>{{ __('WhatsApp Us') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
