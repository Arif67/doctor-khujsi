@extends('layouts.admin')

@section('content')
<div class="">
    <div class="bg-white shadow-lg rounded-2xl p-6">
       <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Edit Patient</h2>
            <a 
                href="{{ route('admin.patients.index') }}" 
                class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
            >
            <i class="fas fa-arrow-left"></i>Back
            </a>
        </div>
        <hr class="mb-4">

        {{-- Global Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">First Name *</label>
                    <input type="text" name="first_name" placeholder="Enter first name" value="{{ old('first_name', $patient->first_name) }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                    @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter last name" value="{{ old('last_name', $patient->last_name) }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Email & Phone --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Email *</label>
                    <input type="email" name="email" placeholder="Enter email" value="{{ old('email', $patient->email) }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone" placeholder="Enter phone number" value="{{ old('phone', $patient->phone) }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Mobile & Blood --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile number" value="{{ old('mobile', $patient->mobile) }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('mobile') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Blood Group</label>
                    <select name="blood" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <option value="">Select Blood Group</option>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood', $patient->blood) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                    @error('blood') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Sex & DOB --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Sex</label>
                    <select name="sex" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                        <option value="">Select</option>
                        <option value="Male" {{ old('sex', $patient->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex', $patient->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('sex') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('date_of_birth') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-gray-700 font-medium">Address</label>
                <textarea name="address" placeholder="Enter full address" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">{{ old('address', $patient->address) }}</textarea>
                @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Photo & Password --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Photo</label>
                    <input type="file" name="photo" id="photoInput" class="w-full mt-1 px-3 py-[6px] border rounded-lg">
                    @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror

                    <div class="mt-2 flex flex-row gap-4 items-center">
                        <img id="photoPreview" src="{{ $patient->photo ? asset('uploads/patients/'.$patient->photo) : '#' }}" class="w-24 h-24 object-cover rounded border {{ $patient->photo ? '' : 'hidden' }}">
                        @if ($patient->photo)
                            <span class="flex flex-row items-center gap-2">
                                <input type="checkbox" name="delete_photo" > 
                                <span class="text-red-600">Remove Photo</span>
                            </span>
                            
                        @endif
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Password (Leave blank if not changing)</label>
                    <input type="password" name="password" placeholder="Enter new password" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-4">
                <button type="submit" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#photoInput').on('change', function(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#photoPreview')
                    .attr('src', e.target.result)
                    .removeClass('hidden');
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    });
</script>
@endpush

@endsection
