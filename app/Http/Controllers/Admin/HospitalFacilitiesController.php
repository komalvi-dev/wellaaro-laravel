<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\HospitalFacility;
use Illuminate\Http\Request;

class HospitalFacilitiesController extends Controller
{
    public function index(Hospital $hospital)
    {
        return view('admin.hospitals.facilities', compact('hospital'));
    }

    public function store(Request $request, Hospital $hospital)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:100',
            'category'   => 'nullable|string|max:100',
        ]);
        $hospital->facilities()->create($data);
        return redirect()->route('admin.hospitals.facilities.index', $hospital)->with('success', 'Facility added.');
    }

    public function destroy(Hospital $hospital, HospitalFacility $facility)
    {
        $facility->delete();
        return redirect()->route('admin.hospitals.facilities.index', $hospital)->with('success', 'Facility removed.');
    }
}
