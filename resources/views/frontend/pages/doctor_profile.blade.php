@extends('layouts.app')

@section('title', 'Doctor Profile')

@push('styles')
    <style>
        .doctor-profile-shell {
            padding: 64px 0;
        }

        .doctor-hero-card,
        .doctor-sidebar-card,
        .doctor-detail-card {
            border-radius: 28px;
            background: #fff;
            border: 1px solid rgba(21, 58, 63, 0.08);
            box-shadow: 0 18px 42px rgba(15, 55, 60, 0.08);
        }

        .doctor-hero-card {
            padding: 28px;
        }

        .doctor-profile-media {
            position: relative;
        }

        .doctor-profile-media img {
            width: 100%;
            height: 440px;
            object-fit: cover;
            border-radius: 24px;
            background: #edf6f7;
        }

        .doctor-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(244, 162, 97, 0.14);
            color: #9a5b1e;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .doctor-meta-list {
            display: grid;
            gap: 14px;
            margin-top: 24px;
        }

        .doctor-meta-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 18px;
            background: #f8fbfb;
        }

        .doctor-meta-item i {
            color: var(--brand-primary);
            font-size: 1.1rem;
        }

        .doctor-sidebar-card,
        .doctor-detail-card {
            padding: 28px;
        }

        .doctor-detail-card + .doctor-detail-card,
        .doctor-sidebar-card + .doctor-sidebar-card {
            margin-top: 24px;
        }

        .social-icons a {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(18, 124, 138, 0.1);
            color: var(--brand-primary);
            margin-right: 10px;
            text-decoration: none;
        }

        .fav-icon {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 46px;
            height: 46px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.94);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-title {
            font-family: "Sora", sans-serif;
            font-size: 1.4rem;
            margin-bottom: 18px;
        }

        .doctor-list-stack {
            display: grid;
            gap: 14px;
        }

        .doctor-list-item {
            padding: 16px 18px;
            border-radius: 18px;
            background: #f8fbfb;
        }

        .doctor-list-item strong {
            display: block;
            margin-bottom: 4px;
        }

        @media only screen and (max-width: 600px){
            .doctor-profile-media img {
                height: 320px;
            }
        }
    </style>
@endpush

@section('content')
@php
    $doctorLocation = collect([
        $doctor->area ?: $doctor->owner?->area,
        $doctor->thana ?: $doctor->owner?->thana,
        $doctor->district ?: $doctor->owner?->district,
    ])->filter()->implode(', ');
    $socialLinks = collect($doctor->social_links)->filter(fn ($social) => filled(data_get($social, 'url')));
    $shifts = collect($doctor->shifts)->filter(fn ($shift) => filled(data_get($shift, 'day')) || filled(data_get($shift, 'start_time')) || filled(data_get($shift, 'end_time')));
    $educations = collect($doctor->educations)->filter(fn ($education) => filled(data_get($education, 'title')) || filled(data_get($education, 'details')));
