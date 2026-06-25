@extends('layouts.admin')
@section('title', 'New Treatment')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Treatment</h1></div>
@include('admin.treatments._form', ['treatment' => $treatment])
@endsection
