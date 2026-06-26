<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#0d6efd;color:#fff;padding:20px;text-align:center}.content{padding:30px;border:1px solid #ddd}.btn{display:inline-block;background:#0d6efd;color:#fff;padding:12px 24px;text-decoration:none;border-radius:4px;margin:15px 0}</style></head>
<body>
<div class="container">
    <div class="header"><h2>Confirm Your Subscription</h2></div>
    <div class="content">
        <p>Hi {{ $subscriber->first_name ?? $subscriber->email }},</p>
        <p>Please confirm your email address to complete your newsletter subscription.</p>
        <a href="{{ route('newsletter.confirm', ['token' => $subscriber->confirmation_token]) }}" class="btn">Confirm Subscription</a>
        <p>If you did not subscribe, you can safely ignore this email.</p>
        <p>Best regards,<br><strong>The Wellaaro Team</strong></p>
    </div>
</div>
</body>
</html>
