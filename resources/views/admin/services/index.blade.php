@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">{{ $isHospitalOwner ? 'My Hospital Services' : 'Services' }}</h1>
        <a href="{{ route('admin.services.create') }}" 
           class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
           + Add Service
        </a>
    </div>
    <hr class="mb-5">
    <table id="services-table" class="min-w-full border rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">SL</th>
                <th class="p-2 text-left">Image</th>
                <th class="p-2 text-left">Title</th>
                @unless($isHospitalOwner)
                <th class="p-2 text-left">Hospital</th>
                @endunless
                <th class="p-2 text-left">Description</th>
                <th class="p-2 text-left">Created</th>
                <th class="p-2 text-left">Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function () {
    $('#services-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.services.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'title', name: 'title'},
            @unless($isHospitalOwner)
            {data: 'hospital', name: 'owner.hospital_name', defaultContent: '-'},
            @endunless
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
@endpush
