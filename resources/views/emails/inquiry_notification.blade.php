<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #198754; color: #fff; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 30px; border: 1px solid #ddd; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        td { padding: 8px 12px; border-bottom: 1px solid #eee; }
        td:first-child { font-weight: bold; width: 40%; background: #fff; }
        .btn { display: inline-block; background: #0d6efd; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>New Inquiry Received</h2>
        <p>Reference: {{ $inquiry->reference_number }}</p>
    </div>
    <div class="content">
        <p>A new inquiry has been submitted. Details below:</p>

        <table>
            <tr><td>Reference</td><td>{{ $inquiry->reference_number }}</td></tr>
            <tr><td>Patient Name</td><td>{{ $inquiry->patient_name }}</td></tr>
            <tr><td>Email</td><td>{{ $inquiry->email }}</td></tr>
            <tr><td>Phone</td><td>{{ $inquiry->phone_country_code }} {{ $inquiry->phone }}</td></tr>
            <tr><td>Country</td><td>{{ $inquiry->country_of_residence }}</td></tr>
            <tr><td>Treatment</td><td>{{ $inquiry->treatment_name }}</td></tr>
            <tr><td>Timeline</td><td>{{ $inquiry->preferred_timeline }}</td></tr>
            <tr><td>Budget</td><td>{{ $inquiry->budget_range }} {{ $inquiry->budget_currency }}</td></tr>
            <tr><td>Priority</td><td>{{ ucfirst($inquiry->priority) }}</td></tr>
            <tr><td>Source</td><td>{{ $inquiry->utm_source ?? 'Direct' }}</td></tr>
        </table>

        @if($inquiry->condition_description)
        <p><strong>Condition Description:</strong><br>{{ $inquiry->condition_description }}</p>
        @endif

        <a href="{{ url('/admin/inquiries/' . $inquiry->id) }}" class="btn">View Inquiry in Admin</a>
    </div>
</div>
</body>
</html>
