@extends('layouts.app')

@section('title', __('Hospitals'))

@push('styles')
<style>
    .hospital-filter {
        margin-top: 28px;
        padding: 24px;
        border-radius: 24px;
        background: linear-gradient(145deg, rgba(218, 244, 246, 0.62), rgba(255, 255, 255, 0.96));
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .hospital-filter .form-select {
        border-radius: 14px;
        padding: 13px 15px;
        border: 1px solid #d9e8e8;
    }

    .hospital-filter .form-control {
        border-radius: 14px;
        padding: 13px 15px;
        border: 1px solid #d9e8e8;
    }

    .hospital-card {
        position: relative;
        overflow: hidden;
    }

    .hospital-card::after {
        content: "";
        position: absolute;
        inset: auto -50px -70px auto;
        width: 160px;
        height: 160px;
        background: radial-gradient(circle, rgba(18, 124, 138, 0.14), transparent 68%);
    }

    .hospital-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(18, 124, 138, 0.09);
        color: var(--brand-primary-dark);
        font-size: 0.82rem;
        font-weight: 700;
    }

    .hospital-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        color: var(--brand-primary-dark);
        font-weight: 700;
    }

    .hospital-cover {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 22px;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }
</style>
@endpush

@section('content')
<section class="py-5">
    <div class="container">
        <div class="surface-card p-4 p-lg-5 mb-4">
            <span class="section-eyebrow mb-3">{{ __('Hospitals') }}</span>
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <h1 class="section-title mb-3">{{ __('Browse approved hospitals and see what each one offers.') }}</h1>
                    <p class="muted-copy mb-0">{{ __('Open a hospital profile to check service list, doctor count, privacy policy, and summary details before choosing a doctor.') }}</p>
                </div>
                <div class="col-lg-4">
                    <div class="surface-card p-4 h-100">
                        <div class="text-uppercase small muted-copy mb-2">{{ __('Approved Hospitals') }}</div>
                        <div style="font-size: 2.5rem; font-weight: 800;">{{ $hospitals->count() }}</div>
                    </div>
                </div>
            </div>
            <form action="{{ route('app.hospitals') }}" method="GET" class="hospital-filter">
                <div class="row g-3 align-items-end">
                    <div class="col-md-12 col-lg-4">
                        <label for="search" class="form-label">{{ __('Hospital Name') }}</label>
                        <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="{{ __('Search by hospital name') }}">
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <label for="district_id" class="form-label">{{ __('Jila') }}</label>
                        <select name="district_id" id="district_id" class="form-select" data-selected="{{ $filters['district_id'] ?? '' }}">
                            <option value="">{{ __('All jila') }}</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" @selected(($filters['district_id'] ?? '') == $district->id)>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <label for="thana_id" class="form-label">{{ __('Thana') }}</label>
                        <select name="thana_id" id="thana_id" class="form-select" data-selected="{{ $filters['thana_id'] ?? '' }}" disabled>
                            <option value="">{{ __('All thana') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <label for="area_id" class="form-label">{{ __('Area') }}</label>
                        <select name="area_id" id="area_id" class="form-select" data-selected="{{ $filters['area_id'] ?? '' }}" disabled>
                            <option value="">{{ __('All area') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <label for="sort" class="form-label">{{ __('Sort By') }}</label>
                        <select name="sort" id="sort" class="form-select">
                            <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>{{ __('Latest') }}</option>
                            <option value="doctors_desc" @selected(($filters['sort'] ?? '') === 'doctors_desc')>{{ __('Most Doctors') }}</option>
                            <option value="services_desc" @selected(($filters['sort'] ?? '') === 'services_desc')>{{ __('Most Services') }}</option>
                            <option value="departments_desc" @selected(($filters['sort'] ?? '') === 'departments_desc')>{{ __('Most Departments') }}</option>
                            <option value="name_asc" @selected(($filters['sort'] ?? '') === 'name_asc')>{{ __('Name A-Z') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-1 d-flex gap-2">
                        <button type="submit" class="btn-brand-primary w-100">{{ __('Filter') }}</button>
                        <a href="{{ route('app.hospitals') }}" class="btn-brand-secondary w-100 text-center">{{ __('Reset') }}</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="row g-4">
            @forelse($hospitals as $hospital)
                <div class="col-md-6 col-xl-4">
                    <div class="surface-card h-100 p-4 hospital-card">
                        <img src="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}" alt="{{ $hospital->hospital_name }}" class="hospital-cover mb-4">
                        <div class="hospital-badge mb-3">{{ __('Verified Hospital') }}</div>
                        <h3 class="h4 mb-2">{{ $hospital->hospital_name }}</h3>
                        <p class="muted-copy mb-3">{{ $hospital->hospital_location ?: $hospital->address ?: __('Location not added yet') }}</p>
                        <div class="hospital-stats mb-4">
                            <span><i class="fas fa-user-md"></i> {{ $hospital->doctors_count }} {{ __('Doctors') }}</span>
                            <span><i class="fas fa-briefcase-medical"></i> {{ $hospital->services_count }} {{ __('Services') }}</span>
                            <span><i class="fas fa-sitemap"></i> {{ $hospital->departments_count }} {{ __('Departments') }}</span>
                        </div>
                        <p class="muted-copy mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($hospital->about_hospital ?: __('Hospital details will be updated soon.')), 120) }}</p>
                        <a href="{{ route('app.hospitals.show', ['hospital' => $hospital->id, 'slug' => \Illuminate\Support\Str::slug($hospital->hospital_name ?: $hospital->name)]) }}" class="btn-brand-primary">{{ __('View Details') }}</a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">{{ __('No approved hospitals found right now.') }}</div>
                </div>
            @endforelse
        </div>

        @if ($hospitals->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $hospitals->onEachSide(1)->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function () {
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
            fillSelect(thanaSelect, [], @json(__('All thana')), '');
            fillSelect(areaSelect, [], @json(__('All area')), '');

            if (!districtId) {
                return;
            }

            const response = await fetch(`{{ url('/locations/districts') }}/${districtId}/thanas`);
            const thanas = await response.json();

            fillSelect(thanaSelect, thanas, @json(__('All thana')), selectedThanaId);
        }

        async function loadAreas(thanaId, selectedAreaId = '') {
            fillSelect(areaSelect, [], @json(__('All area')), '');

            if (!thanaId) {
                return;
            }

            const response = await fetch(`{{ url('/locations/thanas') }}/${thanaId}/areas`);
            const areas = await response.json();

            fillSelect(areaSelect, areas, @json(__('All area')), selectedAreaId);
        }

        districtSelect?.addEventListener('change', () => loadThanas(districtSelect.value));
        thanaSelect?.addEventListener('change', () => loadAreas(thanaSelect.value));

        const selectedDistrict = districtSelect?.dataset.selected;
        const selectedThana = thanaSelect?.dataset.selected;
        const selectedArea = areaSelect?.dataset.selected;

        if (selectedDistrict) {
            loadThanas(selectedDistrict, selectedThana).then(() => {
                if (selectedThana) {
                    loadAreas(selectedThana, selectedArea);
                }
            });
        }
    })();
</script>
@endpush
