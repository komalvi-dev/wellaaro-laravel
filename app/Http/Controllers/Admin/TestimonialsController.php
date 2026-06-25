<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with(['hospital', 'doctor', 'specialty'])
            ->orderBy('position')
            ->paginate(25);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $testimonial = new Testimonial();
        $hospitals   = Hospital::published()->orderBy('name')->get();
        $doctors     = Doctor::published()->orderBy('first_name')->get();
        $specialties = Specialty::published()->ordered()->get();

        return view('admin.testimonials.create', compact('testimonial', 'hospitals', 'doctors', 'specialties'));
    }

    public function store(Request $request)
    {
        $data = $this->validateTestimonial($request);

        $testimonial = Testimonial::create($data);

        return redirect()->route('admin.testimonials.show', $testimonial)
            ->with('success', 'Testimonial created.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        $hospitals   = Hospital::published()->orderBy('name')->get();
        $doctors     = Doctor::published()->orderBy('first_name')->get();
        $specialties = Specialty::published()->ordered()->get();

        return view('admin.testimonials.edit', compact('testimonial', 'hospitals', 'doctors', 'specialties'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validateTestimonial($request));

        return redirect()->route('admin.testimonials.show', $testimonial)
            ->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted.');
    }

    private function validateTestimonial(Request $request): array
    {
        return $request->validate([
            'patient_name'         => 'required|string|max:255',
            'country'              => 'nullable|string|max:100',
            'treatment'            => 'nullable|string|max:255',
            'hospital_id'          => 'nullable|exists:hospitals,id',
            'doctor_id'            => 'nullable|exists:doctors,id',
            'specialty_id'         => 'nullable|exists:specialties,id',
            'rating'               => 'required|integer|min:1|max:5',
            'short_quote'          => 'required|string|max:500',
            'full_story'           => 'nullable|string',
            'photo_url'            => 'nullable|url|max:500',
            'video_url'            => 'nullable|url|max:500',
            'video_thumbnail_url'  => 'nullable|url|max:500',
            'is_featured'          => 'boolean',
            'is_video'             => 'boolean',
            'position'             => 'nullable|integer',
            'published'            => 'boolean',
        ]);
    }
}
