@php
    $sectionData = $featuredHospitalsData->data ?? [];
    $selectedIds = collect(old('hospital_ids', $sectionData['hospital_ids'] ?? []))
        ->map(fn ($id) => (int) $id)
        ->values();
    $selectedHospitals = $hospitalOwners->whereIn('id', $selectedIds)->sortBy(fn ($hospital) => $selectedIds->search((int) $hospital->id));
@endphp

<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
        <div>
            <h4 class="text-xl font-semibold text-gray-800 mb-1">Featured Hospitals</h4>
            <p class="text-sm text-gray-500 mb-0">Admin homepage-e max 10 ta approved hospital select ar order control korte parbe.</p>
        </div>
        <div class="text-sm text-gray-500">
            Selected: <span class="font-semibold text-gray-700" data-selected-count>{{ $selectedIds->count() }}</span>/10
        </div>
    </div>

    <form action="{{ route('admin.sections.home.featured_hospitals.update') }}" method="POST" class="bg-gray-50 border rounded-2xl p-5 space-y-5" id="featured-hospitals-form">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Section Title</label>
                <input type="text" name="title" value="{{ old('title', $sectionData['title'] ?? 'Featured hospitals') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block font-semibold mb-1">Section Description</label>
                <input type="text" name="description" value="{{ old('description', $sectionData['description'] ?? 'Choose trusted hospitals from the admin panel and keep up to ten featured on the homepage.') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div>
                <label class="block font-semibold mb-2">Available Hospitals</label>
                <p class="text-sm text-gray-500 mb-3">`Add` click kore hospital selected list-e nin.</p>
                <div class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 max-h-[520px] overflow-y-auto">
                    @foreach ($hospitalOwners as $hospital)
                        @php
                            $hospitalName = $hospital->hospital_name ?: trim($hospital->first_name . ' ' . $hospital->last_name) ?: 'Unnamed hospital';
                            $location = $hospital->hospital_location ?: 'Location not added yet';
                        @endphp
                        <div
                            class="flex items-start gap-3 rounded-xl border border-slate-200 p-3"
                            data-hospital-option
                            data-hospital-id="{{ $hospital->id }}"
                            data-selected="{{ $selectedIds->contains((int) $hospital->id) ? 'true' : 'false' }}"
                            data-name="{{ e($hospitalName) }}"
                            data-location="{{ e($location) }}"
                            data-image="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}"
                        >
                            <img
                                src="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}"
                                alt="{{ $hospital->hospital_name }}"
                                class="w-14 h-14 rounded-xl object-cover border"
                            >
                            <span class="min-w-0 flex-1">
                                <span class="block font-semibold text-slate-800">{{ $hospitalName }}</span>
                                <span class="block text-sm text-slate-500">{{ $location }}</span>
                            </span>
                            <button
                                type="button"
                                class="shrink-0 rounded-lg px-3 py-2 text-sm font-semibold text-white transition"
                                data-add-hospital
                                style="{{ $selectedIds->contains((int) $hospital->id) ? 'background:#94a3b8;' : 'background:#059669;' }}"
                                {{ $selectedIds->contains((int) $hospital->id) ? 'disabled' : '' }}
                            >
                                {{ $selectedIds->contains((int) $hospital->id) ? 'Added' : 'Add' }}
                            </button>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500 mt-2">Approved hospital list automatically show hocche.</p>
            </div>

            <div>
                <label class="block font-semibold mb-2">Selected Hospitals Order</label>
                <p class="text-sm text-gray-500 mb-3">`Up` / `Down` diye homepage-e hospital order control korun. Uporer gula age dekhabe.</p>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 min-h-[220px]">
                    <div class="space-y-3" id="selected-hospitals-list">
                        @foreach ($selectedHospitals as $hospital)
                            @php
                                $hospitalName = $hospital->hospital_name ?: trim($hospital->first_name . ' ' . $hospital->last_name) ?: 'Unnamed hospital';
                                $location = $hospital->hospital_location ?: 'Location not added yet';
                            @endphp
                            <div class="selected-hospital-item flex items-start gap-3 rounded-xl border border-slate-200 p-3" data-selected-hospital data-hospital-id="{{ $hospital->id }}">
                                <input type="hidden" name="hospital_ids[]" value="{{ $hospital->id }}">
                                <img
                                    src="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}"
                                    alt="{{ $hospital->hospital_name }}"
                                    class="w-14 h-14 rounded-xl object-cover border"
                                >
                                <span class="min-w-0 flex-1">
                                    <span class="block font-semibold text-slate-800">{{ $hospitalName }}</span>
                                    <span class="block text-sm text-slate-500">{{ $location }}</span>
                                </span>
                                <div class="flex flex-col gap-2">
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-up>Up</button>
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-down>Down</button>
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-white" data-remove-hospital style="background:#dc2626;">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="selected-hospitals-empty" class="px-2 py-10 text-center text-gray-500 {{ $selectedHospitals->isNotEmpty() ? 'hidden' : '' }}">
                        Ekhono kono featured hospital select kora hoyni.
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button
                type="submit"
                class="inline-flex items-center font-semibold"
                style="background:#059669;color:#fff;padding:12px 20px;border-radius:12px;border:0;box-shadow:0 10px 24px rgba(5,150,105,.22);"
            >
                <i class="fas fa-save mr-2"></i>Save Featured Hospitals
            </button>
        </div>
    </form>

    <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
        <div class="px-5 py-4 border-b bg-slate-50">
            <h5 class="text-lg font-semibold text-gray-800 mb-1">Current Homepage Hospitals</h5>
            <p class="text-sm text-gray-500 mb-0">Je order-e select korben, homepage-e oi order-e dekhabe.</p>
        </div>

        @if ($selectedHospitals->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 p-5">
                @foreach ($selectedHospitals as $hospital)
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="flex items-start gap-3">
                            <img
                                src="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}"
                                alt="{{ $hospital->hospital_name }}"
                                class="w-16 h-16 rounded-xl object-cover border"
                            >
                            <div>
                                <div class="font-semibold text-slate-800">{{ $hospital->hospital_name ?: trim($hospital->first_name . ' ' . $hospital->last_name) ?: 'Unnamed hospital' }}</div>
                                <div class="text-sm text-slate-500">{{ $hospital->hospital_location ?: 'Location not added yet' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-5 py-10 text-center text-gray-500">
                Ekhono kono featured hospital select kora hoyni.
            </div>
        @endif
    </div>
</div>

<template id="selected-hospital-template">
    <div class="selected-hospital-item flex items-start gap-3 rounded-xl border border-slate-200 p-3" data-selected-hospital>
        <input type="hidden" name="hospital_ids[]">
        <img class="w-14 h-14 rounded-xl object-cover border" alt="">
        <span class="min-w-0 flex-1">
            <span class="block font-semibold text-slate-800" data-hospital-name></span>
            <span class="block text-sm text-slate-500" data-hospital-location></span>
        </span>
        <div class="flex flex-col gap-2">
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-up>Up</button>
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-down>Down</button>
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-white" data-remove-hospital style="background:#dc2626;">Remove</button>
        </div>
    </div>
</template>

<script>
    (function () {
        const form = document.getElementById('featured-hospitals-form');

        if (!form) {
            return;
        }

        const maxSelected = 10;
        const selectedList = document.getElementById('selected-hospitals-list');
        const emptyState = document.getElementById('selected-hospitals-empty');
        const template = document.getElementById('selected-hospital-template');
        const countNode = document.querySelector('[data-selected-count]');

        const selectedCount = () => selectedList.querySelectorAll('[data-selected-hospital]').length;

        const updateEmptyState = () => {
            const count = selectedCount();

            if (countNode) {
                countNode.textContent = count;
            }

            emptyState.classList.toggle('hidden', count > 0);

            document.querySelectorAll('[data-add-hospital]').forEach((button) => {
                const option = button.closest('[data-hospital-option]');
                const isSelected = option.dataset.selected === 'true';

                if (isSelected) {
                    return;
                }

                button.disabled = count >= maxSelected;
                button.style.background = count >= maxSelected ? '#94a3b8' : '#059669';
            });
        };

        const setOptionState = (hospitalId, selected) => {
            const option = document.querySelector(`[data-hospital-option][data-hospital-id="${hospitalId}"]`);

            if (!option) {
                return;
            }

            const button = option.querySelector('[data-add-hospital]');
            option.dataset.selected = selected ? 'true' : 'false';
            button.textContent = selected ? 'Added' : 'Add';

            if (selected) {
                button.disabled = true;
                button.style.background = '#94a3b8';
                return;
            }

            button.disabled = false;
            button.style.background = '#059669';
        };

        const buildSelectedItem = (hospital) => {
            const fragment = template.content.firstElementChild.cloneNode(true);
            fragment.dataset.hospitalId = hospital.id;
            fragment.querySelector('input[name="hospital_ids[]"]').value = hospital.id;

            const image = fragment.querySelector('img');
            image.src = hospital.image;
            image.alt = hospital.name;

            fragment.querySelector('[data-hospital-name]').textContent = hospital.name;
            fragment.querySelector('[data-hospital-location]').textContent = hospital.location;

            return fragment;
        };

        document.querySelectorAll('[data-add-hospital]').forEach((button) => {
            button.addEventListener('click', () => {
                if (selectedCount() >= maxSelected) {
                    return;
                }

                const option = button.closest('[data-hospital-option]');
                const hospitalId = option.dataset.hospitalId;

                if (selectedList.querySelector(`[data-selected-hospital][data-hospital-id="${hospitalId}"]`)) {
                    return;
                }

                selectedList.appendChild(buildSelectedItem({
                    id: hospitalId,
                    name: option.dataset.name,
                    location: option.dataset.location,
                    image: option.dataset.image,
                }));

                setOptionState(hospitalId, true);
                updateEmptyState();
            });
        });

        selectedList.addEventListener('click', (event) => {
            const item = event.target.closest('[data-selected-hospital]');

            if (!item) {
                return;
            }

            if (event.target.closest('[data-move-up]')) {
                const previous = item.previousElementSibling;

                if (previous) {
                    selectedList.insertBefore(item, previous);
                }
            }

            if (event.target.closest('[data-move-down]')) {
                const next = item.nextElementSibling;

                if (next) {
                    selectedList.insertBefore(next, item);
                }
            }

            if (event.target.closest('[data-remove-hospital]')) {
                setOptionState(item.dataset.hospitalId, false);
                item.remove();
                updateEmptyState();
            }
        });

        updateEmptyState();
    })();
</script>
