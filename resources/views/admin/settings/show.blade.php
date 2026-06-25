@extends('layouts.admin')
@section('title', 'Site Settings')
@section('content')
<div class="mb-4">
    <h1 class="h4 fw-bold">Site Settings</h1>
    <p class="text-muted">Manage site-wide configuration settings</p>
</div>
@foreach($settings as $group => $groupSettings)
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold">{{ ucfirst(str_replace('_', ' ', $group)) }}</h5>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')
            <div class="row g-3">
                @foreach($groupSettings as $setting)
                <div class="col-md-6">
                    <label class="form-label fw-medium small">
                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                        @if($setting->description)
                            <span class="text-muted fw-normal">— {{ $setting->description }}</span>
                        @endif
                    </label>
                    @if($setting->value_type === 'boolean')
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                   name="settings[{{ $setting->key }}]"
                                   value="true"
                                   {{ $setting->value === 'true' ? 'checked' : '' }}>
                        </div>
                    @elseif($setting->value_type === 'text')
                        <textarea class="form-control form-control-sm" rows="3"
                                  name="settings[{{ $setting->key }}]">{{ $setting->value }}</textarea>
                    @else
                        <input type="text" class="form-control form-control-sm"
                               name="settings[{{ $setting->key }}]"
                               value="{{ $setting->value }}">
                    @endif
                </div>
                @endforeach
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Save {{ ucfirst(str_replace('_', ' ', $group)) }} Settings</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
