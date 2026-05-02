@extends('layouts.patient')

@section('title', __('Patient | Appointments'))

@section('content')
@php
    $confirmedCount = $appointments->filter(fn ($appointment) => strtolower((string) $appointment->status) === 'confirm')->count();
    $pendingCount = $appointments->filter(fn ($appointment) => strtolower((string) $appointment->status) !== 'confirm')->count();
    $upcomingCount = $appointments->filter(fn ($appointment) => $appointment->appointment_date && $appointment->appointment_date->gte(now()->startOfDay()))->count();
@endphp

<div class="patient-surface p-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h4 class="mb-1">{{ __('Appointments') }}</h4>
            <p class="patient-muted mb-0">{{ __('Track booked departments, scheduled times, and assigned services.') }}</p>
        </div>
        <a href="{{ route('app.booking') }}" class="btn btn-success">{{ __('Book New Appointment') }}</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Total') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $appointments->count() }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Confirmed') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $confirmedCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Upcoming') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $upcomingCount }}</div>
                <div class="patient-muted small mt-2">{{ __(':count still waiting for confirmation or assignment.', ['count' => $pendingCount]) }}</div>
            </div>
        </div>
    </div>

    @if ($appointments->isNotEmpty())
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="appointmentsTable">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('Appointment ID') }}</th>
                        <th>{{ __('Department') }}</th>
                        <th>{{ __('Schedule') }}</th>
                        <th>{{ __('Assigned Doctors') }}</th>
                        <th>{{ __('Services') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        @php
                            $normalizedStatus = strtolower((string) $appointment->status);
                            $statusClass = $normalizedStatus === 'confirm' ? 'text-bg-success' : 'text-bg-warning';
                            $statusLabel = match ($normalizedStatus) {
                                'confirm', 'confirmed' => __('Confirmed'),
                                'pending', 'panding' => __('Pending'),
                                'cancelled', 'canceled', 'cencel' => __('Cancelled'),
                                default => __(\Illuminate\Support\Str::headline($normalizedStatus)),
                            };
                        @endphp
                        <tr>
                            <td class="fw-semibold">{{ $appointment->appointment_id }}</td>
                            <td>{{ $appointment->department?->name ?? __('N/A') }}</td>
                            <td>
                                <div>{{ $appointment->appointment_date?->format('d M Y') ?? __('N/A') }}</div>
                                <small class="patient-muted">{{ $appointment->appointment_time }}</small>
                            </td>
                            <td>{{ $appointment->serviceHistory->pluck('doctor.name')->filter()->join(', ') ?: __('Not assigned yet') }}</td>
                            <td>{{ $appointment->serviceHistory->pluck('service.title')->filter()->join(', ') ?: __('Not assigned yet') }}</td>
                            <td><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5 patient-muted">{{ __('No appointments found yet.') }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const appointmentsTable = $('#appointmentsTable');

        if (!appointmentsTable.length) {
            return;
        }

        appointmentsTable.DataTable({
            order: [[2, 'desc']],
            pageLength: 10,
            language: {
                search: "{{ __('Search appointments:') }}",
                lengthMenu: "{{ __('Show _MENU_ items') }}",
                zeroRecords: "{{ __('No matching appointments found') }}"
            }
        });
    });
</script>
@endpush
