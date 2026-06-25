@extends('layouts.admin')
@section('title', 'Conversion Report')
@section('content')
<h1 class="h4 fw-bold mb-4">Conversion Report</h1>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <div class="h2 fw-bold text-primary">{{ $total }}</div>
            <p class="text-muted mb-0">Total Inquiries</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <div class="h2 fw-bold text-success">{{ $converted }}</div>
            <p class="text-muted mb-0">Converted</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <div class="h2 fw-bold text-warning">{{ $rate }}%</div>
            <p class="text-muted mb-0">Conversion Rate</p>
        </div>
    </div>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">By Specialty</h5></div>
    <div class="card-body">
        <table class="table table-sm">
            @foreach($bySpecialty as $specialty => $count)
            <tr>
                <td>{{ $specialty }}</td>
                <td class="text-end"><span class="badge bg-primary">{{ $count }}</span></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
