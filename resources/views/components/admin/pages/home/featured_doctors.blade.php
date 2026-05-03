@php
    $sectionData = $featuredDoctorsData->data ?? [];
    $selectedIds = collect(old('doctor_ids', $sectionData['doctor_ids'] ?? []))
        ->map(fn ($id) => (int) $id)
        ->values();
    $selectedDoctors = $doctors->whereIn('id', $selectedIds)->sortBy(fn ($doctor) => $selectedIds->search((int) $doctor->id));
    $displayCount = old('display_count', $sectionData['display_count'] ?? 6);
@endphp

<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
        <div>
            <h4 class="text-xl font-semibold text-gray-800 mb-1">{{ __('Homepage Featured Doctors') }}</h4>
            <p class="text-sm text-gray-500 mb-0">{{ __('Select which doctors appear on the homepage, how many appear, and in what order.') }}</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ __('Selected') }}: <span class="font-semibold text-gray-700" data-selected-doctor-count>{{ $selectedIds->count() }}</span>
        </div>
    </div>

    <form action="{{ route('admin.sections.home.featured_doctors.update') }}" method="POST" class="bg-gray-50 border rounded-2xl p-5 space-y-5" id="homepage-featured-doctors-form">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block font-semibold mb-1">{{ __('Section Title') }}</label>
                <input type="text" name="title" value="{{ old('title', $sectionData['title'] ?? 'Open a profile, compare details, then book.') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block font-semibold mb-1">{{ __('Section Description') }}</label>
                <input type="text" name="description" value="{{ old('description', $sectionData['description'] ?? 'These are active doctor listings available for public browsing and direct request submission.') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block font-semibold mb-1">{{ __('How Many Show') }}</label>
                <input type="number" min="1" max="24" name="display_count" value="{{ $displayCount }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div>
                <label class="block font-semibold mb-2">{{ __('Available Doctors') }}</label>
                <p class="text-sm text-gray-500 mb-3">{{ __('Click Add to move a doctor into the selected list.') }}</p>
                <div class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 max-h-[520px] overflow-y-auto">
                    @foreach ($doctors as $doctor)
                        @php
                            $ownerName = $doctor->owner?->hospital_name ?: trim(($doctor->owner?->first_name ?? '') . ' ' . ($doctor->owner?->last_name ?? '')) ?: __('Hospital not found');
                            $doctorPhoto = $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png');
                        @endphp
                        <div
                            class="flex items-start gap-3 rounded-xl border border-slate-200 p-3"
                            data-doctor-option
                            data-doctor-id="{{ $doctor->id }}"
                            data-selected="{{ $selectedIds->contains((int) $doctor->id) ? 'true' : 'false' }}"
                            data-name="{{ e($doctor->name) }}"
                            data-owner="{{ e($ownerName) }}"
                            data-speciality="{{ e($doctor->speciality ?: ($doctor->department?->name ?? __('Speciality not added'))) }}"
                            data-image="{{ $doctorPhoto }}"
                        >
                            <img
                                src="{{ $doctorPhoto }}"
                                alt="{{ $doctor->name }}"
                                class="w-14 h-14 rounded-xl object-cover border"
                            >
                            <div class="min-w-0 flex-1">
                                <span class="block font-semibold text-slate-800">{{ $doctor->name }}</span>
                                <span class="block text-sm text-slate-500">{{ $doctor->speciality ?: ($doctor->department?->name ?? __('Speciality not added')) }}</span>
                                <span class="block text-xs text-slate-400 mt-1">{{ $ownerName }}</span>
                            </div>
                            <button
                                type="button"
                                class="shrink-0 rounded-lg px-3 py-2 text-sm font-semibold text-white transition"
                                data-add-doctor
                                style="{{ $selectedIds->contains((int) $doctor->id) ? 'background:#94a3b8;' : 'background:#059669;' }}"
                                {{ $selectedIds->contains((int) $doctor->id) ? 'disabled' : '' }}
                            >
                                {{ $selectedIds->contains((int) $doctor->id) ? __('Added') : __('Add') }}
                            </button>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500 mt-2">{{ __('Only active doctors from approved hospital accounts are shown here.') }}</p>
            </div>

            <div>
                <label class="block font-semibold mb-2">{{ __('Selected Doctors Order') }}</label>
                <p class="text-sm text-gray-500 mb-3">{{ __('Use Up and Down to control the homepage order. Higher items appear first.') }}</p>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 min-h-[220px]">
                    <div class="space-y-3" id="selected-doctors-list">
                        @foreach ($selectedDoctors as $doctor)
                        @php
                                $ownerName = $doctor->owner?->hospital_name ?: trim(($doctor->owner?->first_name ?? '') . ' ' . ($doctor->owner?->last_name ?? '')) ?: __('Hospital not found');
                                $doctorPhoto = $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png');
                            @endphp
                            <div class="selected-doctor-item flex items-start gap-3 rounded-xl border border-slate-200 p-3" data-selected-doctor data-doctor-id="{{ $doctor->id }}">
                                <input type="hidden" name="doctor_ids[]" value="{{ $doctor->id }}">
                                <img
                                    src="{{ $doctorPhoto }}"
                                    alt="{{ $doctor->name }}"
                                    class="w-14 h-14 rounded-xl object-cover border"
                                >
                                <div class="min-w-0 flex-1">
                                    <span class="block font-semibold text-slate-800">{{ $doctor->name }}</span>
                                    <span class="block text-sm text-slate-500">{{ $doctor->speciality ?: ($doctor->department?->name ?? __('Speciality not added')) }}</span>
                                    <span class="block text-xs text-slate-400 mt-1">{{ $ownerName }}</span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-up>{{ __('Up') }}</button>
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-down>{{ __('Down') }}</button>
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-white" data-remove-doctor style="background:#dc2626;">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="selected-doctors-empty" class="px-2 py-10 text-center text-gray-500 {{ $selectedDoctors->isNotEmpty() ? 'hidden' : '' }}">
                        {{ __('No featured doctors have been selected for the homepage yet.') }}
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
                <i class="fas fa-save mr-2"></i>{{ __('Save Featured Doctors') }}
            </button>
        </div>
    </form>
