@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-semibold">Hospital Profile</h1>
            <p class="text-sm text-slate-500 mt-1">Public hospital details, privacy policy, and location info from your panel.</p>
        </div>
    </div>
    <hr class="mb-5">

    <form action="{{ route('admin.hospital.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-[220px,1fr] gap-6 items-start">
            <div>
                <label class="block text-gray-700 mb-2" for="photo">Hospital Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                <div class="mt-4">
                    <img id="hospital_photo_preview" src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/default.png') }}" alt="{{ $user->hospital_name }}" class="w-48 h-40 object-cover rounded-xl border">
                </div>
                @if($user->photo)
                    <label class="inline-flex items-center gap-2 mt-3 text-sm text-slate-600">
                        <input type="checkbox" name="delete_photo" value="1">
                        <span>Remove current photo</span>
                    </label>
                @endif
            </div>
            <div class="text-sm text-slate-500">
                Ei photo ta user side er hospital card ar hospital details hero section e dekhabe.
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-1" for="name">Owner Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-1" for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="hospital_name">Hospital Name</label>
                <input type="text" id="hospital_name" name="hospital_name" value="{{ old('hospital_name', $user->hospital_name) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 mb-1" for="hospital_location">Full Location</label>
            <input type="text" id="hospital_location" name="hospital_location" value="{{ old('hospital_location', $user->hospital_location) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 mb-1" for="district_id">Jila</label>
                <select name="district_id" id="district_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" data-selected="{{ old('district_id', $locationSelection['district_id']) }}">
                    <option value="">Select jila</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" @selected(old('district_id', $locationSelection['district_id']) == $district->id)>{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="thana_id">Thana</label>
                <select name="thana_id" id="thana_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" data-selected="{{ old('thana_id', $locationSelection['thana_id']) }}" disabled>
                    <option value="">Select thana</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="area_id">Area</label>
                <select name="area_id" id="area_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" data-selected="{{ old('area_id', $locationSelection['area_id']) }}" disabled>
                    <option value="">Select area</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-1" for="about_hospital">About Hospital</label>
                <textarea id="about_hospital" name="about_hospital" rows="8" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('about_hospital', $user->about_hospital) }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="privacy_policy">Privacy Policy</label>
                <textarea id="privacy_policy" name="privacy_policy" rows="8" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('privacy_policy', $user->privacy_policy) }}</textarea>
            </div>
        </div>

        <div>
            <button type="submit" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> Update Profile
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('hospital_photo_preview');
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

    photoInput?.addEventListener('change', function(event) {
        const [file] = event.target.files || [];

        if (!file) {
            return;
        }

        const reader = new FileReader();
        reader.onload = function(loadEvent) {
            photoPreview.src = loadEvent.target.result;
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
