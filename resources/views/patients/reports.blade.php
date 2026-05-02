@extends('layouts.patient')

@section('title', __('Patient | Reports'))

@section('content')
@php
    $totalStorage = $reports->sum('file_size');
    $pdfCount = $reports->filter(fn ($report) => str_contains(strtolower((string) $report->mime_type), 'pdf'))->count();
    $imageCount = $reports->count() - $pdfCount;
    $storageLabel = $totalStorage >= 1048576
        ? number_format($totalStorage / 1048576, 2) . ' MB'
        : number_format($totalStorage / 1024, 0) . ' KB';
@endphp

<div class="row g-4">
    <div class="col-12 col-xl-4">
        <div class="patient-surface p-4">
            <h4 class="mb-1">{{ __('Upload Report') }}</h4>
            <p class="patient-muted mb-4">{{ __('Attach lab reports, prescriptions, or follow-up files to your patient profile.') }}</p>

            <form action="{{ route('patient.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Report Title') }}</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="{{ __('CBC Report, X-Ray, Prescription') }}" required>
                </div>

                <div class="mb-3">
                    <label for="report_type" class="form-label">{{ __('Report Type') }}</label>
                    <input type="text" id="report_type" name="report_type" class="form-control" value="{{ old('report_type') }}" placeholder="{{ __('Lab, Scan, Prescription') }}">
                </div>

                <div class="mb-3">
                    <label for="report_date" class="form-label">{{ __('Report Date') }}</label>
                    <input type="date" id="report_date" name="report_date" class="form-control" value="{{ old('report_date') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Notes') }}</label>
                    <textarea id="description" name="description" rows="4" class="form-control" placeholder="{{ __('Optional summary or context') }}">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="report_file" class="form-label">{{ __('File') }}</label>
                    <input type="file" id="report_file" name="report_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.webp" required>
                    <div class="form-text">{{ __('Accepted: PDF, JPG, PNG, WEBP up to 10MB.') }}</div>
                </div>

                <button type="submit" class="btn btn-success w-100">{{ __('Upload Report') }}</button>
            </form>
        </div>
    </div>

    <div class="col-12 col-xl-8">
        <div class="patient-surface p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h4 class="mb-1">{{ __('Medical Reports') }}</h4>
                    <p class="patient-muted mb-0">{{ __('Every uploaded report stays linked to this patient account.') }}</p>
                </div>
                <span class="badge text-bg-light border">{{ __(':count files', ['count' => $reports->count()]) }}</span>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="panel-stat p-3 h-100">
                        <div class="patient-muted small text-uppercase">{{ __('Total Files') }}</div>
                        <div class="fs-3 fw-semibold mt-2">{{ $reports->count() }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel-stat p-3 h-100">
                        <div class="patient-muted small text-uppercase">{{ __('PDF / Image') }}</div>
                        <div class="fw-semibold mt-2">{{ $pdfCount }} / {{ $imageCount }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel-stat p-3 h-100">
                        <div class="patient-muted small text-uppercase">{{ __('Storage Used') }}</div>
                        <div class="fw-semibold mt-2">{{ $reports->isNotEmpty() ? $storageLabel : '0 KB' }}</div>
                    </div>
                </div>
            </div>

            @if ($reports->isNotEmpty())
                <div class="table-responsive">
                    <table class="table align-middle mb-0" id="reportsTable">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('File') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                @php
                                    $fileSize = $report->file_size
                                        ? ($report->file_size >= 1048576
                                            ? number_format($report->file_size / 1048576, 2) . ' MB'
                                            : number_format($report->file_size / 1024, 0) . ' KB')
                                        : 'N/A';
                                @endphp
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $report->title }}</div>
                                        @if ($report->description)
                                            <div class="patient-muted small">{{ $report->description }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $report->report_type ?: __('General report') }}</td>
                                    <td>{{ $report->report_date?->format('d M Y') ?: __('N/A') }}</td>
                                    <td>
                                        <a href="{{ $report->file_url }}" target="_blank" class="text-decoration-none">
                                            {{ $report->file_name }}
                                        </a>
                                        <div class="patient-muted small">{{ $fileSize }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ $report->file_url }}" target="_blank" class="btn btn-sm btn-outline-secondary">{{ __('Open') }}</a>
                                            <a href="{{ route('patient.reports.download', $report) }}" class="btn btn-sm btn-outline-success">{{ __('Download') }}</a>
                                            <form action="{{ route('patient.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('{{ __('Delete this report?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 patient-muted">{{ __('No reports uploaded yet.') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const reportsTable = $('#reportsTable');

        if (!reportsTable.length) {
            return;
        }

        reportsTable.DataTable({
            order: [[2, 'desc']],
            pageLength: 10,
            language: {
                search: "{{ __('Search reports:') }}",
                lengthMenu: "{{ __('Show _MENU_ files') }}",
                zeroRecords: "{{ __('No matching reports found') }}"
            }
        });
    });
</script>
@endpush
