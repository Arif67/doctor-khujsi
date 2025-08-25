@extends('layouts.admin')

@section('content')
<div class="">
    <!-- Card -->
    <div class="bg-white shadow rounded-lg p-6">
         <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">  Create User</h2>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                All Users
            </a>
        </div>
        <hr class="mb-5">

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold" for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter name" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('name')
                        <span class="text-[red] font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 mb-1 font-semibold" for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('email')
                        <span class="text-[red] font-semibold">{{ $message }}</span>
                    @enderror
                </div>

               <div>
                    <div class="relative ">
                        <label class="block text-gray-700 mb-1 font-semibold" for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter password" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <span class="absolute right-2 top-9 cursor-pointer text-gray-500 toggle-password" data-target="#password">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-[red] font-semibold">{{ $message }}</span>
                    @enderror
               </div>
               <div>
                    <div class="relative">
                        <label class="block text-gray-700 mb-1 font-semibold" for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <span class="absolute right-2 top-9 cursor-pointer text-gray-500 toggle-password" data-target="#password_confirmation">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <span class="text-[red] font-semibold">{{ $message }}</span>
                    @enderror
               </div>
            </div>

            <!-- Roles -->
            <div>
                <label class="block text-gray-700 mb-2 font-semibold">Roles</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($roles as $role)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                class="form-checkbox h-5 w-5 text-blue-500">
                            <span class="text-gray-700">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="">
                 <button type="submit" 
                        class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-2"></i> Save
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