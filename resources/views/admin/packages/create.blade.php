@extends('layouts.admin')
@section('title', 'New Package')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Package</h1></div>
@include('admin.packages._form', ['package' => $package])
@endsection
