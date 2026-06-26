<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoriesController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')->orderBy('name')->paginate(25);
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = BlogCategory::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.blog_categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:blog_categories,slug',
            'description' => 'nullable|string|max:500',
            'parent_id'   => 'nullable|exists:blog_categories,id',
            'position'    => 'nullable|integer',
            'published'   => 'boolean',
        ]);
        $category = BlogCategory::create($data);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created.');
    }

    public function show(BlogCategory $blogCategory)
    {
        return view('admin.blog_categories.show', ['category' => $blogCategory]);
    }

    public function edit(BlogCategory $blogCategory)
    {
        $parents = BlogCategory::whereNull('parent_id')->where('id', '!=', $blogCategory->id)->orderBy('name')->get();
        return view('admin.blog_categories.edit', ['category' => $blogCategory, 'parents' => $parents]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $blogCategory->update($request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:blog_categories,slug,' . $blogCategory->id,
            'description' => 'nullable|string|max:500',
            'parent_id'   => 'nullable|exists:blog_categories,id',
            'position'    => 'nullable|integer',
            'published'   => 'boolean',
        ]));
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted.');
    }
}
