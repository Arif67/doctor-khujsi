@extends('layouts.app')

@section('title', 'Book Doctor')

@push('styles')
<style>
    .booking-shell {
        padding: 72px 0;
        background: linear-gradient(180deg, #f7fbfb 0%, #ffffff 100%);
    }

    .booking-panel {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 18px 50px rgba(20, 76, 81, 0.09);
        overflow: hidden;
    }

    .booking-side {
        height: 100%;
        min-height: 100%;
        padding: 36px;
        background: linear-gradient(145deg, #daf4f6 0%, #effafb 100%);
    }

    .booking-side img {
        width: 100%;
        max-height: 320px;
        object-fit: cover;
        border-radius: 18px;
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
</style>
@endpush

@section('content')
<section class="booking-shell">
    <div class="container">
        <div class="booking-panel">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="booking-side">
                        @php($cardDoctor = $selectedDoctor ?? $doctors->first())
                        <img src="{{ $cardDoctor?->photo ? asset('storage/' . $cardDoctor->photo) : asset('assets/img/default.png') }}" alt="{{ $cardDoctor?->name ?? 'Doctor' }}">
                        <span class="team-tag">Simple Booking</span>
                        <h1 class="heading_title mt-3 mb-3">Book With A Doctor</h1>
                        <p class="text-muted mb-3">No patient login required. Submit your basic details and the selected hospital will receive your request.</p>
                        @if ($cardDoctor)
                            <div class="mb-2"><strong>Doctor:</strong> {{ $cardDoctor->name }}</div>
                            <div class="mb-2"><strong>Speciality:</strong> {{ $cardDoctor->speciality ?: ($cardDoctor->department?->name ?? 'Specialist') }}</div>
                            <div class="mb-0"><strong>Hospital:</strong> {{ $cardDoctor->owner?->hospital_name ?? 'Hospital not assigned' }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="booking-form-wrap">
                        <h2 class="h3 mb-3">Send Booking Request</h2>

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
                                    <label for="doctor_id" class="form-label">Doctor</label>
                                    <select id="doctor_id" name="doctor_id" class="form-select" required>
                                        <option value="">Select doctor</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" @selected(old('doctor_id', $selectedDoctor?->id) == $doctor->id)>
                                                {{ $doctor->name }} - {{ $doctor->owner?->hospital_name ?? 'Hospital' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="patient_name" class="form-label">Patient Name</label>
                                    <input id="patient_name" name="patient_name" type="text" class="form-control" value="{{ old('patient_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="patient_phone" class="form-label">Phone Number</label>
                                    <input id="patient_phone" name="patient_phone" type="text" class="form-control" value="{{ old('patient_phone') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="patient_email" class="form-label">Email Address</label>
                                    <input id="patient_email" name="patient_email" type="email" class="form-control" value="{{ old('patient_email') }}" placeholder="Optional, for status updates">
                                </div>
                                <div class="col-md-6">
                                    <label for="patient_age" class="form-label">Age</label>
                                    <input id="patient_age" name="patient_age" type="number" min="0" max="120" class="form-control" value="{{ old('patient_age') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">Short Info</label>
                                    <textarea id="notes" name="notes" class="form-control" rows="4" placeholder="Optional notes about the patient or problem">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info text-white mt-4 px-4 py-3">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
