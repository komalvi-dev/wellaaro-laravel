<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentCancelledMail;
use App\Mail\AppointmentConfirmationMail;
use App\Models\Appointment;
use App\Models\Inquiry;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $data = $this->splitDatetime($data);
        $data['created_by_user_id'] = auth()->id();

        if ($inquiry) {
            $data['inquiry_id'] = $inquiry->id;
        }

        $appointment = Appointment::create($data);

        $toEmail = $appointment->inquiry?->email
            ?? $appointment->patientProfile?->user?->email;

        if ($toEmail) {
            Mail::to($toEmail)->send(new AppointmentConfirmationMail($appointment));
        }

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
        $appointment->update($this->splitDatetime($this->validateAppointment($request)));

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

        $patient = $appointment->patientProfile?->user;
        if ($patient?->email) {
            Mail::to($patient->email)->send(new AppointmentCancelledMail($appointment));
        }

        return redirect()->back()->with('success', 'Appointment cancelled.');
    }

    private function validateAppointment(Request $request): array
    {
        return $request->validate([
            'patient_profile_id' => 'required|exists:patient_profiles,id',
            'appointment_type'   => 'required|string|in:consultation,follow_up,procedure,online',
            // The view submits a single datetime-local field (Y-m-d\TH:i).
            // splitDatetime() will separate it into appointment_date and appointment_time.
            'appointment_date'   => 'required|date_format:Y-m-d\TH:i',
            'timezone'           => 'nullable|string|max:50',
            'duration_minutes'   => 'nullable|integer|min:15',
            'doctor_id'          => 'nullable|exists:doctors,id',
            'hospital_id'        => 'nullable|exists:hospitals,id',
            'treatment_id'       => 'nullable|exists:treatments,id',
            'meeting_link'       => 'nullable|url|max:500',
            'meeting_notes'      => 'nullable|string',
            'notes'              => 'nullable|string',
            'status'             => 'nullable|in:scheduled,confirmed,completed,cancelled,no_show',
        ]);
    }

    /**
     * Split the datetime-local value (Y-m-d\TH:i) submitted by the form into
     * the separate appointment_date (Y-m-d) and appointment_time (H:i) columns
     * that the database expects, then discard the original combined key.
     */
    private function splitDatetime(array $data): array
    {
        if (!empty($data['appointment_date'])) {
            $dt = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $data['appointment_date']);
            $data['appointment_date'] = $dt->toDateString();  // Y-m-d
            $data['appointment_time'] = $dt->format('H:i');   // H:i
        }

        return $data;
    }
}
