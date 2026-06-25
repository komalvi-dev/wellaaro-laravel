<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Specialty;
use App\Models\Destination;

class PackagesController extends Controller
{
    public function index()
    {
        $query = Package::published();

        if ($specialtyId = request('specialty_id')) {
            $query->where('specialty_id', $specialtyId);
        }
        if ($destinationId = request('destination_id')) {
            $query->where('destination_id', $destinationId);
        }

        $packages     = $query->ordered()->paginate(12)->withQueryString();
        $specialties  = Specialty::published()->ordered()->get();
        $destinations = Destination::published()->ordered()->get();

        return view('packages.index', compact('packages', 'specialties', 'destinations'));
    }

    public function show(string $slug)
    {
        $package = Package::where('slug', $slug)->where('published', true)->firstOrFail();
        $package->load('treatments', 'hospital', 'destination', 'specialty');
        return view('packages.show', compact('package'));
    }
}
