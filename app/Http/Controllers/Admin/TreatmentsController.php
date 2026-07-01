<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreatmentsController extends Controller
{
    public function index(Request $request)
    {
        $query = Treatment::with('specialty');

        if ($request->filled('specialty_id')) {
            $query->where('specialty_id', $request->specialty_id);
        }
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $treatments  = $query->orderBy('position')->paginate(25);
        $specialties = Specialty::published()->ordered()->get();

        return view('admin.treatments.index', compact('treatments', 'specialties'));
    }

    public function create()
    {
        $treatment   = new Treatment();
        $specialties = Specialty::published()->ordered()->get();
        $parents     = Treatment::published()->whereNull('parent_id')->orderBy('name')->get();

        return view('admin.treatments.create', compact('treatment', 'specialties', 'parents'));
    }

    public function store(Request $request)
    {
        $data = $this->validateTreatment($request);

        if ($request->hasFile('featured_image')) {
            $data['featured_image_url'] = Storage::disk('public')->url(
                $request->file('featured_image')->store('treatments/featured', 'public')
            );
        }

        $treatment = Treatment::create($data);

        return redirect()->route('admin.treatments.show', $treatment)
            ->with('success', 'Treatment created.');
    }

    public function show(Treatment $treatment)
    {
        $treatment->load(['specialty', 'parent', 'children', 'doctors', 'conditions']);

        return view('admin.treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment)
    {
        $specialties = Specialty::published()->ordered()->get();
        $parents     = Treatment::whereNull('parent_id')->where('id', '!=', $treatment->id)->orderBy('name')->get();

        return view('admin.treatments.edit', compact('treatment', 'specialties', 'parents'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $data = $this->validateTreatment($request);

        if ($request->hasFile('featured_image')) {
            $data['featured_image_url'] = Storage::disk('public')->url(
                $request->file('featured_image')->store('treatments/featured', 'public')
            );
        }

        $treatment->update($data);

        return redirect()->route('admin.treatments.show', $treatment)
            ->with('success', 'Treatment updated.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()->route('admin.treatments.index')
            ->with('success', 'Treatment deleted.');
    }

    private function validateTreatment(Request $request): array
    {
        return $request->validate([
            'name'               => 'required|string|max:255',
            'specialty_id'       => 'nullable|exists:specialties,id',
            'parent_id'          => 'nullable|exists:treatments,id',
            'short_description'  => 'nullable|string|max:500',
            'description'        => 'nullable|string',
            'procedure_details'  => 'nullable|string',
            'recovery_time'      => 'nullable|string|max:100',
            'hospital_stay'      => 'nullable|string|max:100',
            'success_rate'       => 'nullable|string|max:50',
            'cost_india_min'     => 'nullable|integer|min:0',
            'cost_india_max'     => 'nullable|integer|min:0',
            'cost_usa'           => 'nullable|integer|min:0',
            'cost_uk'            => 'nullable|integer|min:0',
            'cost_savings_percent'=> 'nullable|integer|min:0|max:100',
            'featured_image'     => 'nullable|file|image|max:2048',
            'featured_image_url' => 'nullable|url|max:500',
            'published'          => 'boolean',
            'featured'           => 'boolean',
            'position'           => 'nullable|integer',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string|max:500',
            'meta_keywords'      => 'nullable|string|max:500',
        ]);
    }
}
