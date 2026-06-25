@extends('layouts.admin')
@section('title', 'FAQs')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">FAQs</h1>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Add FAQ</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Question</th>
                    <th>Category</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 small fw-medium">{{ Str::limit($faq->question, 80) }}</p>
                    </td>
                    <td><span class="badge bg-secondary-subtle text-secondary">{{ ucfirst($faq->category ?? 'general') }}</span></td>
                    <td class="small">{{ $faq->position }}</td>
                    <td>
                        <span class="badge {{ $faq->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $faq->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Delete this FAQ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">{{ $faqs->links() }}</div>
</div>
@endsection
