@extends('layouts.admin')
@section('title', 'Traffic Sources')
@section('content')
<h1 class="h4 fw-bold mb-4">Traffic Sources</h1>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">By UTM Source</h5></div>
            <div class="card-body">
                <table class="table table-sm">
                    @foreach($bySource as $row)
                    <tr>
                        <td class="small">{{ $row->utm_source ?: 'Direct' }}</td>
                        <td class="text-end"><span class="badge bg-primary">{{ $row->count }}</span></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">By UTM Medium</h5></div>
            <div class="card-body">
                <table class="table table-sm">
                    @foreach($byMedium as $row)
                    <tr>
                        <td class="small">{{ $row->utm_medium ?: '—' }}</td>
                        <td class="text-end"><span class="badge bg-secondary">{{ $row->count }}</span></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
