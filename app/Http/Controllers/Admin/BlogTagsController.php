<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogTagsController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('posts')->orderBy('name')->paginate(50);
        return view('admin.blog_tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog_tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100']);
        BlogTag::create($data);
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag created.');
    }

    public function show(BlogTag $blogTag) { return redirect()->route('admin.blog-tags.index'); }

    public function edit(BlogTag $blogTag)
    {
        return view('admin.blog_tags.edit', ['tag' => $blogTag]);
    }

    public function update(Request $request, BlogTag $blogTag)
    {
        $blogTag->update($request->validate(['name' => 'required|string|max:100']));
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated.');
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->delete();
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted.');
    }
}
