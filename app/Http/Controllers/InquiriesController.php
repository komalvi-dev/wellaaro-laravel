<?php

namespace App\Http\Controllers;

use App\Mail\InquiryConfirmationMail;
use App\Mail\InquiryNotificationMail;
use App\Models\Inquiry;
use App\Models\Specialty;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiriesController extends Controller
{
    public function create()
    {
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->with('specialty')->get();
        return view('inquiries.new', compact('specialties', 'treatments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'email'                 => 'required|email|max:255',
            'phone'                 => 'required|string|max:30',
            'specialty_id'          => 'required|exists:specialties,id',
            'treatment_id'          => 'nullable|exists:treatments,id',
            'condition_description' => 'required|string',
            'preferred_destination' => 'nullable|string',
            'preferred_timeline'    => 'nullable|string',
            'budget_range'          => 'nullable|string',
            'companions_count'      => 'nullable|integer|min:0',
            'accommodation_pref'    => 'nullable|string',
            'needs_visa_assistance' => 'nullable|boolean',
            'needs_airport_transfer'=> 'nullable|boolean',
            'needs_interpreter'     => 'nullable|boolean',
            'whatsapp_opt_in'       => 'nullable|boolean',
            'additional_notes'      => 'nullable|string',
        ]);

        $validated['utm_source']   = session('utm_source');
        $validated['utm_medium']   = session('utm_medium');
        $validated['utm_campaign'] = session('utm_campaign');
        $validated['utm_term']     = session('utm_term');
        $validated['utm_content']  = session('utm_content');
        $validated['landing_page'] = session('landing_page');
        $validated['ip_address']   = $request->ip();
        $validated['user_agent']   = $request->userAgent();
        $validated['source_page']  = $request->header('referer');

        if (auth()->check()) {
            $validated['user_id']          = auth()->id();
            $validated['patient_profile_id'] = auth()->user()->patientProfile?->id;
        }

        $inquiry = Inquiry::create($validated);

        Mail::queue(new InquiryConfirmationMail($inquiry));
        Mail::queue(new InquiryNotificationMail($inquiry));

        session(['inquiry_reference' => $inquiry->reference_number]);

        return redirect()->route('inquiry_confirmation');
    }

    public function confirmation()
    {
        $reference = session('inquiry_reference');
        return view('inquiries.confirmation', compact('reference'));
    }

    public function treatmentsForSpecialty(Request $request)
    {
        $treatments = Treatment::published()
            ->where('specialty_id', $request->specialty_id)
            ->ordered()
            ->get(['id', 'name']);

        return response()->json($treatments);
    }
}
