@extends('layouts.patient')

@section('title', __('Patient | Prescriptions'))

@section('content')
@php
    $totalStorage = $prescriptions->sum('file_size');
    $pdfCount = $prescriptions->filter(fn ($prescription) => str_contains(strtolower((string) $prescription->mime_type), 'pdf'))->count();
    $imageCount = $prescriptions->count() - $pdfCount;
    $storageLabel = $totalStorage >= 1048576
        ? number_format($totalStorage / 1048576, 2) . ' MB'
        : number_format($totalStorage / 1024, 0) . ' KB';
@endphp

<div class="row g-4">
    <div class="col-12 col-xl-4">
        <div class="patient-surface p-4">
            <h4 class="mb-1">{{ __('Upload Prescription') }}</h4>
            <p class="patient-muted mb-4">{{ __('Keep doctor prescriptions, medicine instructions, and follow-up files in one place.') }}</p>

            <form action="{{ route('patient.prescriptions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Prescription Title') }}</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="{{ __('Prescription for fever, Follow-up medicine plan') }}" required>
                </div>

                <div class="mb-3">
                    <label for="doctor_name" class="form-label">{{ __('Doctor Name') }}</label>
                    <input type="text" id="doctor_name" name="doctor_name" class="form-control" value="{{ old('doctor_name') }}" placeholder="{{ __('Dr. Ahmed, Dr. Sultana') }}">
                </div>

                <div class="mb-3">
                    <label for="prescription_date" class="form-label">{{ __('Prescription Date') }}</label>
                    <input type="date" id="prescription_date" name="prescription_date" class="form-control" value="{{ old('prescription_date') }}">
                </div>

                <div class="mb-3">
                    <label for="medicines" class="form-label">{{ __('Medicines') }}</label>
                    <textarea id="medicines" name="medicines" rows="3" class="form-control" placeholder="{{ __('List medicines or dosage summary') }}">{{ old('medicines') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">{{ __('Notes') }}</label>
                    <textarea id="notes" name="notes" rows="4" class="form-control" placeholder="{{ __('Optional follow-up notes or instructions') }}">{{ old('notes') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="prescription_file" class="form-label">{{ __('File') }}</label>
                    <input type="file" id="prescription_file" name="prescription_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.webp" required>
                    <div class="form-text">{{ __('Accepted: PDF, JPG, PNG, WEBP up to 10MB.') }}</div>
                </div>

                <button type="submit" class="btn btn-success w-100">{{ __('Upload Prescription') }}</button>
            </form>
        </div>
    </div>

    <div class="col-12 col-xl-8">
        <div class="patient-surface p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h4 class="mb-1">{{ __('Prescriptions') }}</h4>
                    <p class="patient-muted mb-0">{{ __('Every uploaded prescription stays linked to this patient account.') }}</p>
                </div>
                <div class="d-flex gap-2 prescription-actions">
                    <button type="button" id="printPrescriptions" class="btn btn-outline-secondary">{{ __('Print Prescriptions') }}</button>
                    <span class="badge text-bg-light border align-self-center">{{ __(':count files', ['count' => $prescriptions->count()]) }}</span>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="panel-stat p-3 h-100">
                        <div class="patient-muted small text-uppercase">{{ __('Total Files') }}</div>
                        <div class="fs-3 fw-semibold mt-2">{{ $prescriptions->count() }}</div>
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
                        <div class="fw-semibold mt-2">{{ $prescriptions->isNotEmpty() ? $storageLabel : '0 KB' }}</div>
                    </div>
                </div>
            </div>

            @if ($prescriptions->isNotEmpty())
                <div class="table-responsive">
                    <table class="table align-middle mb-0" id="prescriptionsTable">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Doctor') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('File') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prescriptions as $prescription)
                            @php
                                $fileSize = $prescription->file_size
                                    ? ($prescription->file_size >= 1048576
                                        ? number_format($prescription->file_size / 1048576, 2) . ' MB'
                                        : number_format($prescription->file_size / 1024, 0) . ' KB')
                                    : 'N/A';
                            @endphp
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $prescription->title }}</div>
                                        @if ($prescription->medicines)
                                            <div class="patient-muted small">{{ $prescription->medicines }}</div>
                                        @endif
                                        @if ($prescription->notes)
                                            <div class="small mt-1">{{ $prescription->notes }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $prescription->doctor_name ?: __('Doctor not added') }}</td>
                                    <td>{{ $prescription->prescription_date?->format('d M Y') ?: __('N/A') }}</td>
                                    <td>
                                        <a href="{{ $prescription->file_url }}" target="_blank" class="text-decoration-none">
                                            {{ $prescription->file_name }}
                                        </a>
                                        <div class="patient-muted small">{{ $fileSize }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-secondary preview-prescription"
                                                data-title="{{ $prescription->title }}"
                                                data-doctor="{{ $prescription->doctor_name ?: __('Doctor not added') }}"
                                                data-date="{{ $prescription->prescription_date?->format('d M Y') ?: __('N/A') }}"
                                                data-medicines="{{ $prescription->medicines }}"
                                                data-notes="{{ $prescription->notes }}"
                                                data-file-url="{{ $prescription->file_url }}"
                                                data-mime-type="{{ $prescription->mime_type }}"
                                            >
                                                {{ __('Preview') }}
                                            </button>
                                            <a href="{{ $prescription->file_url }}" target="_blank" class="btn btn-sm btn-outline-secondary">{{ __('Open') }}</a>
                                            <a href="{{ route('patient.prescriptions.download', $prescription) }}" class="btn btn-sm btn-outline-success">{{ __('Download') }}</a>
                                            <form action="{{ route('patient.prescriptions.destroy', $prescription) }}" method="POST" onsubmit="return confirm('{{ __('Delete this prescription?') }}');">
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
                <div class="text-center py-5 patient-muted">{{ __('No prescriptions uploaded yet.') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="prescriptionPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="previewTitle">{{ __('Prescription Preview') }}</h5>
                    <div class="patient-muted small" id="previewDoctorLine"></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                            <div class="mb-3">
                                <div class="small text-uppercase patient-muted">{{ __('Doctor Name') }}</div>
                                <div id="previewDoctor"></div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-uppercase patient-muted">{{ __('Prescription Date') }}</div>
                                <div id="previewDate"></div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-uppercase patient-muted">{{ __('Medicines') }}</div>
                                <div id="previewMedicines" class="small"></div>
                            </div>
                            <div>
                                <div class="small text-uppercase patient-muted">{{ __('Notes') }}</div>
                                <div id="previewNotes" class="small"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="border rounded-4 overflow-hidden bg-white">
                            <iframe id="previewFrame" class="w-100 d-none" style="height: 65vh;" title="{{ __('Prescription Preview') }}"></iframe>
                            <img id="previewImage" class="img-fluid w-100 d-none" alt="{{ __('Prescription Preview') }}">
                            <div id="previewFallback" class="p-5 text-center patient-muted d-none">
                                {{ __('Preview is not available for this file. Use open or download instead.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const previewModalElement = document.getElementById('prescriptionPreviewModal');
        const previewModal = new bootstrap.Modal(previewModalElement);
        const previewFrame = $('#previewFrame');
        const previewImage = $('#previewImage');
        const previewFallback = $('#previewFallback');

        const prescriptionsTable = $('#prescriptionsTable');

        if (prescriptionsTable.length) {
            prescriptionsTable.DataTable({
            order: [[2, 'desc']],
            pageLength: 10,
            language: {
                search: "{{ __('Search prescriptions:') }}",
                lengthMenu: "{{ __('Show _MENU_ files') }}",
                zeroRecords: "{{ __('No matching prescriptions found') }}"
            }
            });
        }

        $('.preview-prescription').on('click', function () {
            const button = $(this);
            const mimeType = (button.data('mime-type') || '').toLowerCase();
            const fileUrl = button.data('file-url');
            const medicines = button.data('medicines') || "{{ __('Not provided') }}";
            const notes = button.data('notes') || "{{ __('Not provided') }}";

            $('#previewTitle').text(button.data('title'));
            $('#previewDoctorLine').text(button.data('doctor') + ' • ' + button.data('date'));
            $('#previewDoctor').text(button.data('doctor'));
            $('#previewDate').text(button.data('date'));
            $('#previewMedicines').text(medicines);
            $('#previewNotes').text(notes);

            previewFrame.addClass('d-none').attr('src', '');
            previewImage.addClass('d-none').attr('src', '');
            previewFallback.addClass('d-none');

            if (mimeType.includes('pdf')) {
                previewFrame.removeClass('d-none').attr('src', fileUrl);
            } else if (mimeType.includes('image')) {
                previewImage.removeClass('d-none').attr('src', fileUrl);
            } else {
                previewFallback.removeClass('d-none');
            }

            previewModal.show();
        });

        $('#printPrescriptions').on('click', function () {
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
        .prescription-actions,
        #prescriptionsTable_filter,
        #prescriptionsTable_length,
        #prescriptionsTable_paginate,
        .dataTables_info,
        .dataTables_paginate,
        .dataTables_length,
        .dataTables_filter,
        .btn,
        .modal {
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
