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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1" for="hospital_name">Hospital Name</label>
                    <input type="text" name="hospital_name" id="hospital_name" placeholder="Enter hospital name"
                        value="{{ old('hospital_name', $user->hospital_name) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="hospital_location">Full Location</label>
                    <input type="text" name="hospital_location" id="hospital_location" placeholder="Enter full location"
                        value="{{ old('hospital_location', $user->hospital_location) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1" for="about_hospital">About Hospital</label>
                    <textarea name="about_hospital" id="about_hospital" rows="6"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('about_hospital', $user->about_hospital) }}</textarea>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="privacy_policy">Privacy Policy</label>
                    <textarea name="privacy_policy" id="privacy_policy" rows="6"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('privacy_policy', $user->privacy_policy) }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 mb-1" for="district_id">Jila</label>
                    <select name="district_id" id="district_id"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        data-selected="{{ old('district_id', $locationSelection['district_id']) }}">
                        <option value="">Select jila</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" @selected(old('district_id', $locationSelection['district_id']) == $district->id)>{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="thana_id">Thana</label>
                    <select name="thana_id" id="thana_id"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        data-selected="{{ old('thana_id', $locationSelection['thana_id']) }}" disabled>
                        <option value="">Select thana</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="area_id">Area</label>
                    <select name="area_id" id="area_id"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        data-selected="{{ old('area_id', $locationSelection['area_id']) }}" disabled>
                        <option value="">Select area</option>
                    </select>
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

    const districtSelect = document.getElementById('district_id');
    const thanaSelect = document.getElementById('thana_id');
    const areaSelect = document.getElementById('area_id');

    function fillSelect(select, items, placeholder, selectedValue) {
        select.innerHTML = `<option value="">${placeholder}</option>`;

        items.forEach((item) => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;

            if (String(selectedValue || '') === String(item.id)) {
                option.selected = true;
            }

            select.appendChild(option);
        });

        select.disabled = items.length === 0;
    }

    async function loadThanas(districtId, selectedThanaId = '') {
        fillSelect(thanaSelect, [], 'Select thana', '');
        fillSelect(areaSelect, [], 'Select area', '');

        if (!districtId) {
            return;
        }

        const response = await fetch(`{{ url('/locations/districts') }}/${districtId}/thanas`);
        const thanas = await response.json();

        fillSelect(thanaSelect, thanas, 'Select thana', selectedThanaId);
    }

    async function loadAreas(thanaId, selectedAreaId = '') {
        fillSelect(areaSelect, [], 'Select area', '');

        if (!thanaId) {
            return;
        }

        const response = await fetch(`{{ url('/locations/thanas') }}/${thanaId}/areas`);
        const areas = await response.json();

        fillSelect(areaSelect, areas, 'Select area', selectedAreaId);
    }

    districtSelect.addEventListener('change', () => loadThanas(districtSelect.value));
    thanaSelect.addEventListener('change', () => loadAreas(thanaSelect.value));

    const selectedDistrict = districtSelect.dataset.selected;
    const selectedThana = thanaSelect.dataset.selected;
    const selectedArea = areaSelect.dataset.selected;

    if (selectedDistrict) {
        loadThanas(selectedDistrict, selectedThana).then(() => {
            if (selectedThana) {
                loadAreas(selectedThana, selectedArea);
            }
        });
    }
});
</script>
@endpush
