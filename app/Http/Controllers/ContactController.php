<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.new');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::send(new ContactMail($validated));
        } catch (\Throwable $e) {
            \Log::error('Contact mail failed: ' . $e->getMessage(), $validated);
        }

        return redirect()->route('contact')
            ->with('success', 'Your message has been sent. We will be in touch shortly.');
    }
}
