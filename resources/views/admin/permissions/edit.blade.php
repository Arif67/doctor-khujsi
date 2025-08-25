@extends('layouts.admin')

@section('content')
<div class="">
    <!-- Card -->
    <div class="bg-white shadow rounded-lg p-6 max-w-2xl  mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Edit Permission</h2>
            <a href="{{ route('admin.permissions.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Back Permissions</a>
        </div>
        <hr>
        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="{{ $permission->name }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required
                >
                @error('name')
                    <span class="text-[red] font-semibold">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex space-x-2 mt-4">
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Update</span>
                </button>
                <a href="{{ route('admin.permissions.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
