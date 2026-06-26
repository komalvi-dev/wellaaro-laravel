<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #222; }
    .page { padding: 40px; }
    .header { display: flex; justify-content: space-between; border-bottom: 2px solid #0d6efd; padding-bottom: 16px; margin-bottom: 24px; }
    .brand { font-size: 20px; font-weight: 700; color: #0d6efd; }
    .brand small { display: block; font-size: 11px; font-weight: 400; color: #666; }
    .doc-title { text-align: right; }
    .doc-title h1 { font-size: 18px; color: #0d6efd; }
    .doc-title p { color: #666; font-size: 10px; }
    .section { margin-bottom: 20px; }
    .section h3 { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #0d6efd; border-bottom: 1px solid #e5e7eb; padding-bottom: 4px; margin-bottom: 10px; }
    .info-grid { display: flex; flex-wrap: wrap; gap: 8px 24px; }
    .info-item { min-width: 180px; }
    .info-item dt { font-size: 9px; text-transform: uppercase; color: #888; margin-bottom: 2px; }
    .info-item dd { font-weight: 600; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f0f2f5; text-align: left; padding: 7px 10px; font-size: 10px; text-transform: uppercase; }
    td { padding: 7px 10px; border-bottom: 1px solid #f0f2f5; }
    .text-right { text-align: right; }
    .total-row td { font-weight: 700; font-size: 13px; border-top: 2px solid #0d6efd; }
    .footer { margin-top: 32px; border-top: 1px solid #e5e7eb; padding-top: 12px; font-size: 9px; color: #888; text-align: center; }
    .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 9px; font-weight: 600; background: #e0f0ff; color: #0d6efd; }
    .notes-box { background: #f9f9f9; border-left: 3px solid #0d6efd; padding: 10px 14px; font-size: 10px; }
</style>
</head>
<body>
<div class="page">
    <div class="header">
        <div>
            <div class="brand">Wellaaro<small>Your Medical Journey, Simplified</small></div>
        </div>
        <div class="doc-title">
            <h1>Medical Treatment Quotation</h1>
            <p>Reference: {{ $inquiry->reference_number ?? '—' }}</p>
            <p>Date: {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <div class="section">
        <h3>Patient Information</h3>
        <div class="info-grid">
            <div class="info-item"><dt>Name</dt><dd>{{ $inquiry->patientProfile->user->name ?? '—' }}</dd></div>
            <div class="info-item"><dt>Nationality</dt><dd>{{ $inquiry->patientProfile->nationality ?? '—' }}</dd></div>
            <div class="info-item"><dt>Treatment</dt><dd>{{ $inquiry->treatment->name ?? '—' }}</dd></div>
            <div class="info-item"><dt>Specialty</dt><dd>{{ $inquiry->specialty->name ?? '—' }}</dd></div>
        </div>
    </div>

    <div class="section">
        <h3>Hospital &amp; Doctor</h3>
        <div class="info-grid">
            <div class="info-item"><dt>Hospital</dt><dd>{{ $quotation->hospital->name ?? '—' }}</dd></div>
            <div class="info-item"><dt>Location</dt><dd>{{ $quotation->hospital?->city?->name ?? '' }}</dd></div>
            <div class="info-item"><dt>Doctor</dt><dd>{{ $quotation->doctor?->full_name ?? 'To be assigned' }}</dd></div>
            <div class="info-item"><dt>Valid Until</dt><dd>{{ $quotation->valid_until ? $quotation->valid_until->format('d M Y') : '—' }}</dd></div>
        </div>
    </div>

    <div class="section">
        <h3>Cost Breakdown</h3>
        <table>
            <thead><tr><th>Description</th><th class="text-right">Amount ({{ $quotation->currency }})</th></tr></thead>
            <tbody>
                @foreach($quotation->line_items ?? [] as $item)
                <tr>
                    <td>{{ $item['description'] ?? '' }}</td>
                    <td class="text-right">{{ number_format($item['amount'] ?? 0, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td>Total Estimated Cost</td>
                    <td class="text-right">{{ $quotation->currency }} {{ number_format($quotation->total_cost, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($quotation->inclusions)
    <div class="section">
        <h3>Inclusions</h3>
        <div class="notes-box">{{ $quotation->inclusions }}</div>
    </div>
    @endif

    @if($quotation->exclusions)
    <div class="section">
        <h3>Exclusions</h3>
        <div class="notes-box">{{ $quotation->exclusions }}</div>
    </div>
    @endif

    @if($quotation->notes)
    <div class="section">
        <h3>Additional Notes</h3>
        <div class="notes-box">{{ $quotation->notes }}</div>
    </div>
    @endif

    <div class="footer">
        This quotation is valid until {{ $quotation->valid_until ? $quotation->valid_until->format('d M Y') : 'date stated above' }}.
        Prices are estimates and may vary. Contact us at omap-support@getaltadx.com for any queries.
        &copy; {{ date('Y') }} Wellaaro. All rights reserved.
    </div>
</div>
</body>
</html>
