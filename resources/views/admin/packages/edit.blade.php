@extends('layouts.admin')
@section('title', 'Edit Package')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">Edit: {{ $package->name }}</h1>
</div>
@include('admin.packages._form', ['package' => $package])
@endsection
