@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Areas</h2>
        <a href="{{ route('admin.areas.create') }}" class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-plus"></i>
            Add Area
        </a>
    </div>
    <hr class="mb-5">

    <table id="areas-table" class="min-w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">SL</th>
                <th class="px-4 py-2 border">District</th>
                <th class="px-4 py-2 border">Thana</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Bangla Name</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
    </table>
</div>

@push('scripts')
<script>
$(function () {
    $('#areas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.areas.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'district', name: 'thana.district.name', defaultContent: '—' },
            { data: 'thana', name: 'thana.name', defaultContent: '—' },
            { data: 'name', name: 'name' },
            { data: 'bn_name', name: 'bn_name', defaultContent: '' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
@endsection
