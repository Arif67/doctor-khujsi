@extends('layouts.app')

@section('title', __('Book Doctor'))

@push('styles')
<style>
    .booking-shell {
        padding: 72px 0;
    }

    .booking-panel {
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 18px 50px rgba(20, 76, 81, 0.09);
        overflow: hidden;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .booking-side {
        height: 100%;
        min-height: 100%;
        padding: 36px;
        background: linear-gradient(145deg, #daf4f6 0%, #effafb 100%);
    }

    .booking-side img {
        width: 100%;
        max-height: 340px;
        object-fit: cover;
        border-radius: 22px;
        margin-bottom: 24px;
        background: #fff;
    }

    .booking-form-wrap {
        padding: 36px;
    }

    .booking-form-wrap .form-control,
    .booking-form-wrap .form-select,
    .booking-form-wrap textarea {
        border-radius: 12px;
        padding: 14px 16px;
        border: 1px solid #d9e8e8;
    }

    .booking-side-facts {
        display: grid;
        gap: 12px;
        margin-top: 20px;
    }

    .booking-selected-note {
        padding: 16px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(21, 58, 63, 0.08);
        margin-bottom: 12px;
    }

    .booking-dept-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(244, 162, 97, 0.16);
        color: #9a5b1e;
        font-size: 0.76rem;
        font-weight: 700;
        margin-top: 8px;
    }

    .booking-fact {
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.76);
    }

    .booking-submit {
        border: none;
    }

    .schedule-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .schedule-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(18, 124, 138, 0.08);
        color: var(--brand-primary-dark);
        font-size: 0.76rem;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
@php
    $doctorLocation = static function ($doctor) {
        return collect([
            $doctor?->area ?: $doctor?->owner?->area,
            $doctor?->thana ?: $doctor?->owner?->thana,
            $doctor?->district ?: $doctor?->owner?->district,
        ])->filter()->implode(', ');
    };
