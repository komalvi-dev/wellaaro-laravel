<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0d6efd; color: #fff; padding: 20px; text-align: center; border-radius: 4px 4px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border: 1px solid #ddd; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #888; }
        .status-box { background: #fff; border: 2px solid #0d6efd; padding: 15px; text-align: center; margin: 20px 0; border-radius: 4px; }
        .status-box strong { font-size: 20px; color: #0d6efd; }
        .ref { color: #666; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Inquiry Status Update</h2>
    </div>
    <div class="content">
        <p>Dear {{ $inquiry->first_name ?? 'Patient' }},</p>
        <p>We would like to inform you that the status of your inquiry has been updated.</p>

        <div class="status-box">
            <p class="ref">Reference: <strong>{{ $inquiry->reference_number }}</strong></p>
            <p>New Status</p>
            <strong>{{ ucfirst(str_replace('_', ' ', $inquiry->status)) }}</strong>
        </div>

        <p>If you have any questions about this update, please do not hesitate to contact your case manager or reply to this email.</p>

        <p>Best regards,<br>
        <strong>The Wellaaro Team</strong></p>
    </div>
    <div class="footer">
        <p>You are receiving this email because you have an active inquiry on Wellaaro. Please do not reply to this automated message.</p>
    </div>
</div>
</body>
</html>
