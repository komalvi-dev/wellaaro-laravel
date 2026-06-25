<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isPatient()) {
            return redirect()->route('home')->with('error', 'Access restricted to patients.');
        }

        return $next($request);
    }
}
