<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        if ($cityId = request('city_id')) {
            $query->where('city_id', $cityId);
        }
        if (request('jci')) {
            $query->where('is_jci_accredited', true);
        }
        if (request('nabh')) {
            $query->where('is_nabh_accredited', true);
        }
        if ($q = request('q')) {
            $query->where(fn($sub) => $sub->where('name', 'like', "%{$q}%")
                ->orWhere('tagline', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%"));
        }

        $sort = request('sort', 'featured');
        $query = match($sort) {
            'rating' => $query->orderByDesc('rating'),
            'name'   => $query->orderBy('name'),
            default  => $query->ordered(),
        };

        $hospitals   = $query->paginate(12)->withQueryString();
        $specialties = Specialty::published()->ordered()->get();
        $countries   = Country::destinations()->ordered()->get();
        $cities      = City::whereHas('hospitals', fn($q) => $q->where('published', true))->orderBy('name')->get();

        return view('hospitals.index', compact('hospitals', 'specialties', 'countries', 'cities'));
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
