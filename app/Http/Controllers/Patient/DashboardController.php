<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isPatient()) {
                abort(403, 'Access denied.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $user    = auth()->user();
        $profile = $user->patientProfile;

        if (!$profile) {
            abort(404, 'Patient profile not found.');
        }

        $recentInquiries     = $profile->inquiries()->with('specialty', 'treatment')->latest()->limit(5)->get();
        $upcomingAppointments= $profile->appointments()->upcoming()->with('doctor', 'hospital')->get();
        $unreadNotifications = $user->customNotifications()->unread()->latest()->limit(10)->get();

        return view('patient.dashboard.index', compact(
            'profile', 'recentInquiries', 'upcomingAppointments', 'unreadNotifications'
        ));
    }
}
