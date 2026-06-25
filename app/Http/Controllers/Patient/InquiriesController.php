<?php

namespace App\Http\Controllers\Patient;

use App\Models\Inquiry;

class InquiriesController extends BaseController
{
    public function index()
    {
        $inquiries = $this->patientProfile->inquiries()
            ->with('specialty', 'treatment')
            ->latest()
            ->paginate(10);

        return view('patient.inquiries.index', compact('inquiries'));
    }

    public function show(int $id)
    {
        $inquiry = $this->patientProfile->inquiries()
            ->with('specialty', 'treatment', 'quotations', 'appointments', 'medicalRecords')
            ->findOrFail($id);

        return view('patient.inquiries.show', compact('inquiry'));
    }
}
