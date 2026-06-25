@extends('layouts.admin')
@section('title', 'New FAQ')
@section('content')
<div class="mb-4"><h1 class="h4 fw-bold">New FAQ</h1></div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-medium">Question</label>
                    <textarea name="question" class="form-control" rows="3">{{ old('question') }}</textarea>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Category</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="form-control" placeholder="e.g. general, medical, travel">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Position</label>
                        <input type="number" name="position" value="{{ old('position', 99) }}" class="form-control">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="published" value="1" class="form-check-input" {{ old('published') ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Answer</label>
                    <textarea name="answer" class="form-control" rows="5">{{ old('answer') }}</textarea>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
