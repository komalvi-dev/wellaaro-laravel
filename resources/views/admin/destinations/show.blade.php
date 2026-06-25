@extends('layouts.admin')
@section('title', $destination->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $destination->name }}</h1>
    <a href="{{ route('admin.destinations.edit', $destination) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3 text-muted small">Country</dt><dd class="col-sm-9">{{ $destination->country?->name ?? '—' }}</dd>
            <dt class="col-sm-3 text-muted small">Status</dt><dd class="col-sm-9"><span class="badge {{ $destination->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $destination->published ? 'Published' : 'Draft' }}</span></dd>
        </dl>
        @if($destination->description)<p>{{ $destination->description }}</p>@endif
    </div>
</div>
@endsection
