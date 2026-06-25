<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class DestinationsController extends Controller
{
    public function index()
    {
        $destinations = Destination::published()->ordered()->with('country')->get();
        return view('destinations.index', compact('destinations'));
    }

    public function show(string $slug)
    {
        $destination = Destination::where('slug', $slug)->where('published', true)->firstOrFail();
        $destination->load('country');
        $hospitals = $destination->country->hospitals()->published()->ordered()->limit(8)->get();
        $packages  = $destination->packages()->published()->ordered()->get();
        return view('destinations.show', compact('destination', 'hospitals', 'packages'));
    }
}
