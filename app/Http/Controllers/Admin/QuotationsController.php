<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Quotation;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Treatment;
use App\Mail\QuotationSentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationsController extends Controller
{
    public function index(Inquiry $inquiry)
    {
        $quotations = $inquiry->quotations()->orderBy('created_at', 'desc')->get();

        return view('admin.quotations.index', compact('inquiry', 'quotations'));
    }

    public function create(Inquiry $inquiry)
    {
        $hospitals  = Hospital::published()->orderBy('name')->get();
        $doctors    = Doctor::published()->orderBy('first_name')->get();
        $treatments = Treatment::published()->ordered()->get();

        return view('admin.quotations.create', compact('inquiry', 'hospitals', 'doctors', 'treatments'));
    }

    public function store(Request $request, Inquiry $inquiry)
    {
        $data = $this->validateQuotation($request);
        $data['inquiry_id']         = $inquiry->id;
        $data['created_by_user_id'] = auth()->id();
        $data['total_cost']         = $this->calculateTotal($data);

        $quotation = Quotation::create($data);

        return redirect()->route('admin.inquiries.quotations.show', [$inquiry, $quotation])
            ->with('success', 'Quotation created.');
    }

    public function show(Inquiry $inquiry, Quotation $quotation)
    {
        return view('admin.quotations.show', compact('inquiry', 'quotation'));
    }

    public function edit(Inquiry $inquiry, Quotation $quotation)
    {
        $hospitals  = Hospital::published()->orderBy('name')->get();
        $doctors    = Doctor::published()->orderBy('first_name')->get();
        $treatments = Treatment::published()->ordered()->get();

        return view('admin.quotations.edit', compact('inquiry', 'quotation', 'hospitals', 'doctors', 'treatments'));
    }

    public function update(Request $request, Inquiry $inquiry, Quotation $quotation)
    {
        $data = $this->validateQuotation($request);
        $data['total_cost'] = $this->calculateTotal($data);

        $quotation->update($data);

        return redirect()->route('admin.inquiries.quotations.show', [$inquiry, $quotation])
            ->with('success', 'Quotation updated.');
    }

    public function destroy(Inquiry $inquiry, Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Quotation deleted.');
    }

    public function sendToPatient(Request $request, Inquiry $inquiry, Quotation $quotation)
    {
        $quotation->update([
            'status'  => 'sent',
            'sent_at' => now(),
        ]);

        $patientEmail = $inquiry->patient_email;

        if ($patientEmail) {
            Mail::to($patientEmail)->send(new QuotationSentMail($quotation));
        }

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Quotation sent to patient.');
    }

    public function previewPdf(Inquiry $inquiry, Quotation $quotation)
    {
        $pdf = Pdf::loadView('admin.quotations.pdf', compact('inquiry', 'quotation'));

        return $pdf->stream("quotation-{$quotation->reference_number}.pdf");
    }

    private function validateQuotation(Request $request): array
    {
        return $request->validate([
            'hospital_id'       => 'nullable|exists:hospitals,id',
            'doctor_id'         => 'nullable|exists:doctors,id',
            'treatment_id'      => 'nullable|exists:treatments,id',
            'currency'          => 'required|string|size:3',
            'treatment_cost'    => 'required|integer|min:0',
            'hospital_stay_cost'=> 'nullable|integer|min:0',
            'consultation_cost' => 'nullable|integer|min:0',
            'diagnostic_cost'   => 'nullable|integer|min:0',
            'medicine_cost'     => 'nullable|integer|min:0',
            'travel_cost'       => 'nullable|integer|min:0',
            'accommodation_cost'=> 'nullable|integer|min:0',
            'visa_cost'         => 'nullable|integer|min:0',
            'other_cost'        => 'nullable|integer|min:0',
            'discount_amount'   => 'nullable|integer|min:0',
            'deposit_percentage'=> 'nullable|integer|min:0|max:100',
            'inclusions'        => 'nullable|string',
            'exclusions'        => 'nullable|string',
            'validity_days'     => 'nullable|integer|min:1',
            'notes'             => 'nullable|string',
            'terms'             => 'nullable|string',
            'hospital_details'  => 'nullable|string',
            'doctor_details'    => 'nullable|string',
            'treatment_duration'=> 'nullable|string|max:100',
            'hospital_stay_days'=> 'nullable|integer|min:0',
            'valid_until'                    => 'nullable|date',
            'line_items'                     => 'nullable|array',
            'line_items.*.description'       => 'required_with:line_items.*|string|max:500',
            'line_items.*.amount'            => 'required_with:line_items.*|numeric|min:0',
        ]);
    }

    private function calculateTotal(array $data): int
    {
        $sum  = ($data['treatment_cost'] ?? 0)
              + ($data['hospital_stay_cost'] ?? 0)
              + ($data['consultation_cost'] ?? 0)
              + ($data['diagnostic_cost'] ?? 0)
              + ($data['medicine_cost'] ?? 0)
              + ($data['travel_cost'] ?? 0)
              + ($data['accommodation_cost'] ?? 0)
              + ($data['visa_cost'] ?? 0)
              + ($data['other_cost'] ?? 0);

        return max(0, $sum - ($data['discount_amount'] ?? 0));
    }
}
