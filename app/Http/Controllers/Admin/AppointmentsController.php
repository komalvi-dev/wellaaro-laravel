<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Inquiry;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Treatment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['inquiry', 'doctor', 'hospital', 'treatment', 'patientProfile']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from')) {
            $query->whereDate('appointment_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('appointment_date', '<=', $request->to);
        }

        $appointments = $query->orderBy('appointment_date', 'desc')->paginate(25);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['inquiry', 'doctor', 'hospital', 'treatment', 'patientProfile', 'createdBy']);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function create(?Inquiry $inquiry = null)
    {
        $doctors   = Doctor::published()->orderBy('first_name')->get();
        $hospitals = Hospital::published()->orderBy('name')->get();
        $treatments= Treatment::published()->ordered()->get();
        $patients  = \App\Models\PatientProfile::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.appointments.create', compact('inquiry', 'doctors', 'hospitals', 'treatments', 'patients'));
    }

    public function store(Request $request, ?Inquiry $inquiry = null)
    {
        $data = $this->validateAppointment($request);
        $data['created_by_user_id'] = auth()->id();

        if ($inquiry) {
            $data['inquiry_id'] = $inquiry->id;
        }

        $appointment = Appointment::create($data);

        if ($inquiry) {
            return redirect()->route('admin.inquiries.show', $inquiry)
                ->with('success', 'Appointment created.');
        }

        return redirect()->route('admin.appointments.show', $appointment)
            ->with('success', 'Appointment created.');
    }

    public function edit(Appointment $appointment)
    {
        $doctors   = Doctor::published()->orderBy('first_name')->get();
        $hospitals = Hospital::published()->orderBy('name')->get();
        $treatments= Treatment::published()->ordered()->get();

        return view('admin.appointments.edit', compact('appointment', 'doctors', 'hospitals', 'treatments'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($this->validateAppointment($request));

        return redirect()->route('admin.appointments.show', $appointment)
            ->with('success', 'Appointment updated.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->update([
            'status'              => 'cancelled',
            'cancelled_at'        => now(),
            'cancelled_by_user_id'=> auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Appointment cancelled.');
    }

    private function validateAppointment(Request $request): array
    {
        return $request->validate([
            'appointment_type'  => 'required|string|in:consultation,follow_up,procedure,online',
            'appointment_date'  => 'required|date',
            'appointment_time'  => 'required|date_format:H:i',
            'timezone'          => 'nullable|string|max:50',
            'duration_minutes'  => 'nullable|integer|min:15',
            'doctor_id'         => 'nullable|exists:doctors,id',
            'hospital_id'       => 'nullable|exists:hospitals,id',
            'treatment_id'      => 'nullable|exists:treatments,id',
            'meeting_link'      => 'nullable|url|max:500',
            'meeting_notes'     => 'nullable|string',
            'notes'             => 'nullable|string',
            'status'            => 'nullable|in:scheduled,confirmed,completed,cancelled,no_show',
        ]);
    }
}
