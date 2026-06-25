<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#0d6efd;color:#fff;padding:20px;text-align:center}.content{padding:30px;border:1px solid #ddd}.btn{display:inline-block;background:#0d6efd;color:#fff;padding:12px 24px;text-decoration:none;border-radius:4px;margin:15px 0}</style></head>
<body>
<div class="container">
    <div class="header"><h2>Welcome to MedTourism!</h2></div>
    <div class="content">
        <p>Dear {{ $user->full_name }},</p>
        <p>Welcome! Your account has been created successfully.</p>
        <p>You can now access your personal patient dashboard to:</p>
        <ul>
            <li>Track your inquiries and quotations</li>
            <li>View your appointments</li>
            <li>Upload medical records</li>
            <li>Communicate with your case manager</li>
        </ul>
        <a href="{{ url('/dashboard') }}" class="btn">Go to My Dashboard</a>
        <p>Best regards,<br><strong>The MedTourism Team</strong></p>
    </div>
</div>
</body>
</html>
