<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Specialty;

class TreatmentsController extends Controller
{
    public function index()
    {
        $treatments = Treatment::published()->ordered()->with('specialty')->get();
        $specialties = Specialty::published()->ordered()->get();
        return view('treatments.index', compact('treatments', 'specialties'));
    }

    public function show(string $slug)
    {
        $treatment = Treatment::where('slug', $slug)->where('published', true)->firstOrFail();
        $treatment->load('specialty', 'conditions', 'faqs');
        $doctors   = $treatment->doctors()->published()->with('hospital')->limit(6)->get();
        $hospitals = $treatment->doctors()->published()->with('hospital')
            ->get()->pluck('hospital')->filter()->unique('id')->values();

        return view('treatments.show', compact('treatment', 'doctors', 'hospitals'));
    }
}
