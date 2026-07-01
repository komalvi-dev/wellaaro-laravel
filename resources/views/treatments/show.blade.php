@extends('layouts.app')
@section('title', $treatment->name)
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <nav aria-label="{{ __('breadcrumb') }}"><ol class="breadcrumb small mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item"><a href="{{ route('treatments.index') }}">{{ __('Treatments') }}</a></li><li class="breadcrumb-item active">{{ $treatment->name }}</li></ol></nav>
        <h1 class="h2 fw-bold">{{ $treatment->name }}</h1>
        @if($treatment->specialty)<span class="badge bg-primary">{{ $treatment->specialty->name }}</span>@endif
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            @if($treatment->featured_image_url)
            <div class="mb-4 text-center bg-light rounded shadow-sm" style="max-height:420px;overflow:hidden;">
                <img src="{{ $treatment->featured_image_url }}" alt="{{ $treatment->name }}" class="img-fluid" style="max-height:420px;width:auto;">
            </div>
            @endif
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3 mb-4">
                        @if($treatment->recovery_time)<div class="col-6 col-md-3 text-center"><div class="text-muted small">{{ __('Recovery') }}</div><div class="fw-semibold">{{ $treatment->recovery_time }}</div></div>@endif
                        @if($treatment->hospital_stay)<div class="col-6 col-md-3 text-center"><div class="text-muted small">{{ __('Hospital Stay') }}</div><div class="fw-semibold">{{ $treatment->hospital_stay }}</div></div>@endif
                        @if($treatment->success_rate)<div class="col-6 col-md-3 text-center"><div class="text-muted small">{{ __('Success Rate') }}</div><div class="fw-semibold">{{ $treatment->success_rate }}</div></div>@endif
                    </div>
                    @if($treatment->description)<div>{!! nl2br(e($treatment->description)) !!}</div>@endif
                </div>
            </div>
            @if($treatment->procedure_details)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Procedure Details') }}</div>
                <div class="card-body">{!! nl2br(e($treatment->procedure_details)) !!}</div>
            </div>
            @endif
            @if($treatment->cost_india_min || $treatment->cost_usa)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Cost Comparison') }}</div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light"><tr><th>{{ __('Country') }}</th><th>{{ __('Estimated Cost') }}</th><th>{{ __('Savings vs. USA') }}</th></tr></thead>
                        <tbody>
                            @if($treatment->cost_india_min)
                            <tr class="table-success">
                                <td><strong>{{ __('India') }}</strong> <span class="badge bg-success ms-1">{{ __('Best Value') }}</span></td>
                                <td class="fw-bold text-success">${{ number_format($treatment->cost_india_min) }} - ${{ number_format($treatment->cost_india_max ?? $treatment->cost_india_min) }}</td>
                                <td>{{ __('Save up to :percent%', ['percent' => $treatment->cost_savings_percent ?? '70']) }}</td>
                            </tr>
                            @endif
                            @if($treatment->cost_usa)<tr><td>{{ __('USA') }}</td><td>${{ number_format($treatment->cost_usa) }}</td><td>-</td></tr>@endif
                            @if($treatment->cost_uk)<tr><td>{{ __('UK') }}</td><td>${{ number_format($treatment->cost_uk) }}</td><td>-</td></tr>@endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if(isset($faqs) && $faqs->count())
            <h5 class="fw-bold mb-3">{{ __('FAQs') }}</h5>
            <div class="accordion" id="faqAcc">
                @foreach($faqs as $i => $faq)
                <div class="accordion-item border-0 shadow-sm mb-2">
                    <h2 class="accordion-header"><button class="accordion-button {{ $i>0?'collapsed':'' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">{{ $faq->question }}</button></h2>
                    <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i===0?'show':'' }}" data-bs-parent="#faqAcc"><div class="accordion-body text-muted">{{ $faq->answer }}</div></div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center">
                    <h6 class="fw-bold">{{ __('Get a Free Quote') }}</h6>
                    <p class="text-muted small">{{ __('Get cost estimates from top hospitals for') }} {{ $treatment->name }}</p>
                    <a href="{{ route('get_quote') }}?treatment_id={{ $treatment->id }}" class="btn btn-primary w-100 mb-2">{{ __('Request Quote') }}</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary w-100 btn-sm">{{ __('Ask a Question') }}</a>
                </div>
            </div>
            @if(isset($doctors) && $doctors->count())
            <h6 class="fw-bold mb-2">{{ __('Top Doctors') }}</h6>
            @foreach($doctors->take(3) as $doctor)
            <a href="{{ route('doctors.show', $doctor->slug) }}" class="text-decoration-none">
                <div class="card card-hover border-0 shadow-sm mb-2">
                    <div class="card-body py-2 px-3 d-flex align-items-center gap-2">
                        @if($doctor->photo_url)<img src="{{ $doctor->photo_url }}" class="rounded-circle" width="40" height="40" style="object-fit:cover;">@else<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;min-width:40px;">{{ substr($doctor->first_name,0,1) }}</div>@endif
                        <div><div class="fw-semibold small">{{ $doctor->full_name }}</div><div class="text-muted small">{{ $doctor->experience_years }} {{ __('yrs exp.') }}</div></div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
