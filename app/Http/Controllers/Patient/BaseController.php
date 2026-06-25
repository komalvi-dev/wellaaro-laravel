<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use Illuminate\Support\Facades\Auth;

abstract class BaseController extends Controller
{
    protected PatientProfile $patientProfile;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isPatient()) {
                abort(403, 'Access denied. Patient area only.');
            }
            $this->patientProfile = Auth::user()->patientProfile;
            if (!$this->patientProfile) {
                abort(404, 'Patient profile not found.');
            }
            return $next($request);
        });
    }
}
