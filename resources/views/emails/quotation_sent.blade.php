<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 650px; margin: 0 auto; padding: 20px; }
        .header { background: #0d6efd; color: #fff; padding: 25px; text-align: center; border-radius: 4px 4px 0 0; }
        .content { padding: 30px; border: 1px solid #ddd; background: #fff; }
        .cost-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .cost-table th { background: #f0f0f0; padding: 10px; text-align: left; }
        .cost-table td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        .cost-table .total { font-weight: bold; font-size: 18px; background: #e8f4fd; }
        .validity { background: #fff3cd; padding: 10px; border-radius: 4px; margin: 15px 0; }
        .btn { display: inline-block; background: #0d6efd; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Your Treatment Quotation</h2>
        <p>Reference: {{ $quotation->reference_number }}</p>
    </div>
    <div class="content">
        <p>Dear {{ $quotation->inquiry->first_name ?? 'Patient' }},</p>
        <p>Please find below your personalised treatment quotation. Review the details and let us know if you have any questions.</p>

        @if($quotation->hospital)
        <p><strong>Hospital:</strong> {{ $quotation->hospital->name }}</p>
        @endif
        @if($quotation->doctor)
        <p><strong>Doctor:</strong> {{ $quotation->doctor->full_name }}</p>
        @endif
        @if($quotation->treatment)
        <p><strong>Treatment:</strong> {{ $quotation->treatment->name }}</p>
        @endif
        @if($quotation->treatment_duration)
        <p><strong>Duration:</strong> {{ $quotation->treatment_duration }}</p>
        @endif

        <table class="cost-table">
            <thead>
                <tr><th>Cost Component</th><th style="text-align:right">Amount ({{ $quotation->currency }})</th></tr>
            </thead>
            <tbody>
                @if($quotation->treatment_cost > 0)
                <tr><td>Treatment Cost</td><td style="text-align:right">{{ number_format($quotation->treatment_cost) }}</td></tr>
                @endif
                @if($quotation->hospital_stay_cost > 0)
                <tr><td>Hospital Stay ({{ $quotation->hospital_stay_days }} days)</td><td style="text-align:right">{{ number_format($quotation->hospital_stay_cost) }}</td></tr>
                @endif
                @if($quotation->consultation_cost > 0)
                <tr><td>Consultation</td><td style="text-align:right">{{ number_format($quotation->consultation_cost) }}</td></tr>
                @endif
                @if($quotation->diagnostic_cost > 0)
                <tr><td>Diagnostics</td><td style="text-align:right">{{ number_format($quotation->diagnostic_cost) }}</td></tr>
                @endif
                @if($quotation->accommodation_cost > 0)
                <tr><td>Accommodation</td><td style="text-align:right">{{ number_format($quotation->accommodation_cost) }}</td></tr>
                @endif
                @if($quotation->discount_amount > 0)
                <tr><td>Discount</td><td style="text-align:right">- {{ number_format($quotation->discount_amount) }}</td></tr>
                @endif
                <tr class="total">
                    <td><strong>Total Estimated Cost</strong></td>
                    <td style="text-align:right"><strong>{{ $quotation->currency }} {{ number_format($quotation->total_cost) }}</strong></td>
                </tr>
            </tbody>
        </table>

        @if($quotation->valid_until)
        <div class="validity">
            ⚠️ This quotation is valid until <strong>{{ $quotation->valid_until->format('d M Y') }}</strong>.
        </div>
        @endif

        @if($quotation->inclusions)
        <p><strong>Inclusions:</strong><br>{{ $quotation->inclusions }}</p>
        @endif

        @if($quotation->notes)
        <p><strong>Notes:</strong><br>{{ $quotation->notes }}</p>
        @endif

        <p>To accept or reject this quotation, please log in to your patient dashboard.</p>
        <a href="{{ url('/dashboard/quotations') }}" class="btn">View Quotation in Dashboard</a>

        <p style="margin-top:20px;">Best regards,<br><strong>The MedTourism Team</strong></p>
    </div>
    <div class="footer">
        <p>All costs are estimates and subject to final medical assessment.</p>
    </div>
</div>
</body>
</html>
