<?php

namespace App\Http\Controllers;

use App\Jobs\NotifyStaffOfNewInquiry;
use App\Mail\InquiryConfirmationMail;
use App\Mail\InquiryNotificationMail;
use App\Models\Inquiry;
use App\Models\Specialty;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
            'last_name'             => 'nullable|string|max:100',
            'email'                 => 'required|email|max:255',
            'phone'                 => 'required|string|max:30',
            'country_of_residence'  => 'nullable|string|max:100',
            'age'                   => 'nullable|integer|min:1|max:120',
            'gender'                => 'nullable|string|max:20',
            'specialty_id'          => 'nullable|exists:specialties,id',
            'treatment_id'          => 'nullable|exists:treatments,id',
            'condition_description' => 'nullable|string',
            'preferred_destination' => 'nullable|string',
            'preferred_timeline'    => 'nullable|string',
            'budget_range'          => 'nullable|string',
            'current_medications'   => 'nullable|string',
            'previous_treatments'   => 'nullable|string',
            'companions_count'      => 'nullable|integer|min:0',
            'accommodation_pref'    => 'nullable|string',
            'needs_visa_assistance' => 'nullable|boolean',
            'needs_airport_transfer'=> 'nullable|boolean',
            'needs_interpreter'     => 'nullable|boolean',
            'whatsapp_opt_in'       => 'nullable|boolean',
            'email_opt_in'          => 'nullable|boolean',
            'additional_notes'      => 'nullable|string',
            'medical_reports'       => 'nullable|array',
            'medical_reports.*'     => 'nullable|file|max:10240',
        ]);

        $medicalReports = $request->file('medical_reports', []);
        unset($validated['medical_reports']);

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

        foreach ($medicalReports as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $path = $file->store('inquiries/medical-reports', 'public');

            $inquiry->documents()->create([
                'uploaded_by_user_id'   => auth()->id() ?? $inquiry->user_id,
                'title'                 => $file->getClientOriginalName(),
                'document_type'         => 'medical_report',
                'file_name'             => $file->getClientOriginalName(),
                'file_size'             => $file->getSize(),
                'content_type'          => $file->getClientMimeType(),
                'file_url'              => Storage::disk('public')->url($path),
                'is_visible_to_patient' => true,
            ]);
        }

        try {
            Mail::send(new InquiryConfirmationMail($inquiry));
            Mail::to(config('mail.inquiry_notification_address'))->send(new InquiryNotificationMail($inquiry));
            NotifyStaffOfNewInquiry::dispatch($inquiry);
        } catch (\Throwable $e) {
            \Log::error('Inquiry mail failed: ' . $e->getMessage(), ['inquiry_id' => $inquiry->id]);
        }

        session(['inquiry_reference' => $inquiry->reference_number]);

        return redirect()->route('inquiry.confirmation');
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
