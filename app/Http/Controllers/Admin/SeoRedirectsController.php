<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoRedirect;
use Illuminate\Http\Request;

class SeoRedirectsController extends Controller
{
    public function index()
    {
        $redirects = SeoRedirect::orderBy('from_path')->paginate(50);
        return view('admin.seo_redirects.index', compact('redirects'));
    }

    public function create() { return view('admin.seo_redirects.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'from_path'     => 'required|string|max:500|unique:seo_redirects,from_path',
            'to_path'       => 'required|string|max:500',
            'redirect_type' => 'required|in:301,302',
            'is_active'     => 'boolean',
        ]);
        SeoRedirect::create($data);
        return redirect()->route('admin.seo-redirects.index')->with('success', 'Redirect created.');
    }

    public function show(SeoRedirect $seoRedirect) { return redirect()->route('admin.seo-redirects.edit', $seoRedirect); }

    public function edit(SeoRedirect $seoRedirect) { return view('admin.seo_redirects.edit', ['redirect' => $seoRedirect]); }

    public function update(Request $request, SeoRedirect $seoRedirect)
    {
        $seoRedirect->update($request->validate([
            'from_path'     => 'required|string|max:500|unique:seo_redirects,from_path,' . $seoRedirect->id,
            'to_path'       => 'required|string|max:500',
            'redirect_type' => 'required|in:301,302',
            'is_active'     => 'boolean',
        ]));
        return redirect()->route('admin.seo-redirects.index')->with('success', 'Redirect updated.');
    }

    public function destroy(SeoRedirect $seoRedirect)
    {
        $seoRedirect->delete();
        return redirect()->route('admin.seo-redirects.index')->with('success', 'Redirect deleted.');
    }
}
