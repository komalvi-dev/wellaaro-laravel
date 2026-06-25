@extends('layouts.admin')
@section('title', $page->title)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.cms-pages.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $page->title }}</h1>
    <a href="{{ route('admin.cms-pages.edit', $page) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <dl class="row mb-3">
            <dt class="col-sm-2 small text-muted">Slug</dt><dd class="col-sm-10">{{ $page->slug }}</dd>
            <dt class="col-sm-2 small text-muted">Status</dt><dd class="col-sm-10"><span class="badge {{ $page->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $page->published ? 'Published' : 'Draft' }}</span></dd>
        </dl>
        <div>{!! $page->body !!}</div>
    </div>
</div>
@endsection
