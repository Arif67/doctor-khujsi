
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
                        <h4 class="mb-0">{{ $count['appointments'] }}</h4>
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
                        <h4 class="mb-0">{{ $count['favorites'] }}</h4>
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
                        <h4 class="mb-0">{{ $count['serviceHistoryCount'] }}</h4>
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
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->doctor->name ?? 'N/A' }}</td>
                                <td>{{ $item->service->title ?? 'N/A' }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>{{ $item->created_at->format('h:i A') }} – {{ $item->created_at->addHour()->format('h:i A') }}</td>
                                <td>
                                    @php
                                        $statusClass = match($item->status) {
                                            'done'   => 'bg-success',
                                            'pending'=> 'bg-warning text-dark',
                                            'cencel' => 'bg-danger',
                                            default  => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>     
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
