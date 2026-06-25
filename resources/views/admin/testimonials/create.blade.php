@extends('layouts.admin')
@section('title', 'New Testimonial')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New Testimonial</h1></div>
@include('admin.testimonials._form', ['testimonial' => $testimonial])
@endsection
