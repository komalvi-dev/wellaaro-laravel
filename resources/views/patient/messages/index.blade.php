@extends('layouts.patient')

@section('title', 'Messages')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <a href="{{ route('patient.inquiries.show', $inquiry) }}" class="btn btn-sm btn-light">
        <i class="fas fa-arrow-left me-1"></i>Back to Inquiry
    </a>
    <h5 class="fw-bold mb-0">Conversation — Inquiry #{{ $inquiry->reference_number }}</h5>
</div>

<div class="card border-0 shadow-sm" style="max-width: 800px;">
    <div class="card-body" id="messagesContainer" style="height: 500px; overflow-y: auto; padding: 1.5rem;">
        @forelse($messages as $message)
        <div class="d-flex mb-4 {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : '' }}">
            <div class="flex-shrink-0 mx-2">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px;height:40px;">
                    {{ strtoupper(substr($message->sender->first_name ?? 'U', 0, 1)) }}
                </div>
            </div>
            <div style="max-width: 65%;">
                <div class="small text-muted mb-1 {{ $message->sender_id === auth()->id() ? 'text-end' : '' }}">
                    {{ $message->sender->full_name ?? 'Staff' }} &middot; {{ $message->created_at->diffForHumans() }}
                </div>
                <div class="{{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }} rounded-3 px-3 py-2">
                    {{ $message->body }}
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-comments fa-3x mb-3 opacity-25"></i>
            <p>No messages yet. Start the conversation below.</p>
        </div>
        @endforelse
    </div>
    <div class="card-footer bg-white border-top p-3">
        <form method="POST" action="{{ route('patient.inquiries.messages.store', $inquiry) }}">
            @csrf
            <div class="input-group">
                <input type="text" name="body" class="form-control" placeholder="Type your message..." required autocomplete="off">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-paper-plane me-1"></i>Send
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const c = document.getElementById('messagesContainer');
    if (c) c.scrollTop = c.scrollHeight;
</script>
@endpush
@endsection
