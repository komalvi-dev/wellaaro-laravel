<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #6c757d; color: #fff; padding: 15px 20px; }
        .content { padding: 20px; border: 1px solid #ddd; background: #f9f9f9; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px 12px; border-bottom: 1px solid #eee; background: #fff; }
        td:first-child { font-weight: bold; width: 30%; background: #f0f0f0; }
        .message-body { background: #fff; padding: 15px; border: 1px solid #ddd; margin-top: 10px; white-space: pre-line; }
    </style>
</head>
<body>
<div class="container">
    <div class="header"><h3>New Contact Form Submission</h3></div>
    <div class="content">
        <table>
            <tr><td>Name</td><td>{{ $data['name'] ?? '' }}</td></tr>
            <tr><td>Email</td><td>{{ $data['email'] ?? '' }}</td></tr>
            <tr><td>Phone</td><td>{{ $data['phone'] ?? 'N/A' }}</td></tr>
            <tr><td>Subject</td><td>{{ $data['subject'] ?? '' }}</td></tr>
        </table>
        <p><strong>Message:</strong></p>
        <div class="message-body">{{ $data['message'] ?? '' }}</div>
    </div>
</div>
</body>
</html>
