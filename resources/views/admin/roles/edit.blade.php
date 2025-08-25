@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <!-- Header -->
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Role</h1>

    <!-- Card -->
    <div class="bg-white shadow-lg rounded-xl p-6">
        <form action="{{ route('admin.roles.update',$role->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <!-- Role Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                <input type="text" 
                       name="name" 
                       id="name"
                       value="{{ $role->name }}"
                       required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 px-4 py-2">
            </div>

            <!-- Permissions -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">Assign Permissions</label>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($permissions as $permission)
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}"
                                   id="perm-{{ $permission->id }}"
                                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                   {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                            <label for="perm-{{ $permission->id }}" class="text-sm text-gray-600">
                                {{ ucfirst($permission->name) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <button type="submit" 
                        class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
                <a href="{{ route('admin.roles.index') }}" 
                   class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
