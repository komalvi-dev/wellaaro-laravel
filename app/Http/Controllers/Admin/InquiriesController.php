<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryNote;
use App\Models\InquiryStatusHistory;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::with(['specialty', 'treatment', 'assignedTo', 'patientProfile']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to_user_id', $request->assigned_to);
        }
        if ($request->filled('specialty_id')) {
            $query->where('specialty_id', $request->specialty_id);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('q')) {
            $q = '%' . $request->q . '%';
            $query->where(function ($sub) use ($q) {
                $sub->where('email', 'like', $q)
                    ->orWhere('first_name', 'like', $q)
                    ->orWhere('last_name', 'like', $q)
                    ->orWhere('reference_number', 'like', $q);
            });
        }

        $inquiries    = $query->orderBy('created_at', 'desc')->paginate(25);
        $statuses     = Inquiry::STATUSES;
        $caseManagers = User::caseManagers()->with('staffProfile')->get();
        $specialties  = Specialty::published()->ordered()->get();

        return view('admin.inquiries.index', compact(
            'inquiries', 'statuses', 'caseManagers', 'specialties'
        ));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load([
            'specialty', 'treatment', 'assignedTo', 'patientProfile',
            'user',
        ]);

        $quotations    = $inquiry->quotations()->orderBy('created_at', 'desc')->get();
        $appointments  = $inquiry->appointments()->orderBy('appointment_date')->get();
        $notes         = $inquiry->inquiryNotes()->with('user')->orderBy('created_at')->get();
        $documents     = $inquiry->documents()->get();
        $medicalRecords= $inquiry->medicalRecords()->with(['patientProfile', 'uploadedBy'])->orderBy('created_at', 'desc')->get();
        $travel        = $inquiry->travelAssistance;
        $plan          = $inquiry->treatmentPlan;
        $payments      = $inquiry->payments()->orderBy('created_at', 'desc')->get();
        $history       = $inquiry->inquiryStatusHistories()->with('changedBy')->orderBy('created_at', 'desc')->get();
        $caseManagers  = User::caseManagers()->with('staffProfile')->get();

        return view('admin.inquiries.show', compact(
            'inquiry', 'quotations', 'appointments', 'notes', 'documents',
            'medicalRecords', 'travel', 'plan', 'payments', 'history', 'caseManagers'
        ));
    }

    public function create()
    {
        $patients     = \App\Models\PatientProfile::with('user')->orderBy('created_at', 'desc')->get();
        $specialties  = Specialty::published()->ordered()->get();
        $treatments   = \App\Models\Treatment::published()->ordered()->get();
        $destinations = \App\Models\Destination::published()->orderBy('name')->get();

        return view('admin.inquiries.create', compact('patients', 'specialties', 'treatments', 'destinations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'           => 'required|string|max:100',
            'last_name'            => 'required|string|max:100',
            'email'                => 'required|email|max:255',
            'phone'                => 'nullable|string|max:30',
            'specialty_id'         => 'nullable|exists:specialties,id',
            'treatment_id'         => 'nullable|exists:treatments,id',
            'condition_description'=> 'nullable|string',
            'priority'             => 'required|in:' . implode(',', Inquiry::PRIORITIES),
        ]);

        $inquiry = Inquiry::create($data);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Inquiry created successfully.');
    }

    public function edit(Inquiry $inquiry)
    {
        $specialties  = Specialty::published()->ordered()->get();
        $treatments   = \App\Models\Treatment::published()->ordered()->get();
        $destinations = \App\Models\Destination::published()->orderBy('name')->get();

        return view('admin.inquiries.edit', compact('inquiry', 'specialties', 'treatments', 'destinations'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:30',
            'specialty_id' => 'nullable|exists:specialties,id',
            'treatment_id' => 'nullable|exists:treatments,id',
            'priority'     => 'required|in:' . implode(',', Inquiry::PRIORITIES),
        ]);

        $inquiry->update($data);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Inquiry updated successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted.');
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', Inquiry::STATUSES),
        ]);

        $oldStatus = $inquiry->status;

        if ($inquiry->update(['status' => $request->status])) {
            InquiryStatusHistory::create([
                'inquiry_id'         => $inquiry->id,
                'from_status'        => $oldStatus,
                'to_status'          => $request->status,
                'changed_by_user_id' => auth()->id(),
                'reason'             => $request->reason,
            ]);

            return redirect()->route('admin.inquiries.show', $inquiry)
                ->with('success', 'Status updated to ' . ucfirst(str_replace('_', ' ', $request->status)) . '.');
        }

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('error', 'Could not update status.');
    }

    public function assign(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $inquiry->update(['assigned_to_user_id' => $request->user_id]);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Inquiry assigned successfully.');
    }

    public function addNote(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'content'   => 'required|string',
            'note_type' => 'nullable|string|in:general,call,email,follow_up',
        ]);

        $inquiry->inquiryNotes()->create([
            'user_id'     => auth()->id(),
            'content'     => $request->content,
            'note_type'   => $request->note_type ?? 'general',
            'is_internal' => $request->is_internal !== '0',
        ]);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Note added.');
    }
}
