@extends('layouts.patient')

@section('title', __('Patient | Service History'))

@section('content')
@php
    $doneCount = $items->filter(fn ($item) => strtolower((string) $item->status) === 'done')->count();
    $pendingCount = $items->filter(fn ($item) => in_array(strtolower((string) $item->status), ['pending', 'panding'], true))->count();
    $cancelledCount = $items->filter(fn ($item) => in_array(strtolower((string) $item->status), ['cencel', 'cancelled', 'canceled'], true))->count();
@endphp

<div class="patient-surface p-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h4 class="mb-1">{{ __('Service History') }}</h4>
            <p class="patient-muted mb-0">{{ __('Review completed, pending, and cancelled services linked to your appointments.') }}</p>
        </div>
        <a href="{{ route('patient.reports.index') }}" class="btn btn-outline-success">{{ __('Open Reports') }}</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Completed') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $doneCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Pending') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $pendingCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-stat p-3 h-100">
                <div class="patient-muted small text-uppercase">{{ __('Cancelled') }}</div>
                <div class="fs-3 fw-semibold mt-2">{{ $cancelledCount }}</div>
            </div>
        </div>
    </div>

    @if ($items->isNotEmpty())
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="serviceHistoryTable">
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
                    @foreach ($items as $item)
                        @php
                            $normalizedStatus = strtolower($item->status);
                            $statusClass = match ($normalizedStatus) {
                                'done' => 'text-bg-success',
                                'pending', 'panding' => 'text-bg-warning',
                                'cencel', 'cancelled', 'canceled' => 'text-bg-danger',
                                default => 'text-bg-secondary',
                            };
                            $statusLabel = match ($normalizedStatus) {
                                'done' => __('Completed'),
                                'pending', 'panding' => __('Pending'),
                                'cencel', 'cancelled', 'canceled' => __('Cancelled'),
                                default => __(\Illuminate\Support\Str::headline($normalizedStatus)),
                            };
                        @endphp
                        <tr>
                            <td>{{ $item->doctor?->name ?? __('N/A') }}</td>
                            <td>{{ $item->service?->title ?? __('N/A') }}</td>
                            <td>{{ $item->service_date?->format('d M Y') ?? $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->service_time ?: $item->created_at->format('h:i A') }}</td>
                            <td><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5 patient-muted">{{ __('No service history found yet.') }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const serviceHistoryTable = $('#serviceHistoryTable');

        if (!serviceHistoryTable.length) {
            return;
        }

        serviceHistoryTable.DataTable({
            order: [[2, 'desc']],
            pageLength: 10,
            language: {
                search: "{{ __('Search history:') }}",
                lengthMenu: "{{ __('Show _MENU_ items') }}",
                zeroRecords: "{{ __('No matching history found') }}"
            }
        });
    });
</script>
@endpush
