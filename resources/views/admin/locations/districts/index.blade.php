@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Districts</h2>
        <a href="{{ route('admin.districts.create') }}" class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-plus"></i>
            Add District
        </a>
    </div>
    <hr class="mb-5">

    <table id="districts-table" class="min-w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">SL</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Bangla Name</th>
                <th class="px-4 py-2 border">Division ID</th>
                <th class="px-4 py-2 border">Thanas</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
    </table>
</div>

@push('scripts')
<script>
$(function () {
    $('#districts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.districts.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'bn_name', name: 'bn_name', defaultContent: '' },
            { data: 'division_id', name: 'division_id', defaultContent: '' },
            { data: 'thanas_count', name: 'thanas_count', searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
@endsection
