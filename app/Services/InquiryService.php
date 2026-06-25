<?php

namespace App\Services;

use App\Jobs\NotifyStaffOfNewInquiry;
use App\Mail\InquiryConfirmationMail;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryService
{
    public function createFromRequest(array $data, Request $request): Inquiry
    {
        // Merge UTM params from session
        foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'] as $param) {
            $data[$param] = $data[$param] ?? $request->session()->get($param);
        }

        $data['landing_page']  = $data['landing_page'] ?? $request->session()->get('landing_page');
        $data['referrer_url']  = $data['referrer_url'] ?? $request->headers->get('referer');
        $data['ip_address']    = $request->ip();
        $data['user_agent']    = $request->userAgent();

        if (auth()->check()) {
            $data['user_id']            = auth()->id();
            $data['patient_profile_id'] = auth()->user()->patientProfile?->id;
        }

        $inquiry = Inquiry::create($data);

        // Notify staff asynchronously
        NotifyStaffOfNewInquiry::dispatch($inquiry);

        // Send confirmation to patient
        if (!empty($inquiry->email)) {
            Mail::queue(new InquiryConfirmationMail($inquiry));
        }

        return $inquiry;
    }
}
