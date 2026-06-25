<?php

namespace App\Http\Controllers\Patient;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordsController extends BaseController
{
    public function index()
    {
        $records = $this->patientProfile->medicalRecords()->latest()->paginate(15);
        return view('patient.medical_records.index', compact('records'));
    }

    public function create()
    {
        return view('patient.medical_records.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'record_type' => 'required|string|max:100',
            'record_date' => 'nullable|date',
            'description' => 'nullable|string',
            'file'        => 'required|file|max:20480',
        ]);

        $file     = $request->file('file');
        $path     = $file->store('medical-records', 'public');
        $fileUrl  = asset('storage/' . $path);

        MedicalRecord::create([
            'patient_profile_id'  => $this->patientProfile->id,
            'uploaded_by_user_id' => auth()->id(),
            'title'               => $request->title,
            'record_type'         => $request->record_type,
            'record_date'         => $request->record_date,
            'description'         => $request->description,
            'file_name'           => $file->getClientOriginalName(),
            'file_size'           => $file->getSize(),
            'content_type'        => $file->getMimeType(),
            'file_url'            => $fileUrl,
        ]);

        return redirect()->route('patient.medical_records.index')
            ->with('success', 'Medical record uploaded successfully.');
    }

    public function destroy(int $id)
    {
        $record = $this->patientProfile->medicalRecords()->findOrFail($id);
        $record->delete();

        return redirect()->route('patient.medical_records.index')
            ->with('success', 'Medical record deleted.');
    }
}
