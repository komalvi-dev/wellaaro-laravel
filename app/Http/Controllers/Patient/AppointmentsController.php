<?php

namespace App\Http\Controllers\Patient;

class AppointmentsController extends BaseController
{
    public function index()
    {
        $appointments = $this->patientProfile->appointments()
            ->with('doctor', 'hospital', 'treatment')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('patient.appointments.index', compact('appointments'));
    }

    public function show(int $id)
    {
        $appointment = $this->patientProfile->appointments()
            ->with('doctor', 'hospital', 'treatment', 'inquiry')
            ->findOrFail($id);

        return view('patient.appointments.show', compact('appointment'));
    }
}
