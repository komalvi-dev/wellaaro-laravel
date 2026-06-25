<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscribersController extends Controller
{
    public function index()
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->paginate(50);
        return view('admin.newsletter_subscribers.index', compact('subscribers'));
    }

    public function show(NewsletterSubscriber $newsletterSubscriber)
    {
        return view('admin.newsletter_subscribers.show', ['subscriber' => $newsletterSubscriber]);
    }

    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        $newsletterSubscriber->delete();
        return redirect()->route('admin.newsletter-subscribers.index')->with('success', 'Subscriber removed.');
    }
}
