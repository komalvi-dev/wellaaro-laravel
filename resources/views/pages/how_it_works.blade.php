@extends('layouts.app')
@section('title', 'How It Works')
@section('content')
<div class="bg-light py-5">
    <div class="container text-center">
        <h1 class="h2 fw-bold mb-2">How It Works</h1>
        <p class="text-muted">Your journey to better health in 5 simple steps</p>
    </div>
</div>
<div class="container py-5">
    @php $steps = [['Send Inquiry','Fill out our simple inquiry form with your medical condition and requirements. Our team reviews your case within hours.','fas fa-paper-plane','bg-primary'],['Receive Consultation','Get a free consultation from our medical coordinators who will recommend the best hospitals and doctors for your case.','fas fa-comments','bg-success'],['Get Quotation','Receive detailed cost quotations from multiple top hospitals, allowing you to compare and choose the best option.','fas fa-file-invoice-dollar','bg-info'],['Plan Your Trip','We handle all logistics including visa support, flight coordination, accommodation booking, and airport transfers.','fas fa-plane','bg-warning'],['Treatment & Recovery','Arrive for your treatment with full support throughout your hospital stay and recovery period, plus post-treatment follow-up.','fas fa-heartbeat','bg-danger']]; @endphp
    @foreach($steps as $i => $step)
    <div class="row align-items-center g-4 mb-5 {{ $i%2==1 ? 'flex-row-reverse' : '' }}">
        <div class="col-md-6">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="{{ $step[3] }} text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width:48px;height:48px;min-width:48px;font-size:1.2rem;">{{ $i+1 }}</div>
                <h3 class="fw-bold mb-0">{{ $step[0] }}</h3>
            </div>
            <p class="text-muted lead">{{ $step[1] }}</p>
        </div>
        <div class="col-md-6 text-center">
            <div class="{{ $step[3] }}-subtle rounded-3 p-5">
                <i class="{{ $step[2] }} fa-5x" style="color:var(--bs-primary);opacity:.4;"></i>
            </div>
        </div>
    </div>
    @endforeach
    <div class="text-center mt-4">
        <a href="{{ route('get_quote') }}" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane me-2"></i>Start Your Journey Today</a>
    </div>
</div>
@endsection
