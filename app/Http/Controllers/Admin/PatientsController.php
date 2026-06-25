<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientProfile::with('user');

        if ($request->filled('q')) {
            $q = '%' . $request->q . '%';
            $query->where(function ($sub) use ($q) {
                $sub->where('first_name', 'like', $q)
                    ->orWhere('last_name', 'like', $q)
                    ->orWhereHas('user', fn($u) => $u->where('email', 'like', $q));
            });
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate(25);

        return view('admin.patients.index', compact('patients'));
    }

    public function show(PatientProfile $patient)
    {
        $patient->load(['user', 'inquiries.specialty', 'appointments', 'medicalRecords', 'payments']);

        return view('admin.patients.show', compact('patient'));
    }
}
