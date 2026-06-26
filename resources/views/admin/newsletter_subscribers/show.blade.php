@extends('layouts.admin')
@section('title', 'Subscriber: ' . $subscriber->email)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.newsletter-subscribers.index') }}" class="text-muted text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Newsletter Subscribers</a>
        <h4 class="mb-0 fw-bold mt-1">{{ $subscriber->email }}</h4>
    </div>
    <form method="POST" action="{{ route('admin.newsletter-subscribers.destroy', $subscriber) }}" onsubmit="return confirm('Remove this subscriber?')">
        @csrf @method('DELETE')
        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash me-1"></i> Remove</button>
    </form>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Subscriber Details</div>
            <div class="card-body">
                <dl class="row g-2 mb-0">
                    <dt class="col-sm-4 text-muted small">Email</dt>
                    <dd class="col-sm-8">{{ $subscriber->email }}</dd>

                    <dt class="col-sm-4 text-muted small">First Name</dt>
                    <dd class="col-sm-8">{{ $subscriber->first_name ?? '—' }}</dd>

                    <dt class="col-sm-4 text-muted small">Country</dt>
                    <dd class="col-sm-8">{{ $subscriber->country ?? '—' }}</dd>

                    <dt class="col-sm-4 text-muted small">Source</dt>
                    <dd class="col-sm-8">{{ $subscriber->source ?? '—' }}</dd>

                    <dt class="col-sm-4 text-muted small">Interests</dt>
                    <dd class="col-sm-8">{{ $subscriber->interests ?? '—' }}</dd>

                    <dt class="col-sm-4 text-muted small">Status</dt>
                    <dd class="col-sm-8">
                        <span class="badge {{ $subscriber->is_confirmed ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $subscriber->is_confirmed ? 'Confirmed' : 'Pending' }}
                        </span>
                    </dd>

                    <dt class="col-sm-4 text-muted small">Subscribed At</dt>
                    <dd class="col-sm-8">{{ $subscriber->subscribed_at ? \Carbon\Carbon::parse($subscriber->subscribed_at)->format('M d, Y H:i') : ($subscriber->created_at ? $subscriber->created_at->format('M d, Y H:i') : '—') }}</dd>

                    @if($subscriber->unsubscribed_at)
                    <dt class="col-sm-4 text-muted small">Unsubscribed At</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($subscriber->unsubscribed_at)->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-4 text-muted small">Unsubscribe Reason</dt>
                    <dd class="col-sm-8">{{ $subscriber->unsubscribe_reason ?? '—' }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
