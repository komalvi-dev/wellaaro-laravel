@extends('layouts.admin')
@section('title', 'New Page')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Page</h1></div>
@include('admin.cms_pages._form', ['page' => $page])
@endsection
