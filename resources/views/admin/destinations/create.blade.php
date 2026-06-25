@extends('layouts.admin')
@section('title', 'New Destination')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Destination</h1></div>
@include('admin.destinations._form', ['destination' => $destination])
@endsection
