@extends('layouts.admin')
@section('title', $condition->name)
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.conditions.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">{{ $condition->name }}</h1>
    <a href="{{ route('admin.conditions.edit', $condition) }}" class="btn btn-sm btn-primary ms-auto">Edit</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($condition->short_description)<p class="text-muted">{{ $condition->short_description }}</p>@endif
                @if($condition->description)<div>{!! nl2br(e($condition->description)) !!}</div>@endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <dl class="mb-0">
                    <dt class="small text-muted">ICD-10</dt><dd>{{ $condition->icd10_code ?? '—' }}</dd>
                    <dt class="small text-muted">Status</dt><dd><span class="badge {{ $condition->published ? 'bg-success' : 'bg-warning text-dark' }}">{{ $condition->published ? 'Published' : 'Draft' }}</span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
