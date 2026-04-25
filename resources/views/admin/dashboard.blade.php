@extends('layouts.admin')

@section('content')
@php
    $panelTitle = $isHospitalOwner ? (auth()->user()?->hospital_name ?: 'Hospital Panel') : 'Admin Overview';
    $panelSubtitle = $isHospitalOwner
        ? 'Track doctors, review bookings, and handle daily hospital operations from one place.'
        : 'Track platform growth, pending hospitals, and operational activity.';
@endphp

<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="card-body p-4 p-lg-5" style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 100%);">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8 text-white">
                <div class="text-uppercase small fw-semibold opacity-75 mb-2">
                    {{ $isHospitalOwner ? 'Hospital Workspace' : 'Admin Workspace' }}
                </div>
                <h1 class="h3 mb-2">{{ $panelTitle }}</h1>
                <p class="mb-0 opacity-75">{{ $panelSubtitle }}</p>
            </div>
            <div class="col-lg-4">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.doctor-bookings.index') }}" class="btn btn-light text-primary fw-semibold">
                        {{ $isHospitalOwner ? 'Review Bookings' : 'Open Bookings' }}
                    </a>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-light">
                        {{ $isHospitalOwner ? 'Manage Doctors' : 'View Doctors' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small mb-2">{{ $isHospitalOwner ? 'My Doctors' : 'Doctors' }}</div>
                <div class="fs-2 fw-bold">{{ $stats['doctor_count'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small mb-2">Doctor Bookings</div>
                <div class="fs-2 fw-bold">{{ $stats['booking_count'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small mb-2">Pending Bookings</div>
                <div class="fs-2 fw-bold">{{ $stats['pending_booking_count'] }}</div>
            </div>
        </div>
    </div>
    @if (! $isHospitalOwner)
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">Pending Hospitals</div>
                    <div class="fs-2 fw-bold">{{ $stats['pending_hospital_count'] }}</div>
                </div>
            </div>
        </div>
    @endif
</div>

@if (! $isHospitalOwner)
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">Patients</div>
                    <div class="fs-3 fw-bold">{{ $stats['patient_count'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">Appointments</div>
                    <div class="fs-3 fw-bold">{{ $stats['appointment_count'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">Blogs</div>
                    <div class="fs-3 fw-bold">{{ $stats['blog_count'] }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0">{{ $isHospitalOwner ? 'My Booking Status' : 'Booking Status Overview' }}</h2>
                    <a href="{{ route('admin.doctor-bookings.index') }}" class="btn btn-sm btn-outline-secondary">Open Bookings</a>
                </div>
                @php
                    $totalStatuses = max(1, (int) $bookingStatusChart->sum());
                    $statusMeta = [
                        'pending' => ['label' => 'Pending', 'class' => 'bg-warning text-dark'],
                        'confirmed' => ['label' => 'Confirmed', 'class' => 'bg-success'],
                        'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-danger'],
                    ];
                @endphp
                <div class="d-flex flex-column gap-3">
                    @foreach ($statusMeta as $key => $meta)
                        @php
                            $count = (int) ($bookingStatusChart[$key] ?? 0);
                            $width = $count > 0 ? max(8, (int) round(($count / $totalStatuses) * 100)) : 0;
                        @endphp
                        <div>
                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $meta['label'] }}</span>
                                <span>{{ $count }}</span>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar {{ $meta['class'] }}" role="progressbar" style="width: {{ $width }}%" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="{{ $totalStatuses }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0">{{ $isHospitalOwner ? 'Booking Trend' : 'Monthly Booking Trend' }}</h2>
                    <span class="small text-muted">Last 6 months</span>
                </div>
                @php
                    $maxMonthly = max(1, (int) $monthlyBookingTrend->max('total'));
                @endphp
                <div class="d-flex flex-column gap-3">
                    @forelse ($monthlyBookingTrend as $item)
                        @php
                            $width = max(8, (int) round(($item->total / $maxMonthly) * 100));
                        @endphp
                        <div>
                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $item->month_label }}</span>
                                <span>{{ $item->total }}</span>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $width }}%" aria-valuenow="{{ $item->total }}" aria-valuemin="0" aria-valuemax="{{ $maxMonthly }}"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted small">No booking trend data available yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">{{ $isHospitalOwner ? 'Recent Bookings' : 'Recent Doctor Bookings' }}</h2>
            <a href="{{ route('admin.doctor-bookings.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Hospital</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentBookings as $booking)
                        <tr>
                            <td>{{ $booking->patient_name }} ({{ $booking->patient_age }})</td>
                            <td>{{ $booking->doctor?->name ?? 'Deleted doctor' }}</td>
                            <td>{{ $booking->doctor?->owner?->hospital_name ?? $booking->hospitalOwner?->hospital_name ?? '-' }}</td>
                            <td>{{ $booking->patient_phone }}</td>
                            <td>
                                <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>{{ $booking->created_at?->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No doctor bookings yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
