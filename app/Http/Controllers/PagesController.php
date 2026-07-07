<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\Faq;
use App\Models\Hospital;

class PagesController extends Controller
{
    public function howItWorks()    { return view('pages.how_it_works'); }
    public function about()         { return view('pages.about'); }
    public function whyIndia()      { return view('pages.why_india'); }
    public function accreditations()
    {
        $hospitals = Hospital::published()
            ->where(function ($q) {
                $q->where('is_jci_accredited', true)
                  ->orWhere('is_nabh_accredited', true);
            })
            ->limit(8)
            ->get();
        return view('pages.accreditations', compact('hospitals'));
    }
    public function travelGuide()   { return view('pages.travel_guide'); }
    public function privacyPolicy() { return view('pages.privacy_policy'); }
    public function terms()         { return view('pages.terms'); }
    public function forProviders()  { return view('pages.for_providers'); }
    public function services()      { return view('pages.services'); }

    public function faq()
    {
        $faq_groups = Faq::published()->ordered()->get()
            ->groupBy(fn ($faq) => $faq->category ?: 'General');
        return view('pages.faq', compact('faq_groups'));
    }

    public function cmsPage(string $slug)
    {
        $page = CmsPage::where('slug', $slug)->where('published', true)->firstOrFail();
        return view('pages.cms_page', compact('page'));
    }
}
