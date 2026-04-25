@extends('layouts.app')

@section('title', 'Doctor Profile - Hospital Management')

@push('styles')
    <style>
        body{
            font-family: "Inter", sans-serif;
        }
        .doctore_profile_section {
            background-color: #e0f7fa; 
            padding: 40px 0;
        }
        .doctor-info h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .doctor-info p {
            margin-bottom: 5px;
            color: #555;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .social-icons a {
            color: #00796b;
            margin-right: 15px;
            font-size: 1.2rem;
            text-decoration: none;
            transition: color 0.3s;
        }
        .social-icons a:hover {
            color: #004d40;
        }
        .doctor-img-container {
            position: relative;
            text-align: center;
        }
        .doctor-img {
            max-width: 100%;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background: #3BAFBF80;
        }
        .fav-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .consultation-form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #eee;
        }
        .consultation-form h4 {
            font-weight: bold;
            color: #00796b;
            margin-bottom: 25px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border-color: #00796b;
        }
        .btn-book {
            background-color: #009688;
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-book:hover {
            background-color: #00796b;
            color: white;
        }
        .biography-section h3, .experience-section h3, .shifts-section h3 {
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 40px;
            color: #333333;
            line-height: 100%;
        }
        .biography-section p{
            font-weight: 400;
            color: #333333;
            font-size: 18px;
            line-height: 100%;
        }
        .experience-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .experience-item .title {
            font-weight: 400;
            color: #333333;
        }
        .experience-item .value {
            color: #666;
        }
        @media only screen and (max-width: 600px){
            .biography-section h3, .experience-section h3, .shifts-section h3{
                font-size: 30px;
            }
        }
        @media (min-width: 600px) and (max-width: 767px) {
            .biography-section h3, .experience-section h3, .shifts-section h3{
                font-size: 30px;
            }
        }
        @media (min-width: 768px) and (max-width: 1024px) {
            .biography-section h3, .experience-section h3, .shifts-section h3{
                font-size: 30px;
            }
        }
        .doctore_profile_img {
            background: #3BAFBF80;
            border-radius: 24px;
        }

        .doctore_profile_img img {
            width: 100%;
        }

    </style>
@endpush

@section('content')
<section id="doctor_profile_section">
    <div class="doctore_profile_section">
        <div class="container px-4 px-md-0">
            <div class="row row-gap-2 align-items-center">
                <div class="col-md-6 col-lg-4 doctor-info">
                    <h2>{{ $doctor->name }}</h2>
                    <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
                    <p><strong>Office:</strong> {{ $doctor->office_phone ?? 'None' }}</p>
                    <p><strong>Email:</strong> {{ $doctor->email }}</p>
                   <div class="social-icons mt-4">
                        @if($doctor->social_links && is_array($doctor->social_links))
                            @foreach($doctor->social_links as $social)
                                <a href="{{ $social['url'] }}" target="_blank">{!! $social['platform'] !!}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-2"></div>
                 
                <div class="col-md-6 col-lg-6 mt-4 mt-lg-0">
                    <div class="doctore_profile_img position-relative">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png') }}" alt="Dr. Emily Brown" class="">
                        <div class="fav-icon">
                            <button type="button" 
                                    class="btn btn-link p-0 border-0 bg-transparent fav-btn" 
                                    data-doctor="{{ $doctor->id }}"
                                    data-auth="{{ auth()->check() ? '1' : '0' }}"
                                     data-roles="{{ auth()->check() ? auth()->user()->getRoleNames()->first() : '' }}">
                                    <i class="fas fa-heart 
                                        {{ auth()->check() && auth()->user()->favorites && auth()->user()->favorites->contains($doctor->id) ? 'text-danger' : '' }}">
                                    </i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container px-4 px-md-0">
            <div class="row row-gap-4">
                <!-- Left Side: Booking Form -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="consultation-form">
                        <h4>Book a Consultation:</h4>
                        <p class="text-muted">Submit a simple booking request without creating a patient account.</p>
                        <div class="mb-3">
                            <strong>Hospital:</strong> {{ $doctor->owner?->hospital_name ?? 'Hospital not assigned' }}
                        </div>
                        <div class="mb-4">
                            <strong>Speciality:</strong> {{ $doctor->speciality ?: ($doctor->department?->name ?? 'Specialist') }}
                        </div>
                        <a href="{{ route('app.booking', ['doctor' => $doctor->id]) }}" class="btn btn-book">
                            Book This Doctor <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Side: Details -->
                <div class="col-lg-7 ps-lg-5">
                    <div class="biography-section">
                        <h3>Short Biography</h3>
                        <p class="text-muted">
                             {!! 
                                html_entity_decode($doctor->description)
                            !!}
                        </p>
                    </div>
                    
                    <div class="experience-section mt-5">
                        <h3>Education & Experience</h3>
                        @if($doctor->educations && is_array($doctor->educations))
                            @foreach($doctor->educations as $education)
                                <div class="experience-item row align-items-center">
                                    <div class="col-lg-4">
                                        <span class="title">{!! $education['title'] !!}</span>
                                    </div>
                                    <div class="col-lg-8">
                                        <span class="value">{!! $education['details'] !!}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="shifts-section mt-5">
                        <h3>Working Shifts</h3>
                        @if($doctor->shifts && is_array($doctor->shifts))
                            @foreach($doctor->shifts as $shift)
                                <p class="text-muted mb-0">
                                    {!! $shift['day'] !!} :
                                    {{ \Carbon\Carbon::parse($shift['start_time'])->format('h:i A') }}
                                    -
                                    {{ \Carbon\Carbon::parse($shift['end_time'])->format('h:i A') }}
                                </p>
                            @endforeach
                        @endif
                        
                    </div>
                </div>
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
                toastr.error("You must login first to favorite a doctor.");
                playSound();
                return;
            }

            if (!roles.includes("patient")) {
                toastr.error("Only patients can add favorite doctors!");
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
                            toastr.success("Doctor added to favorites!");
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
