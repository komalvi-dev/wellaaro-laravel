<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\Faq;

class PagesController extends Controller
{
    public function howItWorks()    { return view('pages.how_it_works'); }
    public function about()         { return view('pages.about'); }
    public function whyIndia()      { return view('pages.why_india'); }
    public function accreditations(){ return view('pages.accreditations'); }
    public function travelGuide()   { return view('pages.travel_guide'); }
    public function privacyPolicy() { return view('pages.privacy_policy'); }
    public function terms()         { return view('pages.terms'); }
    public function forProviders()  { return view('pages.for_providers'); }
    public function services()      { return view('pages.services'); }

    public function faq()
    {
        $faqs = Faq::published()->ordered()->get();
        return view('pages.faq', compact('faqs'));
    }

    public function cmsPage(string $slug)
    {
        $page = CmsPage::where('slug', $slug)->where('published', true)->firstOrFail();
        return view('pages.cms_page', compact('page'));
    }
}
