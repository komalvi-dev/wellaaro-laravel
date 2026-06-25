@extends('layouts.admin')
@section('title', 'Edit Destination')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">Edit: {{ $destination->name }}</h1>
</div>
@include('admin.destinations._form', ['destination' => $destination])
@endsection
