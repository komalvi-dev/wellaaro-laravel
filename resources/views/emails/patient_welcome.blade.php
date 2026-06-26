<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#0d6efd;color:#fff;padding:20px;text-align:center}.content{padding:30px;border:1px solid #ddd}.btn{display:inline-block;background:#0d6efd;color:#fff;padding:12px 24px;text-decoration:none;border-radius:4px;margin:15px 0}.ref-box{background:#fff;border:2px solid #0d6efd;padding:15px;text-align:center;margin:20px 0;border-radius:4px}.ref-box strong{font-size:20px;color:#0d6efd}</style></head>
<body>
<div class="container">
    <div class="header"><h2>Welcome to Wellaaro!</h2></div>
    <div class="content">
        <p>Dear {{ $user->full_name }},</p>
        <p>Welcome! Your account has been created so you can track everything related to your inquiry.</p>

        @if($inquiry)
        <div class="ref-box">
            <p>Your Inquiry Reference</p>
            <strong>{{ $inquiry->reference_number }}</strong>
        </div>

        @if($inquiry->treatment_name)
        <p><strong>Treatment requested:</strong> {{ $inquiry->treatment_name }}</p>
        @endif

        @if($inquiry->preferred_destination)
        <p><strong>Preferred destination:</strong> {{ $inquiry->preferred_destination }}</p>
        @endif

        @if($inquiry->preferred_timeline)
        <p><strong>Preferred timeline:</strong> {{ str_replace('_', ' ', $inquiry->preferred_timeline) }}</p>
        @endif
        @endif

        <p>You can now access your personal patient dashboard to:</p>
        <ul>
            <li>Track this inquiry and any quotations we send you</li>
            <li>View your appointments</li>
            <li>Upload medical records</li>
            <li>Communicate with your case manager</li>
        </ul>
        <p><strong>First, set a password for your account</strong> — this link is valid for 48 hours:</p>
        <a href="{{ $resetUrl }}" class="btn">Set Your Password</a>
        <p style="margin-top:20px;">Once you have set your password you can access your patient dashboard:</p>
        <a href="{{ route('patient.dashboard') }}" class="btn" style="background:#6c757d;">Go to My Dashboard</a>
        <p>Best regards,<br><strong>The Wellaaro Team</strong></p>
    </div>
</div>
</body>
</html>
