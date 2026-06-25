@extends('layouts.admin')
@section('title', 'Edit Staff Member')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1 class="h4 fw-bold mb-0">Edit: {{ $staff->email }}</h1>
</div>
<div class="row"><div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('admin.staff.update', $staff) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $staff->email) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Role</label>
                    <select name="role" class="form-select">
                        @foreach(['admin' => 'Admin', 'case_manager' => 'Case Manager', 'hospital_admin' => 'Hospital Admin', 'doctor' => 'Doctor'] as $val => $label)
                            <option value="{{ $val }}" {{ old('role', $staff->role) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">New Password <span class="text-muted fw-normal">(leave blank to keep current)</span></label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Staff Member</button>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection
