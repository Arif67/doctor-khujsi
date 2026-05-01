@extends('layouts.app')

@section('title', __('Find Doctors'))

@push('styles')
<style>
    .directory-hero {
        padding: 72px 0 36px;
    }

    .directory-card {
        height: 100%;
        border: 1px solid rgba(21, 58, 63, 0.08);
        border-radius: 28px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 18px 40px rgba(23, 83, 88, 0.08);
    }

    .directory-card img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        background: #edf7f7;
    }

    .directory-card .body {
        padding: 24px;
    }

    .directory-filter {
        margin-top: 28px;
        padding: 24px;
        border-radius: 24px;
        background: linear-gradient(145deg, rgba(218, 244, 246, 0.62), rgba(255, 255, 255, 0.96));
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .directory-filter .form-control,
    .directory-filter .form-select {
        border-radius: 14px;
        padding: 13px 15px;
        border: 1px solid #d9e8e8;
    }

    .directory-meta {
        color: var(--brand-muted);
        font-size: 0.95rem;
        margin-bottom: 6px;
    }

    .directory-chip {
        display: inline-flex;
        margin-bottom: 16px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(244, 162, 97, 0.16);
        color: #9a5b1e;
        font-size: 0.82rem;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
@php
    $doctorLocation = static function ($doctor) {
        return collect([
            $doctor->area ?: $doctor->owner?->area,
            $doctor->thana ?: $doctor->owner?->thana,
            $doctor->district ?: $doctor->owner?->district,
        ])->filter()->implode(', ');
    };
@endphp
<section class="directory-hero">
    <div class="container">
        <div class="surface-card p-4 p-lg-5">
            <div class="row align-items-end row-gap-3">
                <div class="col-lg-7">
                    <span class="section-eyebrow mb-3">{{ __('Doctor directory') }}</span>
                    <h1 class="section-title mb-3">{{ __('Find doctors by specialty, hospital, and profile fit.') }}</h1>
                    <p class="mb-0 muted-copy">{{ __('Browse active doctor profiles and book directly without creating a patient account. The focus here is discovery first, friction later.') }}</p>
                </div>
                <div class="col-lg-5">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="finder-stat">
                                <strong>{{ $doctores->count() }}</strong>
                                <span class="muted-copy">{{ __('Matching doctors') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="finder-stat">
                                <strong>{{ $doctores->pluck('owner.hospital_name')->filter()->unique()->count() }}</strong>
                                <span class="muted-copy">{{ __('Hospitals') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('app.specialists') }}" method="GET" class="directory-filter">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6 col-lg-3">
                        <label for="department" class="form-label">{{ __('Department') }}</label>
                        <select name="department" id="department" class="form-select">
                            <option value="">{{ __('All departments') }}</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @selected(($filters['department'] ?? '') == $department->id)>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="district_id" class="form-label">{{ __('Jila') }}</label>
                        <select name="district_id" id="district_id" class="form-select" data-selected="{{ $filters['district_id'] ?? '' }}">
                            <option value="">{{ __('All jila') }}</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" @selected(($filters['district_id'] ?? '') == $district->id)>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <label for="thana_id" class="form-label">{{ __('Thana') }}</label>
                        <select name="thana_id" id="thana_id" class="form-select" data-selected="{{ $filters['thana_id'] ?? '' }}" disabled>
                            <option value="">{{ __('All thana') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <label for="area_id" class="form-label">{{ __('Area') }}</label>
                        <select name="area_id" id="area_id" class="form-select" data-selected="{{ $filters['area_id'] ?? '' }}" disabled>
                            <option value="">{{ __('All area') }}</option>
                        </select>
                    </div>
                    <div class="col-lg-2 d-flex gap-2">
                        <button type="submit" class="btn-brand-primary w-100">{{ __('Filter') }}</button>
                        <a href="{{ route('app.specialists') }}" class="btn-brand-secondary w-100 text-center">{{ __('Reset') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse ($doctores as $doctor)
                <div class="col-md-6 col-xl-4">
                    <div class="directory-card">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png') }}" alt="{{ $doctor->name }}">
                        <div class="body">
                            <div class="directory-chip">{{ $doctor->department?->name ?? __('Specialist Department') }}</div>
                            <h3 class="h4 mb-2">{{ $doctor->name }}</h3>
                            <div class="directory-meta">{{ $doctor->speciality ?: ($doctor->department?->name ?? __('Specialist')) }}</div>
                            <div class="directory-meta">{{ $doctor->owner?->hospital_name ?? __('Hospital not assigned') }}</div>
                            <div class="directory-meta">{{ $doctorLocation($doctor) ?: ($doctor->owner?->hospital_location ?? __('Location not added yet')) }}</div>
                            @if ($doctor->experience)
                                <p class="text-muted mt-3 mb-3">{{ $doctor->experience }}</p>
                            @endif
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('app.doctor-profile', ['doctor' => $doctor->id, 'name' => \Illuminate\Support\Str::slug($doctor->name)]) }}" class="btn-brand-secondary">{{ __('View Profile') }}</a>
                                <a href="{{ route('app.booking', ['doctor' => $doctor->id]) }}" class="btn-brand-primary">{{ __('Book Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">{{ __('No approved doctor profiles are available yet.') }}</div>
                </div>
            @endforelse
        </div>
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
    })();
</script>
@endpush
