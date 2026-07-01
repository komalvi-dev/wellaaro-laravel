<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #333; }
    .header { background: #1a6bcc; color: #fff; padding: 10px 20px; }
    .header h1 { font-size: 16px; margin-bottom: 2px; }
    .header p { font-size: 11px; }
    .logo { font-size: 16px; font-weight: bold; margin-bottom: 4px; }
    .container { padding: 10px 20px; }
    .section { margin-bottom: 10px; }
    .section-title { font-size: 12px; font-weight: bold; color: #1a6bcc; border-bottom: 1px solid #1a6bcc; padding-bottom: 2px; margin-bottom: 6px; }
    .info-grid { display: flex; flex-wrap: wrap; gap: 4px 24px; }
    .info-grid > div { flex: 1; min-width: 220px; }
    .info-item { margin-bottom: 3px; }
    .info-label { font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 0.4px; }
    .info-value { font-weight: 600; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; margin-top: 4px; }
    th { background: #f0f4f8; padding: 5px 8px; text-align: left; font-size: 10px; color: #555; }
    td { padding: 4px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
    .amount { text-align: right; font-weight: 600; }
    .total-row td { font-weight: bold; font-size: 12px; background: #f8f9fa; }
    .discount-row td { color: #dc3545; }
    .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; }
    .badge-success { background: #d1fae5; color: #065f46; }
    .terms { background: #f8f9fa; border-radius: 4px; padding: 8px; font-size: 9px; color: #666; margin-top: 8px; }
    .footer { background: #1a6bcc; color: #fff; padding: 8px 20px; margin-top: 10px; font-size: 10px; text-align: center; }
</style>
</head>
<body>
@php
    $currencySymbols = ['USD' => '$', 'GBP' => '£', 'EUR' => '€', 'INR' => '₹'];
    $symbol = $currencySymbols[strtoupper($quotation->currency)] ?? $quotation->currency;
    $money = fn ($amount) => $symbol . number_format($amount ?? 0, 2);
@endphp
<div class="header">
    <div class="logo">Wellaaro</div>
    <h1>Treatment Quotation</h1>
    <p>Ref: {{ $quotation->reference_number }} &nbsp;|&nbsp; Version {{ $quotation->version }}</p>
</div>

<div class="container">
    <div class="info-grid" style="margin-bottom:25px;">
        <div>
            <div class="section-title" style="margin-top:0;">Patient Details</div>
            <div class="info-item">
                <div class="info-label">Name</div>
                <div class="info-value">{{ $inquiry->patient_name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $inquiry->patient_email }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Country</div>
                <div class="info-value">{{ $inquiry->country_of_residence ?: $inquiry->patientProfile?->country_of_residence ?: '—' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Inquiry Ref</div>
                <div class="info-value">{{ $inquiry->reference_number }}</div>
            </div>
        </div>

        <div>
            <div class="section-title" style="margin-top:0;">Quotation Details</div>
            <div class="info-item">
                <div class="info-label">Quote Date</div>
                <div class="info-value">{{ $quotation->created_at->format('F d, Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Valid Until</div>
                <div class="info-value">{{ $quotation->valid_until ? $quotation->valid_until->format('F d, Y') : '30 days' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value"><span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $quotation->status)) }}</span></div>
            </div>
        </div>
    </div>

    @if($quotation->notes)
    <div class="section">
        <div class="section-title">Additional Notes</div>
        <p style="color:#555;">{{ $quotation->notes }}</p>
    </div>
    @endif

    @if($quotation->hospital || $inquiry->treatment_name)
    <div class="section">
        <div class="section-title">Treatment Information</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Treatment</div>
                <div class="info-value">{{ $inquiry->treatment_name ?: $quotation->treatment?->name ?: '—' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Hospital</div>
                <div class="info-value">{{ $quotation->hospital->name ?? 'To be confirmed' }}</div>
            </div>
            @if($quotation->doctor)
            <div class="info-item">
                <div class="info-label">Specialist</div>
                <div class="info-value">{{ $quotation->doctor->full_name }}</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Cost Breakdown</div>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="amount">Amount ({{ $quotation->currency }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['Treatment / Procedure', $quotation->treatment_cost],
                    ['Hospital Stay', $quotation->hospital_stay_cost],
                    ['Consultation', $quotation->consultation_cost],
                    ['Diagnostics', $quotation->diagnostic_cost],
                    ['Medicines', $quotation->medicine_cost],
                    ['Accommodation', $quotation->accommodation_cost],
                    ['Travel', $quotation->travel_cost],
                    ['Visa Assistance', $quotation->visa_cost],
                    ['Other', $quotation->other_cost],
                ] as [$label, $amount])
                    @if($amount > 0)
                    <tr>
                        <td>{{ $label }}</td>
                        <td class="amount">{{ $money($amount) }}</td>
                    </tr>
                    @endif
                @endforeach
                @if($quotation->discount_amount > 0)
                <tr class="discount-row">
                    <td>Discount</td>
                    <td class="amount">&minus;{{ $money($quotation->discount_amount) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td>Total Estimated Cost</td>
                    <td class="amount">{{ $money($quotation->total_cost) }}</td>
                </tr>
            </tbody>
        </table>

        @if($quotation->deposit_percentage)
        <p style="margin-top:10px;font-size:12px;color:#666;">
            * Advance required: {{ $quotation->deposit_percentage }}%
            ({{ $money($quotation->total_cost * $quotation->deposit_percentage / 100) }})
            to confirm booking
        </p>
        @endif
    </div>

    <div class="terms">
        <strong>Terms &amp; Conditions</strong><br>
        1. This quotation is an estimate based on the available medical information and may change after the treating doctor&rsquo;s evaluation.<br>
        2. Hospital charges, treatment plans, and accommodation costs are subject to availability and final confirmation.<br>
        3. Travel, airfare, visa fees, insurance, personal expenses, and unforeseen medical expenses are not included unless specifically mentioned.<br>
        4. Advance payment is required to confirm the booking. The balance payment shall be payable as per the hospital&rsquo;s and Wellaaro&rsquo;s payment policy.<br>
        5. Cancellation and refund are subject to the respective hospital&rsquo;s policies and applicable service charges.<br>
        6. Wellaaro acts solely as a medical tourism facilitator and does not provide medical advice or guarantee treatment outcomes.<br>
        7. By accepting this quotation, the patient agrees to Wellaaro&rsquo;s complete Terms &amp; Conditions and Privacy Policy available on our website.
    </div>
</div>

<div class="footer">
    <p>For queries: {{ \App\Models\SiteSetting::get('contact_email', 'info@wellaaro.com') }} | {{ \App\Models\SiteSetting::get('phone', '+91 72111 36620') }}</p>
    <p style="margin-top:5px;">{{ \App\Models\SiteSetting::get('address', 'New Delhi, India') }}</p>
</div>
</body>
</html>
