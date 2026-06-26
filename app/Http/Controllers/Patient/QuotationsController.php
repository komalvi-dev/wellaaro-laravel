<?php

namespace App\Http\Controllers\Patient;

use App\Mail\QuotationAcceptedMail;
use App\Mail\QuotationRejectedMail;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuotationsController extends BaseController
{
    public function index()
    {
        $quotations = Quotation::whereHas('inquiry', fn($q) =>
            $q->where('patient_profile_id', $this->patientProfile->id)
        )->with('inquiry', 'hospital', 'doctor', 'treatment')->latest()->paginate(10);

        return view('patient.quotations.index', compact('quotations'));
    }

    public function show(int $id)
    {
        $quotation = Quotation::whereHas('inquiry', fn($q) =>
            $q->where('patient_profile_id', $this->patientProfile->id)
        )->with('inquiry', 'hospital', 'doctor', 'treatment')->findOrFail($id);

        if ($quotation->status === 'sent') {
            $quotation->update(['viewed_at' => now(), 'status' => 'viewed']);
        }

        return view('patient.quotations.show', compact('quotation'));
    }

    public function respond(Request $request, int $id)
    {
        $quotation = Quotation::whereHas('inquiry', fn($q) =>
            $q->where('patient_profile_id', $this->patientProfile->id)
        )->findOrFail($id);

        $request->validate([
            'patient_response'      => 'required|in:accepted,rejected',
            'patient_response_note' => 'nullable|string|max:1000',
        ]);

        $quotation->update([
            'status'               => $request->patient_response,
            'patient_response'     => $request->patient_response,
            'patient_response_note'=> $request->patient_response_note,
            'responded_at'         => now(),
        ]);

        if ($request->patient_response === 'accepted') {
            $message = 'Quotation accepted successfully.';
            if ($quotation->createdBy) {
                Mail::send(new QuotationAcceptedMail($quotation));
            }
        } else {
            $message = 'Quotation has been declined.';
            if ($quotation->createdBy) {
                Mail::send(new QuotationRejectedMail($quotation));
            }
        }

        return redirect()->route('patient.quotations.show', $id)->with('success', $message);
    }
}
