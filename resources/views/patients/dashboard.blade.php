@extends('layouts.patient')

@section('title', __('Patient | Dashboard'))

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="patient-surface p-4 p-lg-5">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                <div>
                    <span class="badge text-bg-light border mb-3">{{ __('Patient Panel') }}</span>
                    <h2 class="mb-2">{{ __('Welcome back, :name', ['name' => $globalUser->first_name ?: $globalUser->name]) }}</h2>
                    <p class="patient-muted mb-0">{{ __('Your profile, reports, appointments, and service updates are available in one place.') }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('patient.profile') }}" class="btn btn-outline-secondary">{{ __('Update Profile') }}</a>
                    <a href="{{ route('patient.prescriptions.index') }}" class="btn btn-outline-secondary">{{ __('Prescriptions') }}</a>
                    <a href="{{ route('patient.timeline') }}" class="btn btn-outline-secondary">{{ __('Medical Timeline') }}</a>
                    <a href="{{ route('patient.reports.index') }}" class="btn btn-success">{{ __('Manage Reports') }}</a>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-white">
                        <div class="patient-muted small text-uppercase mb-2">{{ __('Profile Completion') }}</div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <div class="fw-semibold fs-4">{{ $count['profileCompletion'] }}%</div>
                            <a href="{{ route('patient.profile') }}" class="btn btn-sm btn-outline-secondary">{{ __('Complete') }}</a>
                        </div>
                        <div class="progress mt-3" role="progressbar" aria-valuenow="{{ $count['profileCompletion'] }}" aria-valuemin="0" aria-valuemax="100" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: {{ $count['profileCompletion'] }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-white">
                        <div class="patient-muted small text-uppercase mb-2">{{ __('Upcoming Appointments') }}</div>
                        <div class="fw-semibold fs-4">{{ $count['upcomingAppointments'] }}</div>
                        <div class="patient-muted small mt-2">{{ __('Booked schedules from today onward.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-white">
                        <div class="patient-muted small text-uppercase mb-2">{{ __('Service Progress') }}</div>
                        <div class="fw-semibold">{{ __(':done done / :pending pending', ['done' => $count['completedServices'], 'pending' => $count['pendingServices']]) }}</div>
                        <div class="patient-muted small mt-2">{{ __('Based on your latest assigned services.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="panel-stat p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="patient-muted small text-uppercase">{{ __('Appointments') }}</div>
                    <div class="display-6 fw-semibold mt-2">{{ $count['appointments'] }}</div>
                </div>
                <div class="bg-primary-subtle text-primary rounded-circle p-3">
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="panel-stat p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="patient-muted small text-uppercase">{{ __('Medical Reports') }}</div>
                    <div class="display-6 fw-semibold mt-2">{{ $count['reports'] }}</div>
                </div>
                <div class="bg-success-subtle text-success rounded-circle p-3">
                    <i class="fas fa-file-medical fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="panel-stat p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="patient-muted small text-uppercase">{{ __('Favorite Doctors') }}</div>
                    <div class="display-6 fw-semibold mt-2">{{ $count['favorites'] }}</div>
                </div>
                <div class="bg-danger-subtle text-danger rounded-circle p-3">
                    <i class="fas fa-heart fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="panel-stat p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="patient-muted small text-uppercase">{{ __('Service History') }}</div>
                    <div class="display-6 fw-semibold mt-2">{{ $count['serviceHistoryCount'] }}</div>
                </div>
                <div class="bg-warning-subtle text-warning rounded-circle p-3">
                    <i class="bi bi-journal-medical fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="panel-stat p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="patient-muted small text-uppercase">{{ __('Prescriptions') }}</div>
                    <div class="display-6 fw-semibold mt-2">{{ $count['prescriptions'] }}</div>
                </div>
                <div class="bg-info-subtle text-info rounded-circle p-3">
                    <i class="bi bi-prescription2 fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-7">
        <div class="patient-surface p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">{{ __('Recent Appointments') }}</h5>
                    <p class="patient-muted mb-0">{{ __('Assigned departments, schedules, and current status.') }}</p>
                </div>
                <a href="{{ route('patient.appointments') }}" class="btn btn-sm btn-outline-secondary">{{ __('See all') }}</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Schedule') }}</th>
                            <th>{{ __('Assigned Service') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                            @php
                                $statusClass = $appointment->status === 'confirm' ? 'text-bg-success' : 'text-bg-warning';
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $appointment->appointment_id }}</td>
                                <td>{{ $appointment->department?->name ?? __('N/A') }}</td>
                                <td>
                                    <div>{{ \Illuminate\Support\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</div>
                                    <small class="patient-muted">{{ $appointment->appointment_time }}</small>
                                </td>
                                <td>
                                    {{ $appointment->serviceHistory->pluck('service.title')->filter()->join(', ') ?: __('Not assigned yet') }}
                                </td>
                                <td><span class="badge {{ $statusClass }}">{{ ucfirst($appointment->status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 patient-muted">{{ __('No appointments found yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-5">
        <div class="patient-surface p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">{{ __('Recent Reports') }}</h5>
                    <p class="patient-muted mb-0">{{ __('Quick access to uploaded files.') }}</p>
                </div>
                <a href="{{ route('patient.reports.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('Open reports') }}</a>
            </div>

            <div class="d-grid gap-3">
                @forelse ($recentReports as $report)
                    <div class="border rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="fw-semibold">{{ $report->title }}</div>
                                <div class="patient-muted small">
                                    {{ $report->report_type ?: __('General report') }}
                                    @if ($report->report_date)
                                        • {{ $report->report_date->format('d M Y') }}
                                    @endif
                                </div>
                                <div class="small mt-1">{{ $report->file_name }}</div>
                            </div>
                            <a href="{{ route('patient.reports.download', $report) }}" class="btn btn-sm btn-outline-success">{{ __('Download') }}</a>
                        </div>
                    </div>
                @empty
                    <div class="border rounded-4 p-4 text-center patient-muted">
                        {{ __('No reports uploaded yet.') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-5">
        <div class="patient-surface p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">{{ __('Recent Prescriptions') }}</h5>
                    <p class="patient-muted mb-0">{{ __('Quick access to your uploaded prescriptions.') }}</p>
                </div>
                <a href="{{ route('patient.prescriptions.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('Open prescriptions') }}</a>
            </div>

            <div class="d-grid gap-3">
                @forelse ($recentPrescriptions as $prescription)
                    <div class="border rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="fw-semibold">{{ $prescription->title }}</div>
                                <div class="patient-muted small">
                                    {{ $prescription->doctor_name ?: __('Doctor not added') }}
                                    @if ($prescription->prescription_date)
                                        • {{ $prescription->prescription_date->format('d M Y') }}
                                    @endif
                                </div>
                                <div class="small mt-1">{{ $prescription->file_name }}</div>
                            </div>
                            <a href="{{ route('patient.prescriptions.download', $prescription) }}" class="btn btn-sm btn-outline-success">{{ __('Download') }}</a>
                        </div>
                    </div>
                @empty
                    <div class="border rounded-4 p-4 text-center patient-muted">
                        {{ __('No prescriptions uploaded yet.') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="patient-surface p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">{{ __('Recent Service History') }}</h5>
                    <p class="patient-muted mb-0">{{ __('Completed and pending services assigned to your appointments.') }}</p>
                </div>
                <a href="{{ route('patient.service.history') }}" class="btn btn-sm btn-outline-secondary">{{ __('See history') }}</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Doctor') }}</th>
                            <th>{{ __('Service') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Time') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentServices as $item)
                            @php
                                $normalizedStatus = strtolower($item->status);
                                $statusClass = match ($normalizedStatus) {
                                    'done' => 'text-bg-success',
                                    'pending', 'panding' => 'text-bg-warning',
                                    'cencel', 'cancelled', 'canceled' => 'text-bg-danger',
                                    default => 'text-bg-secondary',
                                };
                                $statusLabel = match ($normalizedStatus) {
                                    'panding' => 'Pending',
                                    'cencel' => 'Cancelled',
                                    default => ucfirst($normalizedStatus),
                                };
                            @endphp
                            <tr>
                                <td>{{ $item->doctor?->name ?? __('N/A') }}</td>
                                <td>{{ $item->service?->title ?? __('N/A') }}</td>
                                <td>{{ optional($item->service_date)->format('d M Y') ?? $item->created_at->format('d M Y') }}</td>
                                <td>{{ $item->service_time ?: $item->created_at->format('h:i A') }}</td>
                                <td><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 patient-muted">{{ __('No service history found yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
