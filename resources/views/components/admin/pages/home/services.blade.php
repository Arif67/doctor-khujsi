@php
    $sectionData = $homeServicesData->data ?? [];
    $selectedIds = collect(old('service_ids', $sectionData['service_ids'] ?? []))
        ->map(fn ($id) => (int) $id)
        ->values();
    $selectedServices = $services->whereIn('id', $selectedIds)->sortBy(fn ($service) => $selectedIds->search((int) $service->id));
    $displayCount = old('display_count', $sectionData['display_count'] ?? 6);
@endphp

<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
        <div>
            <h4 class="text-xl font-semibold text-gray-800 mb-1">Homepage Services</h4>
            <p class="text-sm text-gray-500 mb-0">Homepage-e kon kon service dekhabe, koyta dekhabe, ar kon order-e dekhabe ekhane theke control korte parben.</p>
        </div>
        <div class="text-sm text-gray-500">
            Selected: <span class="font-semibold text-gray-700" data-selected-count>{{ $selectedIds->count() }}</span>
        </div>
    </div>

    <form action="{{ route('admin.sections.home.services.update') }}" method="POST" class="bg-gray-50 border rounded-2xl p-5 space-y-5" id="homepage-services-form">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block font-semibold mb-1">Section Title</label>
                <input type="text" name="title" value="{{ old('title', $sectionData['title'] ?? 'Explore care areas before choosing a doctor.') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block font-semibold mb-1">Section Description</label>
                <input type="text" name="description" value="{{ old('description', $sectionData['description'] ?? 'Each category helps patients narrow down which doctor profile to open first.') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block font-semibold mb-1">How Many Show</label>
                <input type="number" min="1" max="24" name="display_count" value="{{ $displayCount }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div>
                <label class="block font-semibold mb-2">Available Services</label>
                <p class="text-sm text-gray-500 mb-3">`Add` click kore service selected list-e nin.</p>
                <div class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 max-h-[520px] overflow-y-auto">
                    @foreach ($services as $service)
                        @php
                            $ownerName = $service->owner?->hospital_name ?: trim(($service->owner?->first_name ?? '') . ' ' . ($service->owner?->last_name ?? '')) ?: 'Hospital not found';
                        @endphp
                        <div
                            class="flex items-start gap-3 rounded-xl border border-slate-200 p-3"
                            data-service-option
                            data-service-id="{{ $service->id }}"
                            data-selected="{{ $selectedIds->contains((int) $service->id) ? 'true' : 'false' }}"
                            data-title="{{ e($service->title) }}"
                            data-owner="{{ e($ownerName) }}"
                            data-image="{{ $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg') }}"
                        >
                            <img
                                src="{{ $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg') }}"
                                alt="{{ $service->title }}"
                                class="w-14 h-14 rounded-xl object-cover border"
                            >
                            <div class="min-w-0 flex-1">
                                <span class="block font-semibold text-slate-800">{{ $service->title }}</span>
                                <span class="block text-sm text-slate-500">{{ $ownerName }}</span>
                            </div>
                            <button
                                type="button"
                                class="shrink-0 rounded-lg px-3 py-2 text-sm font-semibold text-white transition"
                                data-add-service
                                style="{{ $selectedIds->contains((int) $service->id) ? 'background:#94a3b8;' : 'background:#059669;' }}"
                                {{ $selectedIds->contains((int) $service->id) ? 'disabled' : '' }}
                            >
                                {{ $selectedIds->contains((int) $service->id) ? 'Added' : 'Add' }}
                            </button>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500 mt-2">Sudhu approved hospital-er service list ekhane dekhano hocche.</p>
            </div>

            <div>
                <label class="block font-semibold mb-2">Selected Services Order</label>
                <p class="text-sm text-gray-500 mb-3">`Up` / `Down` diye homepage-e service order control korun. Uporer gula age dekhabe.</p>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 min-h-[220px]">
                    <div class="space-y-3" id="selected-services-list">
                        @foreach ($selectedServices as $service)
                            @php
                                $ownerName = $service->owner?->hospital_name ?: trim(($service->owner?->first_name ?? '') . ' ' . ($service->owner?->last_name ?? '')) ?: 'Hospital not found';
                            @endphp
                            <div class="selected-service-item flex items-start gap-3 rounded-xl border border-slate-200 p-3" data-selected-service data-service-id="{{ $service->id }}">
                                <input type="hidden" name="service_ids[]" value="{{ $service->id }}">
                                <img
                                    src="{{ $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg') }}"
                                    alt="{{ $service->title }}"
                                    class="w-14 h-14 rounded-xl object-cover border"
                                >
                                <div class="min-w-0 flex-1">
                                    <span class="block font-semibold text-slate-800">{{ $service->title }}</span>
                                    <span class="block text-sm text-slate-500">{{ $ownerName }}</span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-up>Up</button>
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-down>Down</button>
                                    <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-white" data-remove-service style="background:#dc2626;">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="selected-services-empty" class="px-2 py-10 text-center text-gray-500 {{ $selectedServices->isNotEmpty() ? 'hidden' : '' }}">
                        Ekhono homepage-er jonno kono service select kora hoyni.
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
                <i class="fas fa-save mr-2"></i>Save Homepage Services
            </button>
        </div>
    </form>

    <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
        <div class="px-5 py-4 border-b bg-slate-50">
            <h5 class="text-lg font-semibold text-gray-800 mb-1">Current Homepage Services</h5>
            <p class="text-sm text-gray-500 mb-0">Homepage section-e maximum {{ $displayCount }} ta service dekhabe.</p>
        </div>

        @if ($selectedServices->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 p-5">
                @foreach ($selectedServices->take((int) $displayCount) as $service)
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="flex items-start gap-3">
                            <img
                                src="{{ $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg') }}"
                                alt="{{ $service->title }}"
                                class="w-16 h-16 rounded-xl object-cover border"
                            >
                            <div>
                                <div class="font-semibold text-slate-800">{{ $service->title }}</div>
                                <div class="text-sm text-slate-500">
                                    {{ $service->owner?->hospital_name ?: trim(($service->owner?->first_name ?? '') . ' ' . ($service->owner?->last_name ?? '')) ?: 'Hospital not found' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-5 py-10 text-center text-gray-500">
                Ekhono homepage-er jonno kono service select kora hoyni.
            </div>
        @endif
    </div>
</div>

<template id="selected-service-template">
    <div class="selected-service-item flex items-start gap-3 rounded-xl border border-slate-200 p-3" data-selected-service>
        <input type="hidden" name="service_ids[]">
        <img class="w-14 h-14 rounded-xl object-cover border" alt="">
        <div class="min-w-0 flex-1">
            <span class="block font-semibold text-slate-800" data-service-title></span>
            <span class="block text-sm text-slate-500" data-service-owner></span>
        </div>
        <div class="flex flex-col gap-2">
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-up>Up</button>
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 border border-slate-300" data-move-down>Down</button>
            <button type="button" class="rounded-lg px-3 py-2 text-xs font-semibold text-white" data-remove-service style="background:#dc2626;">Remove</button>
        </div>
    </div>
</template>

<script>
    (function () {
        const form = document.getElementById('homepage-services-form');

        if (!form) {
            return;
        }

        const selectedList = document.getElementById('selected-services-list');
        const emptyState = document.getElementById('selected-services-empty');
        const template = document.getElementById('selected-service-template');
        const countNode = document.querySelector('[data-selected-count]');

        const updateEmptyState = () => {
            const count = selectedList.querySelectorAll('[data-selected-service]').length;

            if (countNode) {
                countNode.textContent = count;
            }

            emptyState.classList.toggle('hidden', count > 0);
        };

        const setOptionState = (serviceId, selected) => {
            const option = document.querySelector(`[data-service-option][data-service-id="${serviceId}"]`);

            if (!option) {
                return;
            }

            const button = option.querySelector('[data-add-service]');

            option.dataset.selected = selected ? 'true' : 'false';
            button.disabled = selected;
            button.textContent = selected ? 'Added' : 'Add';
            button.style.background = selected ? '#94a3b8' : '#059669';
        };

        const buildSelectedItem = (service) => {
            const fragment = template.content.firstElementChild.cloneNode(true);
            fragment.dataset.serviceId = service.id;
            fragment.querySelector('input[name="service_ids[]"]').value = service.id;

            const image = fragment.querySelector('img');
            image.src = service.image;
            image.alt = service.title;

            fragment.querySelector('[data-service-title]').textContent = service.title;
            fragment.querySelector('[data-service-owner]').textContent = service.owner;

            return fragment;
        };

        document.querySelectorAll('[data-add-service]').forEach((button) => {
            button.addEventListener('click', () => {
                const option = button.closest('[data-service-option]');
                const serviceId = option.dataset.serviceId;

                if (selectedList.querySelector(`[data-selected-service][data-service-id="${serviceId}"]`)) {
                    return;
                }

                selectedList.appendChild(buildSelectedItem({
                    id: serviceId,
                    title: option.dataset.title,
                    owner: option.dataset.owner,
                    image: option.dataset.image,
                }));

                setOptionState(serviceId, true);
                updateEmptyState();
            });
        });

        selectedList.addEventListener('click', (event) => {
            const item = event.target.closest('[data-selected-service]');

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

            if (event.target.closest('[data-remove-service]')) {
                setOptionState(item.dataset.serviceId, false);
                item.remove();
                updateEmptyState();
            }
        });

        updateEmptyState();
    })();
</script>
