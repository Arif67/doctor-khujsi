@extends('layouts.admin')

@section('content')
<div class="w-full md:max-w-4xl mx-auto md:p-6 lg:p-2">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Add New Role</h1>

        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Role Name -->
           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">
                <!-- Role Name -->
                <div class="lg:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
                    <input type="text" name="name" id="name" 
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm" 
                        placeholder="Enter role name" required>
                    @error('name')
                        <span class="text-[red] font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="lg:col-span-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="description" 
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm" 
                        placeholder="Enter description">
                </div>
            </div>


            <!-- Permissions -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Assign Permissions</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($permissions as $permission)
                        <div class="flex items-center">
                            <input id="perm-{{ $permission->id }}" 
                                   type="checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}"
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="perm-{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center space-x-3">
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:ring focus:ring-green-300">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
                <a href="{{ route('admin.roles.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 focus:ring focus:ring-gray-300">
                   Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
