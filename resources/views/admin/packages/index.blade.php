@extends('layouts.admin')
@section('title', 'Packages')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Packages</h1>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">New Package</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Name</th>
                    <th>Hospital</th>
                    <th>Duration</th>
                    <th>Price From</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $pkg)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 fw-medium small">{{ $pkg->name }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">{{ Str::limit($pkg->tagline ?? '', 60) }}</p>
                    </td>
                    <td class="small">{{ $pkg->hospital?->name }}</td>
                    <td class="small">{{ $pkg->duration_days }} days</td>
                    <td class="small">
                        @if($pkg->price_usd_from) From ${{ number_format($pkg->price_usd_from) }}
                        @else <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($pkg->is_popular)<span class="badge bg-warning text-dark me-1">Popular</span>@endif
                        <span class="badge {{ $pkg->published ? 'bg-success' : 'bg-secondary' }}">
                            {{ $pkg->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.packages.edit', $pkg) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.packages.destroy', $pkg) }}" onsubmit="return confirm('Delete this package?')">
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
    <div class="card-footer bg-white py-3">{{ $packages->links() }}</div>
</div>
@endsection
