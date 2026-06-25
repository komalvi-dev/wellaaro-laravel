<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Hospital;

class DoctorsController extends Controller
{
    public function index()
    {
        $query = Doctor::published()->with('specialties', 'hospital');

        if ($specialtyId = request('specialty_id')) {
            $query->whereHas('specialties', fn($q) => $q->where('specialties.id', $specialtyId));
        }
        if ($hospitalId = request('hospital_id')) {
            $query->where('hospital_id', $hospitalId);
        }
        if ($q = request('q')) {
            $query->where(fn($sub) => $sub
                ->where('first_name', 'like', "%{$q}%")
                ->orWhere('last_name',  'like', "%{$q}%")
                ->orWhere('designation','like', "%{$q}%")
                ->orWhere('about',      'like', "%{$q}%"));
        }

        $doctors     = $query->ordered()->paginate(12)->withQueryString();
        $specialties = Specialty::published()->ordered()->get();
        $hospitals   = Hospital::published()->ordered()->get();

        return view('doctors.index', compact('doctors', 'specialties', 'hospitals'));
    }

    public function show(string $slug)
    {
        $doctor = Doctor::where('slug', $slug)->where('published', true)->firstOrFail();
        $doctor->load('specialties', 'hospitals', 'treatments');
        return view('doctors.show', compact('doctor'));
    }
}
