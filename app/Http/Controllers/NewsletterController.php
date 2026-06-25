<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterConfirmationMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            [
                'first_name'         => $request->first_name,
                'confirmation_token' => Str::random(40),
                'source'             => 'website',
            ]
        );

        if (!$subscriber->is_confirmed) {
            Mail::queue(new NewsletterConfirmationMail($subscriber));
        }

        return response()->json(['success' => true, 'message' => 'Please check your email to confirm your subscription.']);
    }

    public function confirm(string $token)
    {
        $subscriber = NewsletterSubscriber::where('confirmation_token', $token)->firstOrFail();
        $subscriber->update([
            'is_confirmed'  => true,
            'subscribed_at' => now(),
        ]);

        return redirect('/')->with('success', 'Your newsletter subscription has been confirmed. Thank you!');
    }

    public function unsubscribe(string $token)
    {
        $subscriber = NewsletterSubscriber::where('confirmation_token', $token)->firstOrFail();
        $subscriber->update(['unsubscribed_at' => now()]);

        return redirect('/')->with('info', 'You have been successfully unsubscribed from our newsletter.');
    }
}
