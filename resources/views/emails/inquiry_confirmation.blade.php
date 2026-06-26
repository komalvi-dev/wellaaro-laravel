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
        .ref-box { background: #fff; border: 2px solid #0d6efd; padding: 15px; text-align: center; margin: 20px 0; border-radius: 4px; }
        .ref-box strong { font-size: 20px; color: #0d6efd; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>We Received Your Inquiry</h2>
    </div>
    <div class="content">
        <p>Dear {{ $inquiry->first_name ?? 'Patient' }},</p>
        <p>Thank you for reaching out to us. We have successfully received your medical inquiry and our team will review it promptly.</p>

        <div class="ref-box">
            <p>Your Reference Number</p>
            <strong>{{ $inquiry->reference_number }}</strong>
        </div>

        <p><strong>What happens next?</strong></p>
        <ul>
            <li>A dedicated case manager will review your inquiry within <strong>24 hours</strong>.</li>
            <li>We will contact you via email{{ $inquiry->whatsapp_opt_in ? ' and WhatsApp' : '' }} to discuss your needs.</li>
            <li>You will receive a personalised treatment quotation based on your requirements.</li>
        </ul>

        @if($inquiry->treatment_name)
        <p><strong>Treatment requested:</strong> {{ $inquiry->treatment_name }}</p>
        @endif

        <p>If you have any urgent questions, please reply to this email or contact us directly.</p>

        <p>Best regards,<br>
        <strong>The Wellaaro Team</strong></p>
    </div>
    <div class="footer">
        <p>You are receiving this email because you submitted an inquiry on Wellaaro. Please do not reply to this automated message.</p>
    </div>
</div>
</body>
</html>
