@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb"><ol class="breadcrumb small mb-3"><li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li><li class="breadcrumb-item"><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li><li class="breadcrumb-item active">{{ Str::limit($post->title, 40) }}</li></ol></nav>
            @if($post->category)<span class="badge bg-primary mb-2">{{ $post->category->name }}</span>@endif
            <h1 class="h2 fw-bold mb-3">{{ $post->title }}</h1>
            <div class="d-flex align-items-center gap-3 mb-4 text-muted small">
                <span><i class="fas fa-user me-1"></i>{{ $post->author_name ?? $post->author?->full_name ?? 'Wellaaro' }}</span>
                <span><i class="fas fa-calendar me-1"></i>{{ $post->published_at?->format('M d, Y') }}</span>
                @if($post->read_time_minutes)<span><i class="fas fa-clock me-1"></i>{{ $post->read_time_minutes }} {{ __('min read') }}</span>@endif
            </div>
            @if($post->featured_image_url)<img src="{{ $post->featured_image_url }}" class="img-fluid rounded mb-4 w-100" style="max-height:400px;object-fit:cover;" alt="{{ $post->featured_image_alt ?? $post->title }}">@endif
            <div class="post-content">{!! $post->body !!}</div>
            @if($post->tags->count())
            <div class="mt-4">
                @foreach($post->tags as $tag)<a href="{{ route('blog.by_tag', $tag->slug) }}" class="badge bg-light text-muted me-1 text-decoration-none">{{ $tag->name }}</a>@endforeach
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center">
                    <h6 class="fw-bold">{{ __('Ready for Your Treatment?') }}</h6>
                    <p class="text-muted small">{{ __('Get a free consultation from our medical coordinators') }}</p>
                    <a href="{{ route('get_quote') }}" class="btn btn-primary w-100">{{ __('Get Free Quote') }}</a>
                </div>
            </div>
            @if(isset($relatedPosts) && $relatedPosts->count())
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">{{ __('Related Posts') }}</div>
                <div class="card-body p-0">
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none d-flex gap-2 p-3 border-bottom">
                        @if($related->featured_image_url)<img src="{{ $related->featured_image_url }}" width="60" height="50" style="object-fit:cover;border-radius:4px;">@endif
                        <div><div class="fw-semibold small">{{ Str::limit($related->title, 60) }}</div><div class="text-muted small">{{ $related->published_at?->format('M d') }}</div></div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
