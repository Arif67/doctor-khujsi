<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Bookings Report</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 24px; }
        h1 { margin-bottom: 8px; }
        p { margin-top: 0; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #d1d5db; padding: 10px; text-align: left; font-size: 13px; }
        th { background: #f3f4f6; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Print</button>
    </div>
    <h1>Doctor Bookings Report</h1>
    <p>Generated at {{ now()->format('d M Y, h:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Doctor</th>
                <th>Hospital</th>
                <th>Status</th>
                <th>Created</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->patient_name }}</td>
                    <td>{{ $booking->patient_phone }}</td>
                    <td>{{ $booking->patient_email ?: '-' }}</td>
                    <td>{{ $booking->doctor?->name ?? 'Deleted doctor' }}</td>
                    <td>{{ $booking->doctor?->owner?->hospital_name ?? $booking->hospitalOwner?->hospital_name ?? '-' }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>{{ $booking->created_at?->format('d M Y, h:i A') }}</td>
                    <td>{{ $booking->notes ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
