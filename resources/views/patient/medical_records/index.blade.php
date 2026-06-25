@extends('layouts.patient')

@section('title', 'Medical Records')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Medical Records</h5>
    <a href="{{ route('patient.medical-records.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-upload me-1"></i>Upload Record
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @forelse($records as $record)
        <div class="d-flex align-items-center px-4 py-3 border-bottom">
            <div class="me-3 text-primary">
                <i class="fas fa-file-medical fa-2x opacity-50"></i>
            </div>
            <div class="flex-grow-1">
                <div class="fw-semibold">{{ $record->description ?? 'Medical Record' }}</div>
                <div class="text-muted small mt-1">
                    <span class="badge bg-light text-dark border me-2">{{ ucfirst(str_replace('_', ' ', $record->record_type)) }}</span>
                    <span><i class="fas fa-calendar me-1"></i>{{ $record->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                @if($record->file_path)
                <a href="{{ Storage::url($record->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download me-1"></i>Download
                </a>
                @endif
                <form method="POST" action="{{ route('patient.medical-records.destroy', $record) }}" onsubmit="return confirm('Delete this record?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
            <h6>No records uploaded</h6>
            <p class="small mb-3">Upload your medical records to share with our team.</p>
            <a href="{{ route('patient.medical-records.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-upload me-1"></i>Upload Now
            </a>
        </div>
        @endforelse
    </div>
    @if(isset($records) && $records->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $records->links() }}
    </div>
    @endif
</div>
@endsection
