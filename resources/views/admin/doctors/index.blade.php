@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 lg:p-8 overflow-x-auto">
    <!-- Header -->
    <div class="flex flex-row justify-between items-center mb-4">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2 sm:mb-0">Doctors</h2>
        <a href="{{ route('admin.doctors.create') }}" 
           class="flex flex-row gap-2 items-center px-4 sm:px-5 py-2 bg-indigo-600 text-white text-sm sm:text-base font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-plus"></i>
            Add Doctor
        </a>
    </div>
    <hr class="mb-4 border-gray-200">

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="doctors-table" class="min-w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">SL</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-3 py-2 text-center text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200"></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
    $('#doctors-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true, // ✅ make datatable responsive
        ajax: '{!! route('admin.doctors.index') !!}',
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
            {data:'name',name:'name'},
            {data:'email',name:'email'},
            {data:'phone',name:'phone'},
            {data:'department',name:'department'},
            {data:'status',name:'status',render: function(data,type,row){
                if(data === 'active'){
                    return '<span class="px-2 py-1 rounded text-white bg-green-600 text-xs sm:text-sm">Active</span>';
                } else {
                    return '<span class="px-2 py-1 rounded text-white bg-red-600 text-xs sm:text-sm">Inactive</span>';
                }
            }},
            {data:'action',name:'action',orderable:false,searchable:false,className:'text-center'},
        ],
        order:[[1,'asc']],
    });
});
</script>
@endpush
