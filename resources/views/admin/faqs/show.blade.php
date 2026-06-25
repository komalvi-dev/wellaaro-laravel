@extends('layouts.admin')
@section('title', 'FAQ')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">FAQ Detail</h1>
    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h6 class="fw-semibold">{{ $faq->question }}</h6>
        <p class="mt-3 text-muted">{{ $faq->answer }}</p>
        <dl class="row mt-3">
            <dt class="col-sm-3 small text-muted">Category</dt><dd class="col-sm-9">{{ ucfirst($faq->category ?? '—') }}</dd>
            <dt class="col-sm-3 small text-muted">Status</dt><dd class="col-sm-9"><span class="badge {{ $faq->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $faq->published ? 'Published' : 'Draft' }}</span></dd>
        </dl>
    </div>
</div>
@endsection
