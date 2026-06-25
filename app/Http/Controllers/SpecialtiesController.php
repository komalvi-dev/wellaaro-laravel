<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\Hospital;

class SpecialtiesController extends Controller
{
    public function index()
    {
        $specialties = Specialty::published()->ordered()->get();
        return view('specialties.index', compact('specialties'));
    }

    public function show(string $slug)
    {
        $specialty = Specialty::where('slug', $slug)->where('published', true)->firstOrFail();
        $treatments = $specialty->treatments()->published()->ordered()->get();
        $faqs       = $specialty->faqs()->published()->ordered()->get();
        $hospitals  = Hospital::published()
            ->whereHas('specialties', fn($q) => $q->where('specialties.id', $specialty->id))
            ->with('city', 'country')
            ->limit(6)
            ->get();

        return view('specialties.show', compact('specialty', 'treatments', 'faqs', 'hospitals'));
    }
}