@endphp
<section class="doctor-profile-shell" id="doctor_profile_section">
    <div class="container">
        <div class="doctor-hero-card mb-4">
            <div class="row align-items-center row-gap-4">
                <div class="col-lg-7">
                    <span class="section-eyebrow mb-3">{{ __('Doctor profile') }}</span>
                    <span class="doctor-pill mb-3">{{ $doctor->department?->name ?? __('Specialist Department') }}</span>
                    <h1 class="section-title mb-3">{{ $doctor->name }}</h1>
                    <p class="muted-copy fs-5 mb-0">{{ $doctor->speciality ?: __('Specialist Doctor') }}</p>
                    <div class="doctor-meta-list">
                        <div class="doctor-meta-item">
                            <i class="fas fa-hospital"></i>
                            <div>
                                <strong>{{ $doctor->owner?->hospital_name ?? __('Hospital not assigned') }}</strong>
                                <div class="muted-copy">{{ __('Current hospital or clinic') }}</div>
                            </div>
                        </div>
                        <div class="doctor-meta-item">
                            <i class="fas fa-location-dot"></i>
                            <div>
                                <strong>{{ $doctorLocation ?: ($doctor->owner?->hospital_location ?? __('Location not added yet')) }}</strong>
                                <div class="muted-copy">{{ __('Practice location') }}</div>
                            </div>
                        </div>
                        <div class="doctor-meta-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>{{ $doctor->phone ?: __('Phone not available') }}</strong>
                                <div class="muted-copy">{{ __('Primary contact number') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="social-icons mt-4">
                        @foreach($socialLinks as $social)
                            <a href="{{ data_get($social, 'url') }}" target="_blank" rel="noopener noreferrer">
                                {!! data_get($social, 'platform', '<i class="fas fa-link"></i>') !!}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="doctor-profile-media">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png') }}" alt="{{ $doctor->name }}">
                        <div class="fav-icon">
                            <button type="button"
                                    class="btn btn-link p-0 border-0 bg-transparent fav-btn"
                                    data-doctor="{{ $doctor->id }}"
                                    data-auth="{{ auth()->check() ? '1' : '0' }}"
                                    data-roles="{{ auth()->check() ? auth()->user()->getRoleNames()->first() : '' }}">
                                <i class="fas fa-heart {{ auth()->check() && auth()->user()->favorites && auth()->user()->favorites->contains($doctor->id) ? 'text-danger' : '' }}"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-gap-4">
            <div class="col-lg-4">
                <div class="doctor-sidebar-card">
                    <div class="detail-title">{{ __('Quick booking') }}</div>
                    <p class="muted-copy">{{ __('Send a request directly for this doctor without creating a patient account.') }}</p>
                    <div class="doctor-list-stack">
                        <div class="doctor-list-item">
                            <strong>{{ __('Hospital') }}</strong>
                            <span class="muted-copy">{{ $doctor->owner?->hospital_name ?? __('Hospital not assigned') }}</span>
                        </div>
                        <div class="doctor-list-item">
                            <strong>{{ __('Department') }}</strong>
                            <span class="muted-copy">{{ $doctor->department?->name ?? __('Department not assigned') }}</span>
                        </div>
                        <div class="doctor-list-item">
                            <strong>{{ __('Speciality') }}</strong>
                            <span class="muted-copy">{{ $doctor->speciality ?: ($doctor->department?->name ?? __('Specialist')) }}</span>
                        </div>
                        <div class="doctor-list-item">
                            <strong>{{ __('Email') }}</strong>
                            <span class="muted-copy">{{ $doctor->email ?: __('Email not available') }}</span>
                        </div>
                        <div class="doctor-list-item">
                            <strong>{{ __('Office Phone') }}</strong>
                            <span class="muted-copy">{{ $doctor->office_phone ?? __('Not provided') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('app.booking', ['doctor' => $doctor->id, 'department' => $doctor->department_id]) }}" class="btn-brand-primary w-100 mt-4">
                        {{ __('Book This Doctor') }} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="doctor-sidebar-card">
                    <div class="detail-title">{{ __('Working shifts') }}</div>
                    <div class="doctor-list-stack">
                        @forelse($shifts as $shift)
                            @php
                                $startTime = data_get($shift, 'start_time');
                                $endTime = data_get($shift, 'end_time');
                                $timeLabel = collect([
                                    filled($startTime) ? \Carbon\Carbon::parse($startTime)->format('h:i A') : null,
                                    filled($endTime) ? \Carbon\Carbon::parse($endTime)->format('h:i A') : null,
                                ])->filter()->join(' - ');
                            @endphp
                            <div class="doctor-list-item">
                                <strong>{{ data_get($shift, 'day', __('Day not set')) }}</strong>
                                <span class="muted-copy">{{ $timeLabel ?: __('Time not set') }}</span>
                            </div>
                        @empty
                            <div class="doctor-list-item">
                                <strong>{{ __('Shift schedule pending') }}</strong>
                                <span class="muted-copy">{{ __('Working hour details will be updated soon.') }}</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="doctor-detail-card">
                    <div class="detail-title">{{ __('Short biography') }}</div>
                    <div class="muted-copy">
                        {!! html_entity_decode($doctor->description ?: __('Doctor biography will be updated soon.')) !!}
                    </div>
                </div>

                <div class="doctor-detail-card">
                    <div class="detail-title">{{ __('Education and experience') }}</div>
                    <div class="doctor-list-stack">
                        @forelse($educations as $education)
                            <div class="doctor-list-item">
                                <strong>{{ data_get($education, 'title', __('Title not added')) }}</strong>
                                <span class="muted-copy">{{ data_get($education, 'details', __('Details not added')) }}</span>
                            </div>
                        @empty
                            <div class="doctor-list-item">
                                <strong>{{ __('Profile details pending') }}</strong>
                                <span class="muted-copy">{{ __('Education and experience details have not been added yet.') }}</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                @if($doctor->experience)
                    <div class="doctor-detail-card">
                        <div class="detail-title">{{ __('Experience summary') }}</div>
                        <p class="muted-copy mb-0">{{ $doctor->experience }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection


@push('scripts')
    <script>
    $(document).ready(function () {
        $(".fav-btn").click(function () {
             let doctorId = $(this).data("doctor");
            let isAuth = $(this).data("auth");
            let roles = $(this).data("roles");
            let $btn = $(this);

            if (!isAuth) {
                toastr.error(@json(__('You must login first to favorite a doctor.')));
                playSound();
                return;
            }

            if (!roles.includes("patient")) {
                toastr.error(@json(__('Only patients can add favorite doctors!')));
                playSound();
                return;
            }

                $.ajax({
                    url: "{{ route('patient.favorite.doctore', ':id') }}".replace(':id', doctorId),
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    dataType: "json",
                    success: function (data) {
                        let $icon = $btn.find("i");

                        if (data.status === "added") {
                            toastr.success(@json(__('Doctor added to favorites!')));
                            $icon.addClass("text-danger");
                            playSound();
                        } else if (data.status === "removed") {
                            toastr.success("Doctor removed from favorites!");
                            $icon.removeClass("text-danger");
                            playSound();
                        }
                    },
                    error: function () {
                        toastr.error("Something went wrong!");
                        playSound();
                    }
                });
        });
    });
</script>

@endpush
