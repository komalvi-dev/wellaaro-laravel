<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function inquiries(Request $request)
    {
        $from = $request->from ? \Carbon\Carbon::parse($request->from)->startOfDay() : now()->subDays(30)->startOfDay();
        $to   = $request->to   ? \Carbon\Carbon::parse($request->to)->endOfDay()   : now()->endOfDay();

        $inquiries = Inquiry::whereBetween('created_at', [$from, $to])
            ->with(['specialty', 'treatment', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->get();

        $byStatus = $inquiries->groupBy('status')->map->count();
        $bySource = $inquiries->groupBy('utm_source')->map->count();
        $byMonth  = $inquiries->groupBy(fn($i) => $i->created_at->format('Y-m'))->map->count();

        return view('admin.reports.inquiries', compact('inquiries', 'byStatus', 'bySource', 'byMonth', 'from', 'to'));
    }

    public function revenue(Request $request)
    {
        $from = $request->from ? \Carbon\Carbon::parse($request->from)->startOfDay() : now()->subDays(30)->startOfDay();
        $to   = $request->to   ? \Carbon\Carbon::parse($request->to)->endOfDay()   : now()->endOfDay();

        $payments = Payment::where('status', 'paid')
            ->whereBetween('paid_at', [$from, $to])
            ->with('inquiry')
            ->orderBy('paid_at', 'desc')
            ->get();

        $totalRevenue = $payments->sum('amount');

        return view('admin.reports.revenue', compact('payments', 'totalRevenue', 'from', 'to'));
    }

    public function conversions(Request $request)
    {
        $total     = Inquiry::count();
        $converted = Inquiry::where('status', 'closed_won')->count();
        $rate      = $total > 0 ? round(($converted / $total) * 100, 1) : 0;

        $bySpecialty = Inquiry::where('status', 'closed_won')
            ->with('specialty')
            ->get()
            ->groupBy(fn($i) => $i->specialty?->name ?? 'Other')
            ->map->count();

        return view('admin.reports.conversions', compact('total', 'converted', 'rate', 'bySpecialty'));
    }

    public function sources(Request $request)
    {
        $bySource = Inquiry::whereNotNull('utm_source')
            ->selectRaw('utm_source, COUNT(*) as count')
            ->groupBy('utm_source')
            ->orderByDesc('count')
            ->get();

        $byMedium = Inquiry::whereNotNull('utm_medium')
            ->selectRaw('utm_medium, COUNT(*) as count')
            ->groupBy('utm_medium')
            ->orderByDesc('count')
            ->get();

        return view('admin.reports.sources', compact('bySource', 'byMedium'));
    }
}
