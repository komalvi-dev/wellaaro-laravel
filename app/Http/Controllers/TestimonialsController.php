<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::published()->ordered()->paginate(12)->withQueryString();
        return view('testimonials.index', compact('testimonials'));
    }

    public function show(int $id)
    {
        $testimonial = Testimonial::where('id', $id)->where('published', true)->firstOrFail();
        return view('testimonials.show', compact('testimonial'));
    }
}