@endphp
<section class="booking-shell">
    <div class="container">
        <div class="booking-panel">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="booking-side">
                        @php($cardDoctor = $selectedDoctor ?? $doctors->first())
                        <img id="booking-doctor-photo" src="{{ $cardDoctor?->photo ? asset('storage/' . $cardDoctor->photo) : asset('assets/img/default.png') }}" alt="{{ $cardDoctor?->name ?? __('Doctor') }}">
                        <span class="section-eyebrow">{{ __('Simple booking') }}</span>
                        <h1 class="section-title h2 mt-3 mb-3">{{ __('Send a doctor booking request without extra steps.') }}</h1>
                        <p class="muted-copy mb-3">{{ __('Pick a doctor, add patient info, and the hospital receives the request directly.') }}</p>
                        @if($cardDoctor)
                            <div class="booking-selected-note">
                                <div class="small text-uppercase muted-copy mb-1">{{ __('Selected doctor') }}</div>
                                <div class="h5 mb-1">{{ $cardDoctor->name }}</div>
                                <div class="muted-copy">{{ $cardDoctor->speciality ?: ($cardDoctor->department?->name ?? __('Specialist Doctor')) }}</div>
                                <div class="booking-dept-badge">
                                    {{ $selectedDepartment?->name ?: ($cardDoctor->department?->name ?? __('Department not assigned')) }}
                                </div>
                                <div class="muted-copy mt-2">{{ __('You can change this doctor from the dropdown on the right.') }}</div>
                            </div>
                        @endif
                        <div class="booking-side-facts">
                            <div class="booking-fact">
                                <strong id="booking-doctor-name">{{ $cardDoctor?->name ?? __('Select a doctor') }}</strong>
                                <div class="muted-copy" id="booking-doctor-speciality">{{ $cardDoctor?->speciality ?: ($cardDoctor?->department?->name ?? __('Specialist Doctor')) }}</div>
                                <div class="booking-dept-badge" id="booking-doctor-department">{{ $selectedDepartment?->name ?: ($cardDoctor?->department?->name ?? __('Department not assigned')) }}</div>
                            </div>
                            <div class="booking-fact">
                                <strong>{{ __('Hospital') }}</strong>
                                <div class="muted-copy" id="booking-doctor-hospital">{{ $cardDoctor?->owner?->hospital_name ?? __('Hospital not assigned') }}</div>
                            </div>
                            <div class="booking-fact">
                                <strong>{{ __('Location') }}</strong>
                                <div class="muted-copy" id="booking-doctor-location">{{ $doctorLocation($cardDoctor) ?: ($cardDoctor?->owner?->hospital_location ?? __('Location not available')) }}</div>
                            </div>
                            <div class="booking-fact">
                                <strong>{{ __('Schedule') }}</strong>
                                @if($cardDoctor && !empty($cardDoctor->shifts))
                                    <div class="schedule-pills mt-2">
                                        @foreach($cardDoctor->shifts as $shift)
                                            <span class="schedule-pill">{{ $shift['day'] ?? __('Day') }}: {{ $shift['time'] ?? __('Time') }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="muted-copy">{{ __('Schedule not available yet.') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="booking-form-wrap">
                        <h2 class="h3 mb-3">{{ __('Send Booking Request') }}</h2>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('app.booking.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="doctor_id" class="form-label">{{ __('Doctor') }}</label>
                                    <select id="doctor_id" name="doctor_id" class="form-select" required>
                                        <option value="">{{ __('Select doctor') }}</option>
                                        @foreach ($doctors as $doctor)
                                        <option
                                                value="{{ $doctor->id }}"
                                                data-name="{{ $doctor->name }}"
                                                data-speciality="{{ $doctor->speciality ?: ($doctor->department?->name ?? __('Specialist Doctor')) }}"
                                                data-department="{{ $doctor->department?->name ?? __('Department not assigned') }}"
                                                data-hospital="{{ $doctor->owner?->hospital_name ?? __('Hospital not assigned') }}"
                                                data-location="{{ $doctorLocation($doctor) ?: ($doctor->owner?->hospital_location ?? __('Location not available')) }}"
                                                data-photo="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png') }}"
                                                @selected(old('doctor_id', $selectedDoctor?->id) == $doctor->id)>
                                                {{ $doctor->name }} - {{ $doctor->owner?->hospital_name ?? __('Hospital') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="patient_name" class="form-label">{{ __('Patient Name') }}</label>
                                    <input id="patient_name" name="patient_name" type="text" class="form-control" value="{{ old('patient_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="patient_phone" class="form-label">{{ __('Phone Number') }}</label>
                                    <input id="patient_phone" name="patient_phone" type="text" class="form-control" value="{{ old('patient_phone') }}" required>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="patient_email" class="form-label">Email Address</label>
                                    <input id="patient_email" name="patient_email" type="email" class="form-control" value="{{ old('patient_email') }}" placeholder="Optional, for status updates">
                                </div> -->
                                <div class="col-md-6">
                                    <label for="patient_age" class="form-label">{{ __('Age') }}</label>
                                    <input id="patient_age" name="patient_age" type="number" min="0" max="120" class="form-control" value="{{ old('patient_age') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">{{ __('Short Info') }}</label>
                                    <textarea id="notes" name="notes" class="form-control" rows="4" placeholder="{{ __('Optional notes about the patient or problem') }}">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn-brand-primary booking-submit mt-4 px-4 py-3">{{ __('Book Now') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(function () {
        const doctorSelect = $('#doctor_id');

        function syncDoctorCard() {
            const selected = doctorSelect.find(':selected');

            if (!selected.val()) {
                return;
            }

            $('#booking-doctor-name').text(selected.data('name'));
            $('#booking-doctor-speciality').text(selected.data('speciality'));
            $('#booking-doctor-department').text(selected.data('department'));
            $('#booking-doctor-hospital').text(selected.data('hospital'));
            $('#booking-doctor-location').text(selected.data('location'));
            $('#booking-doctor-photo').attr('src', selected.data('photo'));
            $('#booking-doctor-photo').attr('alt', selected.data('name'));
        }

        doctorSelect.on('change', syncDoctorCard);
        syncDoctorCard();
    });
</script>
@endpush
