<?php

namespace App\Http\Controllers\Patient;

class PaymentsController extends BaseController
{
    public function index()
    {
        $payments = $this->patientProfile->payments()
            ->with('inquiry', 'quotation')
            ->latest()
            ->paginate(10);

        return view('patient.payments.index', compact('payments'));
    }
}
