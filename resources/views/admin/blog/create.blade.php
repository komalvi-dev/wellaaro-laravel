@extends('layouts.admin')
@section('title', 'New Blog Post')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Blog Post</h1></div>
@include('admin.blog._form', ['post' => $post])
@endsection
