@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Edit Thana</h2>
        <a href="{{ route('admin.thanas.index') }}" class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            All Thanas
        </a>
    </div>
    <hr class="mb-5">

    <form action="{{ route('admin.thanas.update', $thana->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">District</label>
                <select name="district_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select district</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" @selected(old('district_id', $thana->district_id) == $district->id)>{{ $district->name }}</option>
                    @endforeach
                </select>
                @error('district_id') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $thana->name) }}" class="w-full border px-3 py-2 rounded" required>
                @error('name') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Bangla Name</label>
                <input type="text" name="bn_name" value="{{ old('bn_name', $thana->bn_name) }}" class="w-full border px-3 py-2 rounded">
                @error('bn_name') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">URL</label>
                <input type="text" name="url" value="{{ old('url', $thana->url) }}" class="w-full border px-3 py-2 rounded">
                @error('url') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <button type="submit" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
