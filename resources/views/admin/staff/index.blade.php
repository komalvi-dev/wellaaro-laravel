@extends('layouts.admin')
@section('title', 'Staff')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 fw-bold">Staff Members</h1>
    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">Add Staff</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $user)
                <tr>
                    <td class="ps-4">
                        <p class="mb-0 fw-medium small">{{ $user->email }}</p>
                    </td>
                    <td>
                        <span class="badge bg-info-subtle text-info">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                    </td>
                    <td class="small text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.staff.edit', $user) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.staff.destroy', $user) }}" onsubmit="return confirm('Remove this staff member?')">
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
    <div class="card-footer bg-white py-3">{{ $staff->links() }}</div>
</div>
@endsection
