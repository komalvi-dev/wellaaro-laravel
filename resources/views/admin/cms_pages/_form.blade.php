<form method="POST" action="{{ $page->exists ? route('admin.cms-pages.update', $page) : route('admin.cms-pages.store') }}">
    @csrf
    @if($page->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Page Content</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Title</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Content</label>
                        <textarea name="body" class="form-control" rows="20" placeholder="HTML content...">{{ old('body', $page->body) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Settings</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="form-control" placeholder="auto-generated if blank">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Template</label>
                        <input type="text" name="template" value="{{ old('template', $page->template ?? 'default') }}" class="form-control">
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="published" value="1" class="form-check-input" role="switch" {{ old('published', $page->published) ? 'checked' : '' }}>
                        <label class="form-check-label">Published</label>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-medium">SEO</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">{{ $page->exists ? 'Update Page' : 'Create Page' }}</button>
                <a href="{{ route('admin.cms-pages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
