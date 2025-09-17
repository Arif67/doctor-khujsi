@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
   <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">All Attention</h2>
        <a 
            href="{{ route('admin.attentions.create') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
            <i class="fas fa-plus"></i>
            Add New Attention
        </a>
    </div>
    <hr class="mb-5">

    <table id="attentions-table" class="min-w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">SL</th>
                <th class="px-4 py-2">Appointment Id</th>
                <th class="px-4 py-2">Department</th>
                <th class="px-4 py-2">Patient</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Time</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Created At</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Patient Details Bootstrap Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientModalLabel">Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="patientModalContent">
                <div class="d-flex justify-content-center align-items-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).on('click', '.show_patient', function(e) {
    e.preventDefault();

    var patientId = $(this).data('id');

    // Show spinner while loading
    $('#patientModalContent').html(
        '<div class="d-flex justify-content-center align-items-center py-5">' +
        '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>' +
        '</div>'
    );

    var modal = new bootstrap.Modal(document.getElementById('patientModal'));
    modal.show();

    var url = "{{ route('admin.patient.profile', ':id') }}";
    url = url.replace(':id', patientId);        

    // AJAX call
    $.ajax({
        url: url, // Ensure route exists
        type: 'GET',
        success: function(data) {
            $('#patientModalContent').html(data);
        },
        error: function(xhr, status, error) {
            $('#patientModalContent').html('<div class="text-danger p-3">Failed to load patient details.</div>');
            console.error(error);
        }
    });
});
</script>
<script>
$(function() {
    $('#attentions-table').DataTable({
        processing: true,
        ajax: '{{ route("admin.appointments.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'appointment_id', name: 'appointment_id' },
            { data: 'patient', name: 'patient' },
            { data: 'department', name: 'department' },
            { data: 'appointment_date', name: 'appointment_date' },
            { data: 'appointment_time', name: 'appointment_time' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
         responsive: true,
         scrollX: true
    });
});
</script>
@endpush
