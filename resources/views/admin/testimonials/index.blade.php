@extends('layouts.admin')
@section('title', 'Testimonials')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Patient</th>
                    <th>Treatment</th>
                    <th>Rating</th>
                    <th>Video</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $t)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 fw-medium small">{{ $t->patient_name }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">{{ $t->country }}</p>
                    </td>
                    <td class="small">{{ Str::limit($t->treatment, 40) }}</td>
                    <td>
                        <span class="text-warning small">{{ str_repeat('★', (int)$t->rating) }}</span>
                        <span class="text-muted small">({{ $t->rating }})</span>
                    </td>
                    <td>
                        @if($t->is_video)
                            <span class="badge bg-danger-subtle text-danger"><i class="bi bi-camera-video me-1"></i>Video</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">Text</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $t->published ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $t->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete this testimonial?')">
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
    <div class="card-footer bg-white py-3">{{ $testimonials->links() }}</div>
</div>
@endsection
