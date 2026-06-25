<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialty;
use App\Models\Treatment;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::with(['hospital', 'specialties']);

        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('first_name', 'like', '%' . $request->q . '%')
                    ->orWhere('last_name', 'like', '%' . $request->q . '%');
            });
        }
        if ($request->filled('hospital_id')) {
            $query->where('hospital_id', $request->hospital_id);
        }
        if ($request->filled('published')) {
            $query->where('published', $request->published == '1');
        }

        $doctors   = $query->orderBy('position')->paginate(25);
        $hospitals = Hospital::published()->orderBy('name')->get();

        return view('admin.doctors.index', compact('doctors', 'hospitals'));
    }

    public function create()
    {
        $hospitals   = Hospital::orderBy('name')->get();
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->get();

        return view('admin.doctors.create', compact('hospitals', 'specialties', 'treatments'));
    }

    public function store(Request $request)
    {
        $data = $this->validateDoctor($request);

        $doctor = Doctor::create($data);

        $this->syncDoctorRelations($doctor, $request);

        return redirect()->route('admin.doctors.show', $doctor)
            ->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['specialties', 'treatments', 'hospitals', 'hospital', 'appointments']);

        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $hospitals   = Hospital::orderBy('name')->get();
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->get();

        return view('admin.doctors.edit', compact('doctor', 'hospitals', 'specialties', 'treatments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $this->validateDoctor($request);

        $doctor->update($data);

        $this->syncDoctorRelations($doctor, $request);

        return redirect()->route('admin.doctors.show', $doctor)
            ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted.');
    }

    private function validateDoctor(Request $request): array
    {
        return $request->validate([
            'first_name'             => 'required|string|max:100',
            'last_name'              => 'required|string|max:100',
            'title'                  => 'nullable|string|max:20',
            'designation'            => 'nullable|string|max:255',
            'qualifications'         => 'nullable|string|max:500',
            'experience_years'       => 'nullable|integer|min:0',
            'about'                  => 'nullable|string',
            'training'               => 'nullable|string',
            'achievements'           => 'nullable|string',
            'consultation_fee_usd'   => 'nullable|integer|min:0',
            'online_consultation'    => 'boolean',
            'in_person_consultation' => 'boolean',
            'response_time_hours'    => 'nullable|integer|min:1',
            'photo_url'              => 'nullable|url|max:500',
            'hospital_id'            => 'nullable|exists:hospitals,id',
            'published'              => 'boolean',
            'featured'               => 'boolean',
            'position'               => 'nullable|integer',
            'meta_title'             => 'nullable|string|max:255',
            'meta_description'       => 'nullable|string|max:500',
        ]);
    }

    private function syncDoctorRelations(Doctor $doctor, Request $request): void
    {
        if ($request->has('specialty_ids')) {
            $doctor->specialties()->sync($request->specialty_ids ?? []);
        }
        if ($request->has('treatment_ids')) {
            $doctor->treatments()->sync($request->treatment_ids ?? []);
        }
    }
}
