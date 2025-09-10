@extends('layouts.admin')

@section('content')
<div class="">
    <div class="bg-white shadow-lg rounded-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Patient List</h2>
            <a href="{{ route('admin.patients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Add Patient</a>
        </div>

        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 text-left">SL</th>
                        <th class="px-4 py-2 text-left">First Name</th>
                        <th class="px-4 py-2 text-left">Last Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Mobile</th>
                        <th class="px-4 py-2 text-left">Blood</th>
                        <th class="px-4 py-2 text-left">Sex</th>
                        <th class="px-4 py-2 text-left">DOB</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
$(function () {
    $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.patients.index') }}",
        columns: [
            {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
            {data: 'blood', name: 'blood'},
            {data: 'sex', name: 'sex'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'action', name: 'action',},
        ]
    });
});
</script>
@endpush
