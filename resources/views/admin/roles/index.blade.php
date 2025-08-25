@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Roles</h2>
            <a href="{{ route('admin.roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Role</a>
        </div>

        <table id="roles-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">SL</th>
                    <th class="px-4 py-2">Role Name</th>
                    <th class="px-4 py-2">Permissions</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@push('scripts')
<script>
$(function () {
    $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.roles.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'name', name: 'name' },
            { data: 'permissions', name: 'permissions', orderable:false, searchable:false },
            { data: 'action', name: 'action', orderable:false, searchable:false },
        ]
    });
});
</script>
@endpush
