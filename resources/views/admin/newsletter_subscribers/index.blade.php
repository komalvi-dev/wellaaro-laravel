@extends('layouts.admin')
@section('title', 'Newsletter Subscribers')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Newsletter Subscribers</h1>
    <span class="text-muted small">Total: {{ $subscribers->total() }}</span>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Email</th>
                    <th>Status</th>
                    <th>Source</th>
                    <th>Subscribed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $sub)
                <tr>
                    <td class="ps-4 small fw-medium">{{ $sub->email }}</td>
                    <td>
                        <span class="badge {{ $sub->is_confirmed ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $sub->is_confirmed ? 'Confirmed' : 'Pending' }}
                        </span>
                    </td>
                    <td class="small text-muted">{{ $sub->source ?? '—' }}</td>
                    <td class="small text-muted">{{ $sub->created_at->format('M d, Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.newsletter-subscribers.destroy', $sub) }}" onsubmit="return confirm('Remove subscriber?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">{{ $subscribers->links() }}</div>
</div>
@endsection
