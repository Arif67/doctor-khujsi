@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Add Gallery Image</h1>
        <a href="{{ route('admin.hospital-galleries.index') }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">All Images</a>
    </div>
    <hr class="mb-5">

    <form action="{{ route('admin.hospital-galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @include('admin.hospital-galleries.partials.form')
    </form>
</div>
@endsection
