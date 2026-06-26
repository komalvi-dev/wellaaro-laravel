@extends('layouts.admin')
@section('title', 'Edit Doctor')
@section('breadcrumb')
<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Doctors</a></li><li class="breadcrumb-item active">Edit</li></ol></nav>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Edit: {{ $doctor->full_name }}</h4>
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>
<form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @include('admin.doctors._form')
        </div>
        <div class="card-footer bg-white d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update Doctor</button>
            <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
