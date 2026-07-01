@extends('layouts.patient')

@section('title', 'Inquiry #' . $inquiry->reference_number)

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('patient.inquiries.index') }}" class="btn btn-sm btn-light">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <h5 class="fw-bold mb-0">Inquiry #{{ $inquiry->reference_number }}</h5>
    <span class="badge {{ $inquiry->statusBadgeClass() }}">{{ ucfirst(str_replace('_', ' ', $inquiry->status)) }}</span>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        {{-- Inquiry Details --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-info-circle me-2 text-primary"></i>Inquiry Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @if($inquiry->treatment)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Treatment</small>
                        <strong>{{ $inquiry->treatment->name }}</strong>
                    </div>
                    @endif
                    @if($inquiry->specialty)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Specialty</small>
                        <strong>{{ $inquiry->specialty->name }}</strong>
                    </div>
                    @endif
                    @if($inquiry->hospital)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Preferred Hospital</small>
                        <strong>{{ $inquiry->hospital->name }}</strong>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Submitted</small>
                        <strong>{{ $inquiry->created_at->format('d M Y, h:i A') }}</strong>
                    </div>
                    @if($inquiry->travel_date_from)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Travel Dates</small>
                        <strong>{{ $inquiry->travel_date_from->format('d M Y') }} – {{ $inquiry->travel_date_to?->format('d M Y') ?? 'Flexible' }}</strong>
                    </div>
                    @endif
                    @if($inquiry->num_travelers)
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Travelers</small>
                        <strong>{{ $inquiry->num_travelers }}</strong>
                    </div>
                    @endif
                    @if($inquiry->description)
                    <div class="col-12">
                        <small class="text-muted d-block">Description</small>
                        <p class="mb-0">{{ $inquiry->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Conversation --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-comments me-2 text-primary"></i>Messages</h6>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;" id="messagesContainer">
                @forelse($messages as $message)
                <div class="d-flex mb-3 {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                    <div class="flex-shrink-0 mx-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:36px;height:36px;font-size:.75rem;">
                            {{ strtoupper(substr($message->sender->first_name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    <div class="{{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }} rounded-3 px-3 py-2" style="max-width:70%;">
                        <div class="small fw-semibold {{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}">
                            {{ $message->sender->full_name ?? 'Staff' }}
                        </div>
                        <p class="mb-1">{{ $message->body }}</p>
                        <div style="font-size:.7rem;" class="{{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}">
                            {{ $message->created_at->format('d M, h:i A') }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted small py-3">No messages yet. Send a message to your case manager.</p>
                @endforelse
            </div>
            <div class="card-footer bg-white border-top">
                <form method="POST" action="{{ route('patient.inquiries.messages.store', $inquiry) }}">
                    @csrf
                    <div class="input-group">
                        <textarea name="body" class="form-control" rows="2" placeholder="Type your message..." required></textarea>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Related Quotations --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Quotations</h6>
            </div>
            <div class="card-body p-0">
                @forelse($inquiry->quotations as $quotation)
                <div class="px-3 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-medium small">{{ $quotation->hospital->name ?? 'Quotation' }}</div>
                            <div class="text-muted" style="font-size:.75rem;">
                                Valid till {{ $quotation->valid_until?->format('d M Y') ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary small">${{ number_format($quotation->total_cost ?? 0, 0) }}</div>
                            <span class="badge bg-warning text-dark" style="font-size:.65rem;">{{ ucfirst($quotation->status) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('patient.quotations.show', $quotation) }}" class="btn btn-sm btn-outline-primary mt-2 w-100">
                        View Quotation
                    </a>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-file-invoice fa-2x mb-2 opacity-25"></i>
                    <p class="small mb-0">No quotations yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const container = document.getElementById('messagesContainer');
    if (container) container.scrollTop = container.scrollHeight;
</script>
@endpush
@endsection
