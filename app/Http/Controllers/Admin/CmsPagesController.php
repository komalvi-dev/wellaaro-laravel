<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsPagesController extends Controller
{
    public function index()
    {
        $pages = CmsPage::orderBy('title')->paginate(25);
        return view('admin.cms_pages.index', compact('pages'));
    }

    public function create()
    {
        $page = new CmsPage();
        return view('admin.cms_pages.create', compact('page'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'template'         => 'nullable|string|max:50',
            'body'             => 'nullable|string',
            'published'        => 'boolean',
            'show_in_sitemap'  => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:500',
        ]);
        $page = CmsPage::create($data);
        return redirect()->route('admin.cms-pages.edit', $page)->with('success', 'Page created.');
    }

    public function show(CmsPage $cmsPage)
    {
        return view('admin.cms_pages.show', ['page' => $cmsPage]);
    }

    public function edit(CmsPage $cmsPage)
    {
        return view('admin.cms_pages.edit', ['page' => $cmsPage]);
    }

    public function update(Request $request, CmsPage $cmsPage)
    {
        $cmsPage->update($request->validate([
            'title'            => 'required|string|max:255',
            'template'         => 'nullable|string|max:50',
            'body'             => 'nullable|string',
            'published'        => 'boolean',
            'show_in_sitemap'  => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:500',
        ]));
        return redirect()->route('admin.cms-pages.edit', $cmsPage)->with('success', 'Page updated.');
    }

    public function destroy(CmsPage $cmsPage)
    {
        $cmsPage->delete();
        return redirect()->route('admin.cms-pages.index')->with('success', 'Page deleted.');
    }
}
