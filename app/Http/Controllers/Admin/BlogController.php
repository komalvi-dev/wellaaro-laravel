<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Specialty;
use App\Models\Treatment;
use App\Models\Hospital;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['author', 'category']);

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('published')) {
            $query->where('published', $request->published == '1');
        }
        if ($request->filled('category_id')) {
            $query->where('blog_category_id', $request->category_id);
        }

        $posts      = $query->orderBy('created_at', 'desc')->paginate(25);
        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.blog.index', compact('posts', 'categories'));
    }

    public function create()
    {
        return view('admin.blog.create', array_merge(['post' => new BlogPost()], $this->formData()));
    }

    public function store(Request $request)
    {
        $data = $this->validatePost($request);
        $data['author_user_id'] = auth()->id();

        if ($request->hasFile('og_image')) {
            $data['og_image_url'] = Storage::disk('public')->url(
                $request->file('og_image')->store('blog/og', 'public')
            );
        }

        if ($request->hasFile('medically_reviewed_by_photo')) {
            $data['medically_reviewed_by_photo_url'] = Storage::disk('public')->url(
                $request->file('medically_reviewed_by_photo')->store('blog/reviewers', 'public')
            );
        }

        $post = BlogPost::create($data);

        if ($request->filled('tag_ids')) {
            $post->tags()->sync($request->tag_ids);
        }

        return redirect()->route('admin.blog.edit', $post)
            ->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $post)
    {
        return view('admin.blog.edit', array_merge(['post' => $post], $this->formData()));
    }

    public function update(Request $request, BlogPost $post)
    {
        $data = $this->validatePost($request);

        if ($request->hasFile('og_image')) {
            $data['og_image_url'] = Storage::disk('public')->url(
                $request->file('og_image')->store('blog/og', 'public')
            );
        }

        if ($request->hasFile('medically_reviewed_by_photo')) {
            $data['medically_reviewed_by_photo_url'] = Storage::disk('public')->url(
                $request->file('medically_reviewed_by_photo')->store('blog/reviewers', 'public')
            );
        }

        $post->update($data);

        if ($request->has('tag_ids')) {
            $post->tags()->sync($request->tag_ids ?? []);
        }

        return redirect()->route('admin.blog.edit', $post)
            ->with('success', 'Post updated.');
    }

    public function destroy(BlogPost $post)
    {
        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post deleted.');
    }

    public function publish(BlogPost $post)
    {
        $post->update([
            'published'    => true,
            'published_at' => $post->published_at ?? now(),
        ]);

        return redirect()->back()->with('success', 'Post published.');
    }

    public function unpublish(BlogPost $post)
    {
        $post->update(['published' => false]);

        return redirect()->back()->with('success', 'Post unpublished.');
    }

    private function validatePost(Request $request): array
    {
        return $request->validate([
            'title'              => 'required|string|max:255',
            'excerpt'            => 'nullable|string|max:5000',
            'body'               => 'required|string',
            'blog_category_id'   => 'nullable|exists:blog_categories,id',
            'author_name'        => 'nullable|string|max:255',
            'medically_reviewed_by' => 'nullable|string|max:255',
            'medically_reviewed_by_photo' => 'nullable|file|image|max:2048',
            'medically_reviewed_by_photo_url' => 'nullable|url|max:500',
            'featured_image_url' => 'nullable|url|max:500',
            'featured_image_alt' => 'nullable|string|max:255',
            'read_time_minutes'  => 'nullable|integer|min:1',
            'specialty_id'       => 'nullable|exists:specialties,id',
            'treatment_id'       => 'nullable|exists:treatments,id',
            'hospital_id'        => 'nullable|exists:hospitals,id',
            'destination_id'     => 'nullable|exists:destinations,id',
            'schema_type'        => 'nullable|string|max:50',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string|max:500',
            'meta_keywords'      => 'nullable|string|max:500',
            'canonical_url'      => 'nullable|url|max:500',
            'og_image'           => 'nullable|file|image|max:2048',
            'og_image_url'       => 'nullable|url|max:500',
            'published'          => 'boolean',
            'published_at'       => 'nullable|date',
        ]);
    }

    private function formData(): array
    {
        return [
            'categories'   => BlogCategory::orderBy('name')->get(),
            'tags'         => BlogTag::orderBy('name')->get(),
            'specialties'  => Specialty::published()->ordered()->get(),
            'treatments'   => Treatment::published()->ordered()->get(),
            'hospitals'    => Hospital::published()->orderBy('name')->get(),
            'destinations' => Destination::published()->ordered()->get(),
        ];
    }
}
