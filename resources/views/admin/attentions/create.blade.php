@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Add New Attention</h2>
        <a 
            href="{{ route('admin.attentions.index') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
            All Attention
        </a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.attentions.store') }}" method="POST">
        @csrf
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block font-semibold mb-1">Icon</label>
                <input type="text" name="icon" value="{{ old('icon') }}" class="w-full border rounded px-3 py-2">
                @error('icon') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2">
                @error('title') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
       </div>
       <div>
        <div>
                <button type="submit" 
                    class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> Save
            </button>
        </div>
       </div>
    </form>
</div>
@endsection
