@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
     <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit Service</h2>
        <a href="{{ route('admin.services.index') }}" class="flex flex-row gap-3 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.services.update',$service->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Icon (HTML Tag)</label>
            <input type="text" name="icon" value="{{ old('icon',$service->icon) }}" 
                   class="w-full border p-2 rounded">
            @error('icon') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title',$service->title) }}" 
                   class="w-full border p-2 rounded">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded">{{ old('description',$service->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <button type="submit" 
                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
