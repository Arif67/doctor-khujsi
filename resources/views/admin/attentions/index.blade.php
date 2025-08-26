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

    <table id="attentions-table" class="min-w-full bg-white border rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">SL</th>
                <th class="px-4 py-2">Icon</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Created At</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@push('scripts')
<script>
$(function() {
    $('#attentions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.attentions.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'icon', name: 'icon' },
            { data: 'title', name: 'title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
