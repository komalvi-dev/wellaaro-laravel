<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpecialtiesController extends Controller
{
    public function index()
    {
        $specialties = Specialty::orderBy('position')->paginate(25);

        return view('admin.specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('admin.specialties.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateSpecialty($request);

        if ($request->hasFile('featured_image')) {
            $data['featured_image_url'] = Storage::disk('public')->url(
                $request->file('featured_image')->store('specialties/featured', 'public')
            );
        }

        $specialty = Specialty::create($data);

        return redirect()->route('admin.specialties.show', $specialty)
            ->with('success', 'Specialty created.');
    }

    public function show(Specialty $specialty)
    {
        $specialty->load(['treatments', 'doctors', 'hospitals']);

        return view('admin.specialties.show', compact('specialty'));
    }

    public function edit(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $data = $this->validateSpecialty($request);

        if ($request->hasFile('featured_image')) {
            $data['featured_image_url'] = Storage::disk('public')->url(
                $request->file('featured_image')->store('specialties/featured', 'public')
            );
        }

        $specialty->update($data);

        return redirect()->route('admin.specialties.show', $specialty)
            ->with('success', 'Specialty updated.');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()->route('admin.specialties.index')
            ->with('success', 'Specialty deleted.');
    }

    private function validateSpecialty(Request $request): array
    {
        return $request->validate([
            'name'               => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255',
            'short_description'  => 'nullable|string|max:500',
            'description'        => 'nullable|string',
            'featured_image'     => 'nullable|file|image|max:2048',
            'featured_image_url' => 'nullable|url|max:500',
            'published'          => 'boolean',
            'featured'           => 'boolean',
            'position'           => 'nullable|integer',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string|max:500',
            'meta_keywords'      => 'nullable|string|max:500',
        ]);
    }
}
