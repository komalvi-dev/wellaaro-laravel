<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Specialty;
use App\Models\Country;

class HospitalsController extends Controller
{
    public function index()
    {
        $query = Hospital::published()->with('city', 'country');

        if ($specialtyId = request('specialty_id')) {
            $query->whereHas('specialties', fn($q) => $q->where('specialties.id', $specialtyId));
        }
        if ($countryId = request('country_id')) {
            $query->where('country_id', $countryId);
        }
        if ($q = request('q')) {
            $query->where(fn($sub) => $sub->where('name', 'like', "%{$q}%")
                ->orWhere('tagline', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%"));
        }

        $hospitals   = $query->ordered()->paginate(12)->withQueryString();
        $specialties = Specialty::published()->ordered()->get();
        $countries   = Country::destinations()->ordered()->get();

        return view('hospitals.index', compact('hospitals', 'specialties', 'countries'));
    }

    public function show(string $slug)
    {
        $hospital = Hospital::where('slug', $slug)->where('published', true)->firstOrFail();
        $hospital->load('city', 'country', 'facilities', 'gallery', 'specialties');
        $doctors      = $hospital->doctors()->published()->with('specialties')->limit(8)->get();
        $testimonials = $hospital->testimonials()->published()->limit(6)->get();

        return view('hospitals.show', compact('hospital', 'doctors', 'testimonials'));
    }
}
