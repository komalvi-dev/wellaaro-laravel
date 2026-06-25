<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:Arial,sans-serif;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#198754;color:#fff;padding:20px;text-align:center}.content{padding:30px;border:1px solid #ddd}table{width:100%}td{padding:8px 0}td:first-child{font-weight:bold;width:40%}</style></head>
<body>
<div class="container">
    <div class="header"><h2>Appointment Confirmed ✓</h2></div>
    <div class="content">
        <p>Dear {{ $appointment->patientProfile?->first_name ?? 'Patient' }},</p>
        <p>Your appointment has been confirmed. Please find the details below:</p>
        <table>
            <tr><td>Reference</td><td>{{ $appointment->reference_number }}</td></tr>
            <tr><td>Date</td><td>{{ $appointment->appointment_date->format('l, d F Y') }}</td></tr>
            <tr><td>Time</td><td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td></tr>
            @if($appointment->doctor)<tr><td>Doctor</td><td>{{ $appointment->doctor->full_name }}</td></tr>@endif
            @if($appointment->hospital)<tr><td>Hospital</td><td>{{ $appointment->hospital->name }}</td></tr>@endif
            @if($appointment->meeting_link)<tr><td>Meeting Link</td><td><a href="{{ $appointment->meeting_link }}">Click to Join</a></td></tr>@endif
        </table>
        <p>Best regards,<br><strong>The MedTourism Team</strong></p>
    </div>
</div>
</body>
</html>
