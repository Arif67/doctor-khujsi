@extends('layouts.admin')

@section('content')
<div class="">
    <!-- Card -->
    <div class="bg-white shadow rounded-lg p-6">
         <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800"> Edit User</h2>
            <a 
                href="{{ route('admin.users.index') }}" 
                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                All Users
            </a>
        </div>
        <hr class="mb-5">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Row 1: Name & Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1" for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter name" required
                        value="{{ $user->name }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" required
                        value="{{ $user->email }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
            </div>

            <!-- Row 2: Password & Confirm Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-gray-700 mb-1" for="password">Password (optional)</label>
                    <input 
                        type="password" 
                        name="password" id="password" placeholder="Enter new password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ $user->plan_password }}"
                    >
                    <span class="absolute right-3 top-9 cursor-pointer text-gray-500 toggle-password" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <div class="relative">
                    <label class="block text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ $user->plan_password }}"
                    >
                    <span class="absolute right-3 top-9 cursor-pointer text-gray-500 toggle-password" data-target="#password_confirmation">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Roles -->
            <div>
                <label class="block text-gray-700 mb-2">Roles</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($roles as $role)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                class="form-checkbox h-5 w-5 text-blue-500"
                                {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                            <span class="text-gray-700">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.toggle-password').click(function(){
        var target = $($(this).data('target'));
        var icon = $(this).find('i');
        if(target.attr('type') === 'password'){
            target.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            target.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
@endpush
