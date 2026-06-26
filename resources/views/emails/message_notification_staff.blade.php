<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#343a40;color:#fff;padding:15px 20px}.content{padding:25px;border:1px solid #ddd}.ref{font-size:13px;color:#6c757d;margin-bottom:8px}.msg-body{background:#f0f0f0;padding:15px;border-radius:4px;margin:15px 0}.btn{display:inline-block;background:#0d6efd;color:#fff;padding:10px 20px;text-decoration:none;border-radius:4px;margin-top:10px}</style></head>
<body>
<div class="container">
    <div class="header"><h3>New Patient Message</h3></div>
    <div class="content">
        <p class="ref">Inquiry: <strong>{{ $inquiry->reference_number }}</strong></p>
        <p>Hi {{ $recipient->full_name }},</p>
        <p>A new message has been posted by <strong>{{ $message->sender->full_name }}</strong> on inquiry <strong>{{ $inquiry->reference_number }}</strong>:</p>
        <div class="msg-body">{{ $message->body }}</div>
        <a href="{{ $action_url }}" class="btn">View Conversation</a>
        <p style="margin-top:20px;">Best regards,<br><strong>The Wellaaro Team</strong></p>
    </div>
</div>
</body>
</html>
