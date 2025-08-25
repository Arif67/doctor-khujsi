@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Services</h1>
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
                <th class="p-2 text-left">Icon</th>
                <th class="p-2 text-left">Title</th>
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
            {data: 'id', name: 'id'},
            {data: 'icon', name: 'icon', render: function(data){ return data; }},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
@endpush
