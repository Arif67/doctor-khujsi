@extends('layouts.admin')
@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Add Doctor</h2>
        <a 
            href="{{ route('admin.doctors.index') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
            All Doctor
        </a>
    </div>
    <hr class="mb-5">
    <div class="">
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.doctors.form')
        </form>
    </div>
</div>
@endsection
