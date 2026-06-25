<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    public function index()
    {
        $conditions = Condition::orderBy('name')->paginate(25);
        return view('admin.conditions.index', compact('conditions'));
    }

    public function create()
    {
        $condition = new Condition();
        return view('admin.conditions.create', compact('condition'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'icd10_code'       => 'nullable|string|max:20',
            'short_description'=> 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'symptoms'         => 'nullable|string',
            'causes'           => 'nullable|string',
            'diagnosis'        => 'nullable|string',
            'treatment_overview'=> 'nullable|string',
            'published'        => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
        $condition = Condition::create($data);
        return redirect()->route('admin.conditions.show', $condition)->with('success', 'Condition created.');
    }

    public function show(Condition $condition)
    {
        $condition->load('treatments');
        return view('admin.conditions.show', compact('condition'));
    }

    public function edit(Condition $condition)
    {
        return view('admin.conditions.edit', compact('condition'));
    }

    public function update(Request $request, Condition $condition)
    {
        $condition->update($request->validate([
            'name'             => 'required|string|max:255',
            'icd10_code'       => 'nullable|string|max:20',
            'short_description'=> 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'symptoms'         => 'nullable|string',
            'causes'           => 'nullable|string',
            'diagnosis'        => 'nullable|string',
            'treatment_overview'=> 'nullable|string',
            'published'        => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]));
        return redirect()->route('admin.conditions.show', $condition)->with('success', 'Condition updated.');
    }

    public function destroy(Condition $condition)
    {
        $condition->delete();
        return redirect()->route('admin.conditions.index')->with('success', 'Condition deleted.');
    }
}
