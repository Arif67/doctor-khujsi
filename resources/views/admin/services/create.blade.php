@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Add New Service</h2>
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">+ All Services</a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.services.store') }}" method="POST" class="">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Icon (HTML Tag)</label>
                <input type="text" name="icon" value="{{ old('icon') }}" 
                    class="w-full border p-2 rounded" placeholder="<i class='fas fa-user'></i>">
                @error('icon') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                    class="w-full border p-2 rounded">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
    <div>
        <button type="submit" 
            class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-save mr-2"></i> Save
        </button>
    </div>
    </form>
</div>
@endsection
