
@extends('layouts.admin')
@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Edit Doctor</h2>
        <a 
            href="{{ route('admin.doctors.index') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
           <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
    <hr class="mb-5">
    <div class="">
       <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.doctors.form')
        </form>
    </div>
</div>
@endsection
