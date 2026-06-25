@extends('layouts.admin')
@section('title', 'Edit FAQ')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">Edit FAQ</h1>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-medium">Question</label>
                    <textarea name="question" class="form-control" rows="3">{{ old('question', $faq->question) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Category</label>
                    <input type="text" name="category" value="{{ old('category', $faq->category) }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium">Position</label>
                    <input type="number" name="position" value="{{ old('position', $faq->position) }}" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check mb-3">
                        <input type="checkbox" name="published" value="1" class="form-check-input" {{ old('published', $faq->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Answer</label>
                    <textarea name="answer" class="form-control" rows="5">{{ old('answer', $faq->answer) }}</textarea>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
