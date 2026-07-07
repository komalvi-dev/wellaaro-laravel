@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="bg-light py-4 mb-4">
    <div class="container">
        <h1 class="h3 fw-bold mb-1">{{ __('Health & Travel Blog') }}</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item active">{{ __('Blog') }}</li></ol></nav>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="row g-4">
                @forelse($posts as $post)
                <div class="col-md-6">
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                        <div class="card card-hover h-100 border-0 shadow-sm">
                            @if($post->featured_image_url)<img src="{{ $post->featured_image_url }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $post->title }}">@endif
                            <div class="card-body">
                                @if($post->category)<span class="badge bg-primary-subtle text-primary small mb-2">{{ $post->category->name }}</span>@endif
                                <h6 class="fw-bold mb-2">{{ $post->title }}</h6>
                                <p class="text-muted small">{{ Str::limit($post->excerpt, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="text-muted">{{ $post->published_at?->format('M d, Y') }}</small>
                                    @if($post->read_time_minutes)<small class="text-muted">{{ $post->read_time_minutes }} {{ __('min read') }}</small>@endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">{{ __('No posts yet.') }}</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
        <div class="col-lg-4">
            @if(isset($categories) && $categories->count())
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">{{ __('Categories') }}</div>
                <div class="card-body">
                    @foreach($categories as $cat)
                    <a href="{{ route('blog.category', $cat->slug) }}" class="d-flex justify-content-between align-items-center text-decoration-none text-dark py-1 border-bottom">
                        <span class="small">{{ $cat->name }}</span>
                        <span class="badge bg-light text-muted">{{ $cat->posts_count ?? $cat->posts->count() }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="fw-bold">{{ __('Get Free Medical Quote') }}</h6>
                    <p class="text-muted small">{{ __('Consult our medical experts today') }}</p>
                    <a href="{{ route('get_quote') }}" class="btn btn-primary btn-sm w-100">{{ __('Get Quote') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
