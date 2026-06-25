<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Country;
use App\Models\City;
use App\Models\Specialty;
use Illuminate\Http\Request;

class HospitalsController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::with('country', 'city');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('published')) {
            $query->where('published', $request->published == '1');
        }
        if ($request->filled('tier')) {
            $query->where('tier', $request->tier);
        }

        $hospitals = $query->orderBy('position')->orderBy('name')->paginate(25);

        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        $countries  = Country::orderBy('name')->get();
        $cities     = City::orderBy('name')->get();
        $specialties= Specialty::published()->ordered()->get();

        return view('admin.hospitals.create', compact('countries', 'cities', 'specialties'));
    }

    public function store(Request $request)
    {
        $data = $this->validateHospital($request);

        $hospital = Hospital::create($data);

        if ($request->filled('specialty_ids')) {
            $hospital->specialties()->sync($request->specialty_ids);
        }

        return redirect()->route('admin.hospitals.show', $hospital)
            ->with('success', 'Hospital created successfully.');
    }

    public function show(Hospital $hospital)
    {
        $hospital->load(['specialties', 'facilities', 'gallery', 'doctors', 'country', 'city']);

        return view('admin.hospitals.show', compact('hospital'));
    }

    public function edit(Hospital $hospital)
    {
        $countries   = Country::orderBy('name')->get();
        $cities      = City::orderBy('name')->get();
        $specialties = Specialty::published()->ordered()->get();

        return view('admin.hospitals.edit', compact('hospital', 'countries', 'cities', 'specialties'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $data = $this->validateHospital($request, $hospital);

        $hospital->update($data);

        if ($request->has('specialty_ids')) {
            $hospital->specialties()->sync($request->specialty_ids ?? []);
        }

        return redirect()->route('admin.hospitals.show', $hospital)
            ->with('success', 'Hospital updated successfully.');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Hospital deleted.');
    }

    private function validateHospital(Request $request, ?Hospital $hospital = null): array
    {
        return $request->validate([
            'name'                     => 'required|string|max:255',
            'tagline'                  => 'nullable|string|max:255',
            'description'              => 'nullable|string',
            'about'                    => 'nullable|string',
            'established_year'         => 'nullable|integer|min:1800|max:' . date('Y'),
            'bed_count'                => 'nullable|integer|min:0',
            'ot_count'                 => 'nullable|integer|min:0',
            'annual_patients'          => 'nullable|integer|min:0',
            'country_id'               => 'nullable|exists:countries,id',
            'city_id'                  => 'nullable|exists:cities,id',
            'address'                  => 'nullable|string',
            'phone'                    => 'nullable|string|max:30',
            'email'                    => 'nullable|email|max:255',
            'website'                  => 'nullable|url|max:255',
            'logo_url'                 => 'nullable|url|max:500',
            'featured_image_url'       => 'nullable|url|max:500',
            'tier'                     => 'nullable|in:standard,premium,elite',
            'is_partner'               => 'boolean',
            'is_jci_accredited'        => 'boolean',
            'is_nabh_accredited'       => 'boolean',
            'international_patient_desk'=> 'boolean',
            'published'                => 'boolean',
            'featured'                 => 'boolean',
            'position'                 => 'nullable|integer',
            'meta_title'               => 'nullable|string|max:255',
            'meta_description'         => 'nullable|string|max:500',
            'meta_keywords'            => 'nullable|string|max:500',
        ]);
    }
}
