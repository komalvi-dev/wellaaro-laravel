<form method="POST" action="{{ $condition->exists ? route('admin.conditions.update', $condition) : route('admin.conditions.store') }}">
    @csrf
    @if($condition->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Condition Details</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-medium">Name</label>
                            <input type="text" name="name" value="{{ old('name', $condition->name) }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">ICD-10 Code</label>
                            <input type="text" name="icd10_code" value="{{ old('icd10_code', $condition->icd10_code) }}" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $condition->short_description) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Description</label>
                        <textarea name="description" class="form-control" rows="5">{{ old('description', $condition->description) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Symptoms</label>
                        <textarea name="symptoms" class="form-control" rows="3">{{ old('symptoms', $condition->symptoms) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Causes</label>
                        <textarea name="causes" class="form-control" rows="3">{{ old('causes', $condition->causes) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-medium">Treatment Overview</label>
                        <textarea name="treatment_overview" class="form-control" rows="3">{{ old('treatment_overview', $condition->treatment_overview) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Settings</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-2">
                        <input type="hidden" name="published" value="0">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $condition->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">SEO</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $condition->meta_title) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $condition->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">{{ $condition->exists ? 'Update Condition' : 'Create Condition' }}</button>
                <a href="{{ route('admin.conditions.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
