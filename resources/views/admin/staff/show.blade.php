@extends('layouts.admin')
@section('title', 'Staff Member')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $staff->email }}</h1>
    <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3 small text-muted">Email</dt><dd class="col-sm-9">{{ $staff->email }}</dd>
            <dt class="col-sm-3 small text-muted">Role</dt><dd class="col-sm-9"><span class="badge bg-info-subtle text-info">{{ ucfirst(str_replace('_', ' ', $staff->role)) }}</span></dd>
            <dt class="col-sm-3 small text-muted">Joined</dt><dd class="col-sm-9">{{ $staff->created_at->format('M d, Y') }}</dd>
        </dl>
    </div>
</div>
@endsection
