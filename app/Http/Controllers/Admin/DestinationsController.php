<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Country;
use Illuminate\Http\Request;

class DestinationsController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('country')->orderBy('position')->paginate(25);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $destination = new Destination();
        $countries   = Country::orderBy('name')->get();
        return view('admin.destinations.create', compact('destination', 'countries'));
    }

    public function store(Request $request)
    {
        $request->merge(['published' => $request->boolean('published')]);
        $data = $request->validate([
            'country_id'        => 'required|exists:countries,id',
            'name'              => 'required|string|max:255',
            'tagline'           => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'why_choose'        => 'nullable|string',
            'cost_savings_text' => 'nullable|string',
            'visa_info'         => 'nullable|string',
            'best_time_to_visit'=> 'nullable|string|max:100',
            'climate'           => 'nullable|string|max:100',
            'featured_image_url'=> 'nullable|url|max:500',
            'published'         => 'boolean',
            'position'          => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'meta_keywords'     => 'nullable|string|max:500',
        ]);
        $destination = Destination::create($data);
        return redirect()->route('admin.destinations.show', $destination)->with('success', 'Destination created.');
    }

    public function show(Destination $destination)
    {
        $destination->load(['country', 'packages']);
        return view('admin.destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.destinations.edit', compact('destination', 'countries'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->merge(['published' => $request->boolean('published')]);
        $destination->update($request->validate([
            'country_id'        => 'required|exists:countries,id',
            'name'              => 'required|string|max:255',
            'tagline'           => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'why_choose'        => 'nullable|string',
            'cost_savings_text' => 'nullable|string',
            'visa_info'         => 'nullable|string',
            'best_time_to_visit'=> 'nullable|string|max:100',
            'climate'           => 'nullable|string|max:100',
            'featured_image_url'=> 'nullable|url|max:500',
            'published'         => 'boolean',
            'position'          => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'meta_keywords'     => 'nullable|string|max:500',
        ]));
        return redirect()->route('admin.destinations.show', $destination)->with('success', 'Destination updated.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted.');
    }
}
