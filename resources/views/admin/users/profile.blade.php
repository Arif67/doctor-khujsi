@extends('layouts.admin')

@section('content')
<div class="">
    <!-- Profile Card -->
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <!-- Edit Form -->
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <!-- Avatar -->
            <div class="relative w-32 h-32">
                <img id="imagePreview" 
                    src="{{ $user->image ? asset('storage/'.$user->image) : asset('assets/img/undraw_profile_2.svg') }}" 
                    alt="Profile Image"
                    class="w-32 h-32 rounded-full object-cover border"
                >

                <!-- Camera Icon -->
                <label for="image" 
                       class="absolute bottom-0 right-0 bg-blue-600 text-white px-3 py-2  rounded-full cursor-pointer shadow">
                    <i class="fas fa-camera"></i>
                </label>
                <input type="file" id="image" name="image" class="hidden" accept="image/*">
            </div>

            <!-- Info -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>

                <!-- Roles -->
                <div class="mt-3">
                    <h3 class="font-semibold text-gray-700">Roles:</h3>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach($user->roles as $role)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-lg">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-6 border-t"></div>

        

            <!-- Row 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1" for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
            </div>

            <!-- Row 2: Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <label class="block text-gray-700 mb-1" for="password">New Password</label>
                    <input type="password" name="password" id="password" placeholder="Leave blank to keep old password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <span class="absolute right-3 top-9 cursor-pointer text-gray-500 toggle-password" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <div class="relative">
                    <label class="block text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <span class="absolute right-3 top-9 cursor-pointer text-gray-500 toggle-password" data-target="#password_confirmation">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <!-- Save Button -->
            <div class="text-right">
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
    $('#image').change(function(e){
        let reader = new FileReader();
        reader.onload = function(e){
            $('#imagePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
});
</script>
@endpush
