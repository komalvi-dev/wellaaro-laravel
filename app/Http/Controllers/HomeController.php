<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Package;
use App\Models\Specialty;
use App\Models\Testimonial;
use App\Models\Treatment;
use App\Models\Country;

class HomeController extends Controller
{
    public function index()
    {
        $hospitals    = Hospital::published()->featured()->ordered()->with('city', 'country')->limit(6)->get();
        $specialties  = Specialty::published()->featured()->ordered()->limit(8)->get();
        $testimonials = Testimonial::published()->featured()->ordered()->limit(6)->get();
        $doctors      = Doctor::published()->featured()->ordered()->with('specialties', 'hospital')->limit(6)->get();
        $packages     = Package::published()->featured()->ordered()->limit(3)->get();
        $blogPosts    = BlogPost::published()->orderByDesc('published_at')->limit(3)->get();

        $stats = [
            'hospitals'       => Hospital::published()->count(),
            'doctors'         => Doctor::published()->count(),
            'treatments'      => Treatment::published()->count(),
            'countries_served'=> Country::where('is_source', true)->count(),
        ];

        return view('home.index', compact(
            'hospitals', 'specialties',
            'testimonials', 'doctors', 'packages', 'blogPosts', 'stats'
        ));
    }
}
