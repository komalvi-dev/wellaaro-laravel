<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialty;
use App\Models\Treatment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q', '');

        if (strlen($q) < 2) {
            return view('search.index', [
                'q' => $q, 'hospitals' => collect(), 'doctors' => collect(),
                'treatments' => collect(), 'specialties' => collect(),
            ]);
        }

        $like = "%{$q}%";

        $hospitals   = Hospital::published()->where('name', 'like', $like)->limit(5)->get();
        $doctors     = Doctor::published()
            ->where(fn($sub) => $sub->where('first_name', 'like', $like)
                ->orWhere('last_name', 'like', $like)
                ->orWhere('designation', 'like', $like))
            ->limit(5)->get();
        $treatments  = Treatment::published()->where('name', 'like', $like)->limit(5)->get();
        $specialties = Specialty::published()->where('name', 'like', $like)->limit(5)->get();

        return view('search.index', compact('q', 'hospitals', 'doctors', 'treatments', 'specialties'));
    }
}
