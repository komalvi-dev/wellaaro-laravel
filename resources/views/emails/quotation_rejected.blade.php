<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 650px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: #fff; padding: 25px; text-align: center; border-radius: 4px 4px 0 0; }
        .content { padding: 30px; border: 1px solid #ddd; background: #fff; }
        .badge { display: inline-block; background: #f8d7da; color: #842029; padding: 6px 14px; border-radius: 20px; font-weight: bold; }
        .detail-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .detail-table td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        .detail-table td:first-child { font-weight: bold; width: 40%; }
        .note-box { background: #f8f9fa; border-left: 4px solid #dc3545; padding: 12px 16px; margin: 15px 0; border-radius: 0 4px 4px 0; }
        .btn { display: inline-block; background: #0d6efd; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Quotation Declined</h2>
        <p>Reference: {{ $quotation->reference_number }}</p>
    </div>
    <div class="content">
        <p>Hello,</p>
        <p>A patient has <span class="badge">declined</span> quotation <strong>{{ $quotation->reference_number }}</strong>.</p>

        <table class="detail-table">
            <tr>
                <td>Patient</td>
                <td>{{ $quotation->inquiry->first_name ?? '' }} {{ $quotation->inquiry->last_name ?? '' }}</td>
            </tr>
            <tr>
                <td>Patient Email</td>
                <td>{{ $quotation->inquiry->patient_email }}</td>
            </tr>
            @if($quotation->hospital)
            <tr>
                <td>Hospital</td>
                <td>{{ $quotation->hospital->name }}</td>
            </tr>
            @endif
            @if($quotation->treatment)
            <tr>
                <td>Treatment</td>
                <td>{{ $quotation->treatment->name }}</td>
            </tr>
            @endif
            <tr>
                <td>Total Cost</td>
                <td>{{ $quotation->currency }} {{ number_format($quotation->total_cost) }}</td>
            </tr>
            <tr>
                <td>Responded At</td>
                <td>{{ $quotation->responded_at?->format('d M Y, H:i') }}</td>
            </tr>
        </table>

        @if($quotation->patient_response_note)
        <div class="note-box">
            <strong>Patient reason:</strong><br>
            {{ $quotation->patient_response_note }}
        </div>
        @endif

        <p>You may wish to follow up with the patient or revise the quotation.</p>
        <a href="{{ url('/admin/quotations/' . $quotation->id) }}" class="btn">View Quotation</a>

        <p style="margin-top:20px;">Best regards,<br><strong>The Wellaaro System</strong></p>
    </div>
    <div class="footer">
        <p>This is an automated notification. Please do not reply to this email.</p>
    </div>
</div>
</body>
</html>
