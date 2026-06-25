<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;

class BlogController extends Controller
{
    public function index()
    {
        $query = BlogPost::published()->orderBy('published_at', 'desc');

        if ($categoryId = request('category_id')) {
            $query->where('blog_category_id', $categoryId);
        }
        if ($tagId = request('tag_id')) {
            $query->whereHas('tags', fn($q) => $q->where('blog_tags.id', $tagId));
        }

        $posts      = $query->with('category', 'author')->paginate(9)->withQueryString();
        $categories = BlogCategory::where('published', true)->orderBy('position')->get();
        $tags       = BlogTag::withCount('posts')->orderByDesc('posts_count')->limit(20)->get();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    public function byCategory(string $slug)
    {
        $category   = BlogCategory::where('slug', $slug)->where('published', true)->firstOrFail();
        $posts      = BlogPost::published()->where('blog_category_id', $category->id)
                        ->with('category', 'author')->orderBy('published_at', 'desc')
                        ->paginate(9)->withQueryString();
        $categories = BlogCategory::where('published', true)->orderBy('position')->get();
        $tags       = BlogTag::withCount('posts')->orderByDesc('posts_count')->limit(20)->get();

        return view('blog.index', compact('posts', 'categories', 'tags', 'category'));
    }

    public function byTag(string $slug)
    {
        $tag        = BlogTag::where('slug', $slug)->firstOrFail();
        $posts      = BlogPost::published()->whereHas('tags', fn($q) => $q->where('blog_tags.slug', $slug))
                        ->with('category', 'author')->orderBy('published_at', 'desc')
                        ->paginate(9)->withQueryString();
        $categories = BlogCategory::where('published', true)->orderBy('position')->get();
        $tags       = BlogTag::withCount('posts')->orderByDesc('posts_count')->limit(20)->get();

        return view('blog.index', compact('posts', 'categories', 'tags', 'tag'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->where('published', true)->firstOrFail();
        $post->load('category', 'tags', 'author');
        $post->incrementViews();

        $related = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('blog_category_id', $post->blog_category_id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
