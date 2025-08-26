@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
     <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit Attention</h2>
        <a href="{{ route('admin.attentions.index') }}" class="flex flex-row gap-3 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.attentions.update',$attention->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold mb-1">Icon</label>
            <input type="text" name="icon" value="{{ old('icon',$attention->icon) }}" class="w-full border rounded px-3 py-2">
            @error('icon') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title',$attention->title) }}" class="w-full border rounded px-3 py-2">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
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
