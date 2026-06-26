<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#6c757d;color:#fff;padding:15px 20px}.content{padding:25px;border:1px solid #ddd}.msg-body{background:#f0f0f0;padding:15px;border-radius:4px;margin:15px 0}.btn{display:inline-block;background:#0d6efd;color:#fff;padding:10px 20px;text-decoration:none;border-radius:4px;margin-top:10px}</style></head>
<body>
<div class="container">
    <div class="header"><h3>New Message in Your Inquiry Conversation</h3></div>
    <div class="content">
        <p>Hi {{ $recipient->full_name }},</p>
        <p>You have a new message from <strong>{{ $message->sender->full_name }}</strong>:</p>
        <div class="msg-body">{{ $message->body }}</div>
        <a href="{{ route('inquiries.show', $message->conversation->inquiry) }}" class="btn">View Conversation</a>
        <p style="margin-top:20px;">Best regards,<br><strong>The {{ config('app.name') }} Team</strong></p>
    </div>
</div>
</body>
</html>
