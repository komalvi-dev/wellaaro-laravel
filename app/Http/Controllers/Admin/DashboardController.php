<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Quotation;
use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\Hospital;
use App\Models\Doctor;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'new_inquiries'       => Inquiry::where('status', 'new')->count(),
            'total_inquiries'     => Inquiry::count(),
            'sent_quotations'     => Quotation::where('status', 'sent')->count(),
            'upcoming_appointments'=> Appointment::upcoming()->count(),
            'total_patients'      => PatientProfile::count(),
            'total_hospitals'     => Hospital::count(),
            'total_doctors'       => Doctor::count(),
        ];

        $recentInquiries = Inquiry::with(['specialty', 'treatment', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $urgentInquiries = Inquiry::where('priority', 'urgent')
            ->whereNotIn('status', ['closed_won', 'closed_lost'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $pendingQuotations = Quotation::where('status', 'sent')
            ->with('inquiry')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats', 'recentInquiries', 'urgentInquiries', 'pendingQuotations'
        ));
    }
}
