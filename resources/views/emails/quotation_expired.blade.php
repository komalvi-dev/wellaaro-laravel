<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 650px; margin: 0 auto; padding: 20px; }
        .header { background: #6c757d; color: #fff; padding: 25px; text-align: center; border-radius: 4px 4px 0 0; }
        .content { padding: 30px; border: 1px solid #ddd; background: #fff; }
        .alert-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 12px 16px; margin: 15px 0; border-radius: 0 4px 4px 0; }
        .detail-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .detail-table td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        .detail-table td:first-child { font-weight: bold; width: 40%; }
        .btn { display: inline-block; background: #0d6efd; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Your Quotation Has Expired</h2>
        <p>Reference: {{ $quotation->reference_number }}</p>
    </div>
    <div class="content">
        <p>Dear {{ $quotation->inquiry->first_name ?? 'Patient' }},</p>
        <p>We wanted to let you know that quotation <strong>{{ $quotation->reference_number }}</strong> has now expired.</p>

        <div class="alert-box">
            This quotation was valid until <strong>{{ $quotation->valid_until->format('d M Y') }}</strong> and is no longer active.
        </div>

        <table class="detail-table">
            @if($quotation->hospital)
            <tr>
                <td>Hospital</td>
                <td>{{ $quotation->hospital->name }}</td>
            </tr>
            @endif
            @if($quotation->doctor)
            <tr>
                <td>Doctor</td>
                <td>{{ $quotation->doctor->full_name }}</td>
            </tr>
            @endif
            @if($quotation->treatment)
            <tr>
                <td>Treatment</td>
                <td>{{ $quotation->treatment->name }}</td>
            </tr>
            @endif
            <tr>
                <td>Quoted Cost</td>
                <td>{{ $quotation->currency }} {{ number_format($quotation->total_cost) }}</td>
            </tr>
            <tr>
                <td>Valid Until</td>
                <td>{{ $quotation->valid_until->format('d M Y') }}</td>
            </tr>
        </table>

        <p>If you are still interested in treatment, please contact us and we will be happy to provide a fresh quotation.</p>
        <a href="{{ url('/dashboard/quotations') }}" class="btn">View My Quotations</a>

        <p style="margin-top:20px;">Best regards,<br><strong>The Wellaaro Team</strong></p>
    </div>
    <div class="footer">
        <p>Prices in a new quotation may differ from this expired one.</p>
    </div>
</div>
</body>
</html>
