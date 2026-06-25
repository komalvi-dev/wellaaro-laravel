@extends('layouts.admin')
@section('title', 'Audit Logs')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Audit Logs</h1>
    <form class="d-flex gap-2" method="GET">
        <select name="action" class="form-select form-select-sm" style="width:160px;" onchange="this.form.submit()">
            <option value="">All Actions</option>
            @foreach(['create','update','destroy','login','logout'] as $act)
                <option value="{{ $act }}" {{ request('action') === $act ? 'selected' : '' }}>{{ ucfirst($act) }}</option>
            @endforeach
        </select>
    </form>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size:0.85rem;">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Record</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td class="ps-4 text-muted small">{{ $log->created_at->format('M d H:i') }}</td>
                    <td class="small">{{ $log->user?->email ?? 'System' }}</td>
                    <td>
                        <span class="badge {{ $log->action === 'destroy' ? 'bg-danger-subtle text-danger' : 'bg-secondary-subtle text-secondary' }}">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="small text-muted">
                        @if($log->auditable_type)
                            {{ class_basename($log->auditable_type) }} #{{ $log->auditable_id }}
                        @else —
                        @endif
                    </td>
                    <td class="small text-muted">{{ $log->ip_address ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">{{ $logs->links() }}</div>
</div>
@endsection
