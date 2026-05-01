@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Create Area</h2>
        <a href="{{ route('admin.areas.index') }}" class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            All Areas
        </a>
    </div>
    <hr class="mb-5">

    <form action="{{ route('admin.areas.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">District</label>
                <select name="district_id" id="district_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select district</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" @selected(old('district_id') == $district->id)>{{ $district->name }}</option>
                    @endforeach
                </select>
                @error('district_id') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Thana</label>
                <select name="thana_id" id="thana_id" class="w-full border px-3 py-2 rounded" disabled required>
                    <option value="">Select thana</option>
                </select>
                @error('thana_id') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
                @error('name') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Bangla Name</label>
                <input type="text" name="bn_name" value="{{ old('bn_name') }}" class="w-full border px-3 py-2 rounded">
                @error('bn_name') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">URL</label>
                <input type="text" name="url" value="{{ old('url') }}" class="w-full border px-3 py-2 rounded">
                @error('url') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <button type="submit" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> Save
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const districtSelect = document.getElementById('district_id');
    const thanaSelect = document.getElementById('thana_id');
    const selectedDistrict = '{{ old('district_id') }}';
    const selectedThana = '{{ old('thana_id') }}';

    function fillThanas(items, selectedValue = '') {
        thanaSelect.innerHTML = '<option value="">Select thana</option>';

        items.forEach((item) => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            option.selected = String(selectedValue) === String(item.id);
            thanaSelect.appendChild(option);
        });

        thanaSelect.disabled = items.length === 0;
    }

    async function loadThanas(districtId, selectedValue = '') {
        fillThanas([], '');

        if (!districtId) {
            return;
        }

        const response = await fetch(`{{ url('/locations/districts') }}/${districtId}/thanas`);
        const thanas = await response.json();
        fillThanas(thanas, selectedValue);
    }

    districtSelect.addEventListener('change', () => loadThanas(districtSelect.value));

    if (selectedDistrict) {
        loadThanas(selectedDistrict, selectedThana);
    }
});
</script>
@endpush
@endsection
