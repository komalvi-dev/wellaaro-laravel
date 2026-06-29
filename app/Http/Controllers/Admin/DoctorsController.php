<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DoctorWelcomeMail;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialty;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $hospitals   = Hospital::published()->orderBy('name')->get();
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->get();

        return view('admin.doctors.create', compact('hospitals', 'specialties', 'treatments'));
    }

    public function store(Request $request)
    {
        $data = $this->validateDoctor($request);
        $doctorData = collect($data)->except(['hospital_ids', 'user_email'])->all();

        if ($request->hasFile('photo')) {
            $doctorData['photo_url'] = Storage::disk('public')->url(
                $request->file('photo')->store('doctors', 'public')
            );
        }

        // Provision a user account if an email was supplied.
        $userCreated = false;
        if (!empty($data['user_email'])) {
            $user = User::firstOrCreate(
                ['email' => $data['user_email']],
                ['role' => 'doctor', 'status' => 'active', 'password' => bcrypt(Str::random(32))],
            );
            $doctorData['user_id'] = $user->id;
            $userCreated = $user->wasRecentlyCreated;
        }

        $doctor = Doctor::create($doctorData);

        $this->syncDoctorRelations($doctor, $request);

        if ($userCreated) {
            Mail::send(new DoctorWelcomeMail($user, $doctor->full_name));
        }

        return redirect()->route('admin.doctors.show', $doctor)
            ->with('success', 'Doctor created successfully.' . ($userCreated ? ' A password-setup email has been sent.' : ''));
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['specialties', 'treatments', 'hospitals', 'hospital', 'appointments']);

        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $hospitals   = Hospital::published()->orderBy('name')->get();
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->get();

        return view('admin.doctors.edit', compact('doctor', 'hospitals', 'specialties', 'treatments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $this->validateDoctor($request);
        $doctorData = collect($data)->except(['hospital_ids', 'user_email'])->all();

        if ($request->hasFile('photo')) {
            $doctorData['photo_url'] = Storage::disk('public')->url(
                $request->file('photo')->store('doctors', 'public')
            );
        }

        // Provision or link a user account if an email was supplied and not already set.
        $userCreated = false;
        if (!empty($data['user_email']) && $doctor->user_id === null) {
            $user = User::firstOrCreate(
                ['email' => $data['user_email']],
                ['role' => 'doctor', 'status' => 'active', 'password' => bcrypt(Str::random(32))],
            );
            $doctorData['user_id'] = $user->id;
            $userCreated = $user->wasRecentlyCreated;
        }

        $doctor->update($doctorData);

        $this->syncDoctorRelations($doctor, $request);

        if ($userCreated) {
            Mail::send(new DoctorWelcomeMail($user, $doctor->full_name));
        }

        return redirect()->route('admin.doctors.show', $doctor)
            ->with('success', 'Doctor updated successfully.' . ($userCreated ? ' A password-setup email has been sent.' : ''));
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted.');
    }

    private function validateDoctor(Request $request): array
    {
        /** @var Doctor|null $doctor */
        $doctor       = $request->route('doctor');
        $linkedUserId = $doctor?->user_id;

        $emailRule = $linkedUserId
            ? 'nullable|email|max:255|unique:users,email,' . $linkedUserId
            : 'nullable|email|max:255|unique:users,email';

        return $request->validate([
            'user_email'             => $emailRule,
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
            'photo'                  => 'nullable|file|image|max:2048',
            'photo_url'              => 'nullable|url|max:500',
            'hospital_id'            => 'nullable|exists:hospitals,id',
            'hospital_ids'           => 'nullable|array',
            'hospital_ids.*'         => 'exists:hospitals,id',
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
        if ($request->has('hospital_ids')) {
            $doctor->hospitals()->sync($request->hospital_ids ?? []);
        }
    }
}
