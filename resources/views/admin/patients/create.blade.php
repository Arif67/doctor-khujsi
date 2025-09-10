@extends('layouts.admin')

@section('content')
<div class="">
    <div class="bg-white shadow-lg rounded-md p-6">
         <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Add Patient</h2>
            <a 
                href="{{ route('admin.patients.index') }}" 
                class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
            >
                All Patients
            </a>
        </div>
        <hr class="mb-5">

        {{-- Error Message (Global) --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.patients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">First Name *</label>
                    <input type="text" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Email & Phone --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Email *</label>
                    <input type="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Mobile & Blood --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile number" value="{{ old('mobile') }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('mobile') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Blood Group</label>
                    <select name="blood" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <option value="">Select Blood Group</option>
                        <option value="A+" {{ old('blood') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="O+" {{ old('blood') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood') == 'O-' ? 'selected' : '' }}>O-</option>
                        <option value="AB+" {{ old('blood') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood') == 'AB-' ? 'selected' : '' }}>AB-</option>
                    </select>
                    @error('blood') 
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                    @enderror
                </div>
            </div>

            {{-- Sex & DOB --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Sex</label>
                    <select name="sex" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <option value="">Select</option>
                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('sex') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('date_of_birth') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-gray-700 font-medium">Address</label>
                <textarea name="address" placeholder="Enter full address" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">{{ old('address') }}</textarea>
                @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Photo --}}
            <div>
                <label class="block text-gray-700 font-medium">Photo</label>
                    <input type="file" name="photo" id="photoInput" class="w-full mt-1 px-3 py-[6px] border rounded-lg">
                    @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror

                    {{-- Preview Box --}}
                    <div class="mt-3">
                        <img id="photoPreview" src="#" alt="Preview" class="hidden w-32 h-32 object-cover rounded border">
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-gray-700 font-medium">Password *</label>
                    <input type="password" name="password" placeholder="Enter password" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            

            {{-- Submit --}}
            <div class="pt-4">
              <button type="submit" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
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
        $('#photoInput').on('change', function(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#photoPreview')
                    .attr('src', e.target.result)
                    .removeClass('hidden'); // show preview
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    });
</script>
@endpush
