@extends('layouts.admin')
@section('title', 'Edit Appointment')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.appointments.show', $appointment) }}" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Appointment #{{ $appointment->id }}</a>
        <h4 class="mb-0 fw-bold mt-1">Edit Appointment</h4>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <select name="doctor_id" class="form-select">
                        <option value="">Select doctor...</option>
                        @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}" {{ $appointment->doctor_id==$d->id ? 'selected':'' }}>{{ $d->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hospital</label>
                    <select name="hospital_id" class="form-select">
                        <option value="">Select hospital...</option>
                        @foreach($hospitals ?? [] as $h)
                        <option value="{{ $h->id }}" {{ $appointment->hospital_id==$h->id ? 'selected':'' }}>{{ $h->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Appointment Date & Time</label>
                    <input type="datetime-local" name="appointment_date" class="form-control" value="{{ old('appointment_date', optional($appointment->appointment_date)->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach(['scheduled','confirmed','completed','cancelled','no_show'] as $s)
                        <option value="{{ $s }}" {{ $appointment->status===$s ? 'selected':'' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <select name="appointment_type" class="form-select">
                        @foreach(['consultation','procedure','follow_up','online'] as $t)
                        <option value="{{ $t }}" {{ $appointment->appointment_type===$t ? 'selected':'' }}>{{ ucfirst(str_replace('_',' ',$t)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes', $appointment->notes) }}</textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
