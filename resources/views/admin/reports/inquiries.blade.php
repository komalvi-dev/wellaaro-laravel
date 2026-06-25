@extends('layouts.admin')
@section('title', 'Reports')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Reports & Analytics</h1>
    <form class="d-flex gap-2" method="GET">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="form-control form-control-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="form-control form-control-sm">
        <button class="btn btn-sm btn-outline-secondary">Filter</button>
    </form>
</div>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="h3 fw-bold text-primary">{{ $inquiries->count() }}</div>
            <p class="text-muted small mb-0">Total Inquiries</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="h3 fw-bold text-success">{{ $byStatus->get('closed_won', 0) }}</div>
            <p class="text-muted small mb-0">Converted</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="h3 fw-bold text-info">{{ $byStatus->get('new', 0) }}</div>
            <p class="text-muted small mb-0">New</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="h3 fw-bold text-warning">
                {{ $inquiries->count() > 0 ? round(($byStatus->get('closed_won', 0) / $inquiries->count()) * 100, 1) : 0 }}%
            </div>
            <p class="text-muted small mb-0">Conversion Rate</p>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3"><h5 class="mb-0 fw-bold">By Status</h5></div>
            <div class="card-body">
                <table class="table table-sm">
                    @foreach($byStatus as $status => $count)
                    <tr>
                        <td><span class="badge bg-secondary-subtle text-secondary">{{ ucfirst(str_replace('_', ' ', $status)) }}</span></td>
                        <td class="text-end"><strong>{{ $count }}</strong></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3"><h5 class="mb-0 fw-bold">By Source</h5></div>
            <div class="card-body">
                <table class="table table-sm">
                    @foreach($bySource as $source => $count)
                    <tr>
                        <td class="small">{{ $source ?: 'Direct' }}</td>
                        <td class="text-end"><span class="badge bg-primary">{{ $count }}</span></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3"><h5 class="mb-0 fw-bold">Recent Inquiries</h5></div>
            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Name</th>
                            <th>Specialty</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inquiries->take(20) as $inq)
                        <tr>
                            <td class="ps-3 small">{{ $inq->first_name }} {{ $inq->last_name }}</td>
                            <td class="small text-muted">{{ $inq->specialty?->name ?? '—' }}</td>
                            <td><span class="badge bg-secondary-subtle text-secondary">{{ ucfirst(str_replace('_', ' ', $inq->status)) }}</span></td>
                            <td class="small text-muted">{{ $inq->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
