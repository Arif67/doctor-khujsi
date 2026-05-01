@extends('layouts.patient')

@section('title', __('Patient | Medical Timeline'))

@section('content')
<div class="patient-surface p-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h4 class="mb-1">{{ __('Medical Timeline') }}</h4>
            <p class="patient-muted mb-0">{{ __('Review appointments, uploaded reports, and service updates in one chronological feed.') }}</p>
        </div>
        <div class="d-flex gap-2 timeline-actions">
            <button type="button" id="timelinePrint" class="btn btn-outline-secondary">{{ __('Print Timeline') }}</button>
            <a href="{{ route('patient.reports.index') }}" class="btn btn-outline-success">{{ __('Manage Reports') }}</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Total Events') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $timelineCounts['all'] }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Appointments') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $timelineCounts['appointments'] }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Reports') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $timelineCounts['reports'] }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Services') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $timelineCounts['services'] }}</div>
            </div>
        </div>
    </div>

    <div class="patient-surface border p-3 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="timelineTypeFilter" class="form-label">{{ __('Event Type') }}</label>
                <select id="timelineTypeFilter" class="form-select">
                    <option value="">{{ __('All event types') }}</option>
                    <option value="appointment">{{ __('Appointment') }}</option>
                    <option value="report">{{ __('Report') }}</option>
                    <option value="service">{{ __('Service') }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="timelineDateFrom" class="form-label">{{ __('From Date') }}</label>
                <input type="date" id="timelineDateFrom" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="timelineDateTo" class="form-label">{{ __('To Date') }}</label>
                <input type="date" id="timelineDateTo" class="form-control">
            </div>
            <div class="col-md-2 d-grid">
                <button type="button" id="timelineResetFilters" class="btn btn-outline-secondary">{{ __('Reset Filters') }}</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0" id="timelineTable">
            <thead class="table-light">
                <tr>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Event Type') }}</th>
                    <th>{{ __('Summary') }}</th>
                    <th>{{ __('Details') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($timelineItems as $item)
                    <tr data-type="{{ $item['type'] }}" data-date="{{ optional($item['date'])->format('Y-m-d') }}">
                        <td>
                            <div class="fw-semibold">{{ optional($item['date'])->format('d M Y') ?: __('N/A') }}</div>
                            <small class="patient-muted">{{ optional($item['date'])->format('h:i A') ?: '' }}</small>
                        </td>
                        <td>
                            @php
                                $typeClass = match ($item['type']) {
                                    'appointment' => 'text-bg-primary',
                                    'report' => 'text-bg-success',
                                    'service' => 'text-bg-warning',
                                    default => 'text-bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $typeClass }}">{{ __(\Illuminate\Support\Str::headline($item['type'])) }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $item['title'] }}</div>
                            <div class="patient-muted small">{{ $item['subtitle'] }}</div>
                        </td>
                        <td>
                            <div class="d-grid gap-1">
                                @foreach ($item['meta'] as $label => $value)
                                    @php
                                        $statusValue = strtolower((string) $value);
                                        $isStatus = $label === __('Status');
                                        $statusBadgeClass = match ($statusValue) {
                                            'confirm', 'confirmed', 'done' => 'text-bg-success',
                                            'pending', 'panding' => 'text-bg-warning',
                                            'cancelled', 'canceled', 'cencel' => 'text-bg-danger',
                                            default => 'text-bg-secondary',
                                        };
                                        $statusLabel = match ($statusValue) {
                                            'confirm' => __('Confirmed'),
                                            'panding' => __('Pending'),
                                            'cencel' => __('Cancelled'),
                                            default => is_string($value) ? ucfirst($value) : $value,
                                        };
                                    @endphp
                                    <div class="small">
                                        <span class="patient-muted">{{ $label }}:</span>
                                        @if ($isStatus)
                                            <span class="badge {{ $statusBadgeClass }}">{{ $statusLabel }}</span>
                                        @else
                                            <span>{{ $value }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 patient-muted">{{ __('No medical timeline events found yet.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const tableElement = $('#timelineTable');
        const typeFilter = $('#timelineTypeFilter');
        const dateFromFilter = $('#timelineDateFrom');
        const dateToFilter = $('#timelineDateTo');
        const resetButton = $('#timelineResetFilters');

        $.fn.dataTable.ext.search.push(function (settings, _, rowIndex) {
            if (settings.nTable !== tableElement.get(0)) {
                return true;
            }

            const rowNode = settings.aoData[rowIndex]?.nTr;

            if (!rowNode) {
                return true;
            }

            const selectedType = typeFilter.val();
            const fromDate = dateFromFilter.val();
            const toDate = dateToFilter.val();
            const rowType = rowNode.getAttribute('data-type') || '';
            const rowDate = rowNode.getAttribute('data-date') || '';

            if (selectedType && rowType !== selectedType) {
                return false;
            }

            if (fromDate && rowDate && rowDate < fromDate) {
                return false;
            }

            if (toDate && rowDate && rowDate > toDate) {
                return false;
            }

            return true;
        });

        const table = tableElement.DataTable({
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                search: "{{ __('Search timeline:') }}",
                lengthMenu: "{{ __('Show _MENU_ items') }}",
                zeroRecords: "{{ __('No matching timeline events found') }}"
            }
        });

        typeFilter.on('change', function () {
            table.draw();
        });

        dateFromFilter.on('change', function () {
            table.draw();
        });

        dateToFilter.on('change', function () {
            table.draw();
        });

        resetButton.on('click', function () {
            typeFilter.val('');
            dateFromFilter.val('');
            dateToFilter.val('');
            table.search('').draw();
        });

        $('#timelinePrint').on('click', function () {
            window.print();
        });
    });
</script>
@endpush

@push('styles')
<style>
    @media print {
        .navbar,
        .sidebar,
        .sidebar-offcanvas,
        .timeline-actions,
        #timelineTable_filter,
        #timelineTable_length,
        #timelineTable_paginate,
        #timelineResetFilters,
        .dataTables_info,
        .dataTables_paginate,
        .dataTables_length,
        .dataTables_filter {
            display: none !important;
        }

        .content {
            margin: 0 !important;
            padding: 0 !important;
        }

        body {
            background: #fff !important;
        }

        .patient-surface,
        .panel-stat {
            box-shadow: none !important;
            border: 1px solid #d9e7e5 !important;
        }
    }
</style>
@endpush
