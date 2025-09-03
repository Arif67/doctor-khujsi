@extends('layouts.patient')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="mb-0">Services History</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Doctor</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>12/12/2024</td>
                        <td>12:00 – 01:00 PM</td>
                        <td><span class="badge bg-success">Done</span></td>
                    </tr>
                    <tr>
                        <td>Dr. Mahmud Hasan</td>
                        <td>Physiotherapy</td>
                        <td>15/12/2024</td>
                        <td>03:00 – 04:00 PM</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Dr. Afsana Rahman</td>
                        <td>General Checkup</td>
                        <td>20/12/2024</td>
                        <td>10:00 – 11:00 AM</td>
                        <td><span class="badge bg-danger">Cancelled</span></td>
                    </tr>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>22/12/2024</td>
                        <td>02:00 – 03:00 PM</td>
                        <td><span class="badge bg-success">Done</span></td>
                    </tr>
                    <tr>
                        <td>Dr. Lisa White</td>
                        <td>Dental Cleaning</td>
                        <td>25/12/2024</td>
                        <td>11:00 – 12:00 PM</td>
                        <td><span class="badge bg-success">Done</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection