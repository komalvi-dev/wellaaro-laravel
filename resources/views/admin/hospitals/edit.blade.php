@extends('layouts.admin')
@section('title', 'Edit Hospital')
@section('breadcrumb')
<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item"><a href="{{ route('admin.hospitals.index') }}">Hospitals</a></li><li class="breadcrumb-item active">Edit</li></ol></nav>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Edit: {{ $hospital->name }}</h4>
    <a href="{{ route('admin.hospitals.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>
<form action="{{ route('admin.hospitals.update', $hospital->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @include('admin.hospitals._form')
        </div>
        <div class="card-footer bg-white d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update Hospital</button>
            <a href="{{ route('admin.hospitals.show', $hospital->id) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
