<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#0d6efd;color:#fff;padding:20px;text-align:center}.content{padding:30px;border:1px solid #ddd}.btn{display:inline-block;background:#0d6efd;color:#fff;padding:12px 24px;text-decoration:none;border-radius:4px;margin:15px 0}.footer{font-size:12px;color:#888;margin-top:20px;text-align:center}</style></head>
<body>
<div class="container">
    <div class="header"><h2>Welcome to {{ $siteName }}</h2></div>
    <div class="content">
        <p>Dear {{ $doctorName }},</p>
        <p>A doctor account has been created for you on <strong>{{ $siteName }}</strong> so you can manage your profile, appointments, and patient communications.</p>
        <p><strong>Set a password to activate your account</strong> — this link is valid for 48 hours:</p>
        <p><a href="{{ $resetUrl }}" class="btn">Set Your Password</a></p>
        <p>If you were not expecting this email, please contact us at <a href="mailto:{{ $supportEmail }}">{{ $supportEmail }}</a>.</p>
        <p>Best regards,<br><strong>The {{ $siteName }} Team</strong></p>
    </div>
    <div class="footer">If the button above does not work, copy and paste this URL into your browser:<br>{{ $resetUrl }}</div>
</div>
</body>
</html>
