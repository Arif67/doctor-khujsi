@extends('layouts.app')

@section('title', 'Doctors Directory')

@push('styles')
<style>
    .directory-hero {
        padding: 72px 0 36px;
        background: linear-gradient(135deg, #f3fbfb 0%, #ffffff 100%);
    }

    .directory-card {
        height: 100%;
        border: 1px solid #dcefee;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 14px 30px rgba(23, 83, 88, 0.08);
    }

    .directory-card img {
        width: 100%;
        height: 260px;
        object-fit: cover;
        background: #edf7f7;
    }

    .directory-card .body {
        padding: 20px;
    }

    .directory-meta {
        color: #3d6970;
        font-size: 0.95rem;
        margin-bottom: 6px;
    }
</style>
@endpush

@section('content')
<section class="directory-hero">
    <div class="container">
        <div class="row align-items-end row-gap-3">
            <div class="col-lg-7">
                <span class="team-tag">Doctors Page</span>
                <h1 class="heading_title mb-3">Find Doctors Across Nagarpur Hospitals</h1>
                <p class="mb-0 text-muted">Browse active doctor profiles and book directly without creating a patient account.</p>
            </div>
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
                            <h3 class="h4 mb-2">{{ $doctor->name }}</h3>
                            <div class="directory-meta">{{ $doctor->speciality ?: ($doctor->department?->name ?? 'Specialist') }}</div>
                            <div class="directory-meta">{{ $doctor->owner?->hospital_name ?? 'Hospital not assigned' }}</div>
                            <div class="directory-meta">{{ $doctor->owner?->hospital_location ?? 'Location not added yet' }}</div>
                            @if ($doctor->experience)
                                <p class="text-muted mt-3 mb-3">{{ $doctor->experience }}</p>
                            @endif
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('app.doctor-profile', ['doctor' => $doctor->id, 'name' => \Illuminate\Support\Str::slug($doctor->name)]) }}" class="btn btn-outline-secondary">View Profile</a>
                                <a href="{{ route('app.booking', ['doctor' => $doctor->id]) }}" class="btn btn-info text-white">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">No approved doctor profiles are available yet.</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
