<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    public function show(string $slug)
    {
        $condition = Condition::where('slug', $slug)
            ->where('published', true)
            ->with('treatments')
            ->firstOrFail();

        return view('conditions.show', compact('condition'));
    }
}
