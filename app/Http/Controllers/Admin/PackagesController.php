<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Specialty;
use App\Models\Hospital;
use App\Models\Destination;
use App\Models\Treatment;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::with(['specialty', 'hospital', 'destination']);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $packages = $query->orderBy('position')->paginate(25);

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $package      = new Package();
        $specialties  = Specialty::published()->ordered()->get();
        $hospitals    = Hospital::published()->orderBy('name')->get();
        $destinations = Destination::published()->ordered()->get();
        $treatments   = Treatment::published()->ordered()->get();

        return view('admin.packages.create', compact('package', 'specialties', 'hospitals', 'destinations', 'treatments'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePackage($request);

        $package = Package::create($data);

        if ($request->filled('treatment_ids')) {
            $package->treatments()->sync($request->treatment_ids);
        }

        return redirect()->route('admin.packages.show', $package)
            ->with('success', 'Package created.');
    }

    public function show(Package $package)
    {
        $package->load(['specialty', 'hospital', 'destination', 'treatments']);

        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        $specialties  = Specialty::published()->ordered()->get();
        $hospitals    = Hospital::published()->orderBy('name')->get();
        $destinations = Destination::published()->ordered()->get();
        $treatments   = Treatment::published()->ordered()->get();

        return view('admin.packages.edit', compact('package', 'specialties', 'hospitals', 'destinations', 'treatments'));
    }

    public function update(Request $request, Package $package)
    {
        $package->update($this->validatePackage($request));

        if ($request->has('treatment_ids')) {
            $package->treatments()->sync($request->treatment_ids ?? []);
        }

        return redirect()->route('admin.packages.show', $package)
            ->with('success', 'Package updated.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package deleted.');
    }

    private function validatePackage(Request $request): array
    {
        return $request->validate([
            'name'              => 'required|string|max:255',
            'tagline'           => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'duration_days_min' => 'nullable|integer|min:1',
            'duration_days_max' => 'nullable|integer|min:1',
            'price_usd_from'    => 'nullable|integer|min:0',
            'price_note'        => 'nullable|string|max:255',
            'destination_id'    => 'nullable|exists:destinations,id',
            'specialty_id'      => 'nullable|exists:specialties,id',
            'hospital_id'       => 'nullable|exists:hospitals,id',
            'package_type'      => 'nullable|string|max:50',
            'featured_image_url'=> 'nullable|url|max:500',
            'published'         => 'boolean',
            'featured'          => 'boolean',
            'position'          => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'meta_keywords'     => 'nullable|string|max:500',
        ]);
    }
}
