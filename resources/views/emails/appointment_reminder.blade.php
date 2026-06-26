<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #fd7e14; color: #fff; padding: 20px; text-align: center; border-radius: 4px 4px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #ddd; }
        .appt-box { background: #fff3cd; border: 1px solid #ffc107; padding: 20px; border-radius: 4px; margin: 20px 0; }
        table { width: 100%; }
        td { padding: 6px 0; }
        td:first-child { font-weight: bold; width: 40%; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Appointment Reminder</h2>
        <p>
            @if($type === '24h')
                Your appointment is tomorrow
            @elseif($type === '72h')
                Your appointment is in 3 days
            @else
                Your appointment is tomorrow
            @endif
        </p>
    </div>
    <div class="content">
        <p>Dear {{ $appointment->patientProfile?->first_name ?? 'Patient' }},</p>
        <p>This is a reminder about your upcoming appointment.</p>

        <div class="appt-box">
            <table>
                <tr><td>Reference</td><td>{{ $appointment->reference_number }}</td></tr>
                <tr><td>Date</td><td>{{ $appointment->appointment_date->format('l, d F Y') }}</td></tr>
                <tr><td>Time</td><td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }} ({{ $appointment->timezone }})</td></tr>
                <tr><td>Type</td><td>{{ ucfirst(str_replace('_', ' ', $appointment->appointment_type)) }}</td></tr>
                @if($appointment->doctor)
                <tr><td>Doctor</td><td>{{ $appointment->doctor->full_name }}</td></tr>
                @endif
                @if($appointment->hospital)
                <tr><td>Location</td><td>{{ $appointment->hospital->name }}</td></tr>
                @endif
                @if($appointment->meeting_link)
                <tr><td>Meeting Link</td><td><a href="{{ $appointment->meeting_link }}">Join Online</a></td></tr>
                @endif
            </table>
        </div>

        @if($appointment->meeting_notes)
        <p><strong>Notes:</strong> {{ $appointment->meeting_notes }}</p>
        @endif

        <p>You can view or manage your appointments at any time:<br>
        <a href="{{ $dashboard_url }}">{{ $dashboard_url }}</a></p>
        <p>If you have any questions, contact us at <a href="mailto:{{ $support_email }}">{{ $support_email }}</a>.</p>
        <p>Best regards,<br><strong>The {{ $site_name }} Team</strong></p>
    </div>
</div>
</body>
</html>
