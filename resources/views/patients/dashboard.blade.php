
@extends('layouts.patient')
@section('title','Patient | Dashboard')
@section('content')
<div class="container py-4">

    <!-- Dashboard Summary -->
    <div class="row g-4 mb-4">
        <!-- Total Appointments -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary text-white rounded-circle p-3 me-3">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Appointments</h6>
                        <h4 class="mb-0">24</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Favorite Doctors -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success text-white rounded-circle p-3 me-3">
                        <i class="bi bi-heart fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Favorite Doctors</h6>
                        <h4 class="mb-0">8</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services History -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning text-white rounded-circle p-3 me-3">
                        <i class="bi bi-journal-medical fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Services History</h6>
                        <h4 class="mb-0">15</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services History Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-0">Recent Services History</h5>
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

</div>
@endsection
