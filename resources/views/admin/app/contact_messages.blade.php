@extends('layouts.admin')

@section('content')
<div class="bg-white p-4 rounded-md shadow">
    <h4 class="text-xl font-semibold text-gray-800 mb-3">Contact Messages</h4>
    <hr class="mb-4"> 

    <div class="table-responsive">
        <table id="messagesTable" class="table table-bordered table-striped w-100">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#messagesTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true, // ✅ Responsive enabled
        autoWidth: false, // ✅ Column width auto adjust বন্ধ করলাম
        ajax: "{{ route('admin.contact.messages') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'message', name: 'message'},
            {data: 'created_at', name: 'created_at'}
        ]
    });
});
</script>
@endpush