</div>

<template id="selected-doctor-template">
    <div class="selected-doctor-item flex items-start gap-3 rounded-xl border border-slate-200 p-3" data-selected-doctor>
        <input type="hidden" name="doctor_ids[]">
        <img class="w-14 h-14 rounded-xl object-cover border" alt="">
        <div class="min-w-0 flex-1">
            <span class="block font-semibold text-slate-800" data-doctor-name></span>
            <span class="block text-sm text-slate-500" data-doctor-speciality></span>
            <span class="block text-xs text-slate-400 mt-1" data-doctor-owner></span>
        </div>
        <div class="flex flex-col gap-2">
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-up>{{ __('Up') }}</button>
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-down>{{ __('Down') }}</button>
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-white" data-remove-doctor style="background:#dc2626;">{{ __('Remove') }}</button>
        </div>
    </div>
</template>

<script>
    (function () {
        const form = document.getElementById('homepage-featured-doctors-form');

        if (!form) {
            return;
        }

        const selectedList = document.getElementById('selected-doctors-list');
        const emptyState = document.getElementById('selected-doctors-empty');
        const template = document.getElementById('selected-doctor-template');
        const countNode = document.querySelector('[data-selected-doctor-count]');

        const updateEmptyState = () => {
            const count = selectedList.querySelectorAll('[data-selected-doctor]').length;

            if (countNode) {
                countNode.textContent = count;
            }

            emptyState.classList.toggle('hidden', count > 0);
        };

        const setOptionState = (doctorId, selected) => {
            const option = document.querySelector(`[data-doctor-option][data-doctor-id="${doctorId}"]`);

            if (!option) {
                return;
            }

            const button = option.querySelector('[data-add-doctor]');

            option.dataset.selected = selected ? 'true' : 'false';
            button.disabled = selected;
            button.textContent = selected ? @json(__('Added')) : @json(__('Add'));
            button.style.background = selected ? '#94a3b8' : '#059669';
        };

        const buildSelectedItem = (doctor) => {
            const fragment = template.content.firstElementChild.cloneNode(true);
            fragment.dataset.doctorId = doctor.id;
            fragment.querySelector('input[name="doctor_ids[]"]').value = doctor.id;

            const image = fragment.querySelector('img');
            image.src = doctor.image;
            image.alt = doctor.name;

            fragment.querySelector('[data-doctor-name]').textContent = doctor.name;
            fragment.querySelector('[data-doctor-speciality]').textContent = doctor.speciality;
            fragment.querySelector('[data-doctor-owner]').textContent = doctor.owner;

            return fragment;
        };

        document.querySelectorAll('[data-add-doctor]').forEach((button) => {
            button.addEventListener('click', () => {
                const option = button.closest('[data-doctor-option]');
                const doctorId = option.dataset.doctorId;

                if (selectedList.querySelector(`[data-selected-doctor][data-doctor-id="${doctorId}"]`)) {
                    return;
                }

                selectedList.appendChild(buildSelectedItem({
                    id: doctorId,
                    name: option.dataset.name,
                    speciality: option.dataset.speciality,
                    owner: option.dataset.owner,
                    image: option.dataset.image,
                }));

                setOptionState(doctorId, true);
                updateEmptyState();
            });
        });

        selectedList.addEventListener('click', (event) => {
            const item = event.target.closest('[data-selected-doctor]');

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

            if (event.target.closest('[data-remove-doctor]')) {
                setOptionState(item.dataset.doctorId, false);
                item.remove();
                updateEmptyState();
            }
        });

        updateEmptyState();
    })();
</script>
