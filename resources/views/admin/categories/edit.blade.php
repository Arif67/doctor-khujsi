@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
     <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Create Category</h2>
        <a 
            href="{{ route('admin.categories.index') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
           <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Name (English)</label>
                <input type="text" name="name" value="{{ old('name', $category->getRawOriginal('name')) }}" class="w-full border px-3 py-2 rounded" required>
                 @error('name') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ old('name_bn', $category->getRawOriginal('name_bn')) }}" class="w-full border px-3 py-2 rounded">
                 @error('name_bn') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Parent Category</label>
                <select name="parent_id" class="w-full border px-3 py-2 rounded">
                    <option value="">None</option>
                    @foreach($parents as $p)
                    <option value="{{ $p->id }}" {{ $category->parent_id == $p->id ? 'selected':'' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
                @error('parent_id') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
            <label class="block font-semibold mb-1">Description (English)</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded">{{ old('description', $category->getRawOriginal('description')) }}</textarea>
            @error('description') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>
            <div>
            <label class="block font-semibold mb-1">Description (Bangla)</label>
            <textarea name="description_bn" class="w-full border px-3 py-2 rounded">{{ old('description_bn', $category->getRawOriginal('description_bn')) }}</textarea>
            @error('description_bn') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>
        </div>
        
        <div>
            <button type="submit" 
                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i>Update
            </button>
        </div>
    </form>
</div>
@endsection
