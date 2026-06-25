@extends('layouts.app')
@section('title', $page->seo_title ?: $page->title)
@if($page->seo_description)
@section('meta_description', $page->seo_description)
@endif
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">{{ $page->title }}</h1>
    </div>
</div>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5 prose">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
