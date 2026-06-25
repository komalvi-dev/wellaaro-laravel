@extends('layouts.admin')
@section('title', 'Revenue Report')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Revenue Report</h1>
    <form class="d-flex gap-2" method="GET">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="form-control form-control-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="form-control form-control-sm">
        <button class="btn btn-sm btn-outline-secondary">Filter</button>
    </form>
</div>
<div class="card border-0 shadow-sm mb-4 p-4 text-center">
    <div class="h2 fw-bold text-success">${{ number_format($totalRevenue, 2) }}</div>
    <p class="text-muted mb-0">Total Revenue</p>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="ps-4">Inquiry</th><th>Amount</th><th>Paid At</th></tr>
            </thead>
            <tbody>
                @foreach($payments as $p)
                <tr>
                    <td class="ps-4 small">{{ $p->inquiry?->first_name }} {{ $p->inquiry?->last_name }}</td>
                    <td class="small text-success">${{ number_format($p->amount, 2) }}</td>
                    <td class="small text-muted">{{ $p->paid_at?->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
