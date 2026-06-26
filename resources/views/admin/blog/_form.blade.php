<form method="POST" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}">
    @csrf
    @if($post->exists) @method('PUT') @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="mb-3">
                <label class="form-label fw-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control form-control-lg" placeholder="Blog post title..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-medium">Excerpt / Summary</label>
                <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-medium">Body</label>
                <textarea name="body" class="form-control" rows="20">{{ old('body', $post->body) }}</textarea>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-3 mb-3">
                <h6 class="fw-bold mb-3">Publish Settings</h6>
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="published" value="1" class="form-check-input" {{ old('published', $post->published) ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium">Published</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="form-control form-control-sm">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Author</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $post->author_name) }}" class="form-control form-control-sm">
                </div>
            </div>
            <div class="card border-0 shadow-sm p-3 mb-3">
                <h6 class="fw-bold mb-3">Categorization</h6>
                <div class="mb-3">
                    <label class="form-label fw-medium">Category</label>
                    <select name="blog_category_id" class="form-select form-select-sm">
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('blog_category_id', $post->blog_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium">Tags</label>
                    <select name="tag_ids[]" class="form-select form-select-sm" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tag_ids', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card border-0 shadow-sm p-3 mb-3">
                <h6 class="fw-bold mb-3">SEO</h6>
                <div class="mb-2">
                    <label class="form-label small fw-medium">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="form-control form-control-sm">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-medium">Meta Description</label>
                    <textarea name="meta_description" class="form-control form-control-sm" rows="2">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-medium">OG Image URL</label>
                    <input type="url" name="og_image_url" value="{{ old('og_image_url', $post->og_image_url) }}" class="form-control form-control-sm">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $post->exists ? 'Update Post' : 'Create Post' }}</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
