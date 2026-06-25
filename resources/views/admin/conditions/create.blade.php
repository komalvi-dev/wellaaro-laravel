@extends('layouts.admin')
@section('title', 'New Condition')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Condition</h1></div>
@include('admin.conditions._form', ['condition' => $condition])
@endsection
