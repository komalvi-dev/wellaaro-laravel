<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\HospitalGallery;
use Illuminate\Http\Request;

class HospitalGalleriesController extends Controller
{
    public function index(Hospital $hospital)
    {
        return view('admin.hospitals.gallery', compact('hospital'));
    }

    public function store(Request $request, Hospital $hospital)
    {
        $data = $request->validate([
            'image_url' => 'required|url|max:500',
            'caption'   => 'nullable|string|max:255',
            'position'  => 'nullable|integer',
        ]);
        $hospital->gallery()->create($data);
        return redirect()->route('admin.hospitals.gallery.index', $hospital)->with('success', 'Image added.');
    }

    public function destroy(Hospital $hospital, HospitalGallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.hospitals.gallery.index', $hospital)->with('success', 'Image removed.');
    }
}
