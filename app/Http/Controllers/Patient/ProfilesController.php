<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;

class ProfilesController extends BaseController
{
    public function show()
    {
        return view('patient.profiles.show', ['profile' => $this->patientProfile]);
    }

    public function edit()
    {
        return view('patient.profiles.edit', ['profile' => $this->patientProfile]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name'                => 'required|string|max:100',
            'last_name'                 => 'required|string|max:100',
            'date_of_birth'             => 'nullable|date',
            'gender'                    => 'nullable|in:male,female,other',
            'phone'                     => 'nullable|string|max:30',
            'phone_country_code'        => 'nullable|string|max:10',
            'whatsapp_number'           => 'nullable|string|max:30',
            'nationality'               => 'nullable|string|max:100',
            'country_of_residence'      => 'nullable|string|max:100',
            'city'                      => 'nullable|string|max:100',
            'address'                   => 'nullable|string',
            'passport_number'           => 'nullable|string|max:50',
            'passport_expiry'           => 'nullable|date',
            'emergency_contact_name'    => 'nullable|string|max:100',
            'emergency_contact_phone'   => 'nullable|string|max:30',
            'emergency_contact_relation'=> 'nullable|string|max:50',
            'preferred_language'        => 'nullable|string|max:10',
        ]);

        $this->patientProfile->update($validated);

        return redirect()->route('patient.profile.show')->with('success', 'Profile updated successfully.');
    }
}
