@extends('layouts.admin')
@section('title', 'Add SEO Redirect')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.seo-redirects.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">Add SEO Redirect</h1>
</div>
<div class="row"><div class="col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('admin.seo-redirects.store') }}">
                @csrf
                @include('admin.seo_redirects._form')
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary">Create Redirect</button>
                    <a href="{{ route('admin.seo-redirects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection
