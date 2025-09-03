@extends('layouts.patient')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body ">
            <h5 class="mb-0">Appointments</h5>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Doctor</th>
                            <th>Services</th>
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
                            <td>12:00–01:00 pm</td>
                            <td><span class="badge bg-success">Confirm</span></td>
                        </tr>
                        <tr>
                            <td>Dr. Jakir Ali</td>
                            <td>Cupping Therapy</td>
                            <td>12/12/2024</td>
                            <td>12:00–01:00 pm</td>
                            <td><span class="badge bg-secondary">Pending</span></td>
                        </tr>
                        <tr>
                            <td>Dr. Jakir Ali</td>
                            <td>Cupping Therapy</td>
                            <td>12/12/2024</td>
                            <td>12:00–01:00 pm</td>
                            <td><span class="badge bg-success">Confirm</span></td>
                        </tr>
                        <tr>
                            <td>Dr. Jakir Ali</td>
                            <td>Cupping Therapy</td>
                            <td>12/12/2024</td>
                            <td>12:00–01:00 pm</td>
                            <td><span class="badge bg-success">Confirm</span></td>
                        </tr>
                        <tr>
                            <td>Dr. Jakir Ali</td>
                            <td>Cupping Therapy</td>
                            <td>12/12/2024</td>
                            <td>12:00–01:00 pm</td>
                            <td><span class="badge bg-success">Confirm</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
