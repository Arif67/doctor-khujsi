@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Departments</h2>
        <a 
            href="{{ route('admin.departments.create') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
            <i class="fas fa-plus"></i>
            Add Department
        </a>
    </div>
    <hr class="mb-5">

    <div>
        <table id="departments-table" class="min-w-full">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Short</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
    $('#departments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.departments.index') !!}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'name', name: 'name' },
            { data: 'code', name: 'code' },
            { data: 'short_name', name: 'short_name' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable:false, searchable:false },
        ],
        order: [[1, 'asc']],
    });
});
</script>
@endpush
