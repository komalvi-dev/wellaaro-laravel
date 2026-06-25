<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Specialty;
use App\Models\Treatment;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        $faqs = Faq::with(['specialty', 'treatment'])->orderBy('position')->paginate(25);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->get();
        return view('admin.faqs.create', compact('specialties', 'treatments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question'     => 'required|string',
            'answer'       => 'required|string',
            'category'     => 'nullable|string|max:100',
            'specialty_id' => 'nullable|exists:specialties,id',
            'treatment_id' => 'nullable|exists:treatments,id',
            'position'     => 'nullable|integer',
            'published'    => 'boolean',
        ]);
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created.');
    }

    public function show(Faq $faq) { return view('admin.faqs.show', compact('faq')); }

    public function edit(Faq $faq)
    {
        $specialties = Specialty::published()->ordered()->get();
        $treatments  = Treatment::published()->ordered()->get();
        return view('admin.faqs.edit', compact('faq', 'specialties', 'treatments'));
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->update($request->validate([
            'question'     => 'required|string',
            'answer'       => 'required|string',
            'category'     => 'nullable|string|max:100',
            'specialty_id' => 'nullable|exists:specialties,id',
            'treatment_id' => 'nullable|exists:treatments,id',
            'position'     => 'nullable|integer',
            'published'    => 'boolean',
        ]));
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted.');
    }
}
