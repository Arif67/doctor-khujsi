@extends('layouts.app')

@section('title', $hospital->hospital_name)

@section('content')
@php
    $aboutHospital = $hospital->about_hospital ?: '
        <p><strong>Welcome to ' . e($hospital->hospital_name) . '.</strong> This hospital provides patient-first treatment support with a focus on emergency response, specialist consultation, diagnostic guidance, and routine follow-up care.</p>
        <p>Our clinical workflow is designed to help patients find the right department quickly, connect with experienced doctors, and receive clear care guidance from admission to discharge.</p>
    ';

    $privacyPolicy = $hospital->privacy_policy ?: '
        <p>We collect only the patient and hospital information required for booking, consultation, and follow-up service coordination.</p>
        <p>Personal information is handled with restricted access, internal review controls, and operational confidentiality standards. Contact details and care-related records are never shared outside authorized workflow needs.</p>
    ';

    $facilities = collect([
        'Emergency reception and triage desk',
        'Specialist consultation chambers',
        'Diagnostic support and report follow-up',
        'Patient waiting lounge',
        'Nursing and care coordination desk',
        'Follow-up booking and referral support',
    ]);

    $openingHours = collect([
        ['day' => 'Saturday', 'time' => '9:00 AM - 8:00 PM'],
        ['day' => 'Sunday', 'time' => '9:00 AM - 8:00 PM'],
        ['day' => 'Monday', 'time' => '9:00 AM - 8:00 PM'],
        ['day' => 'Tuesday', 'time' => '9:00 AM - 8:00 PM'],
        ['day' => 'Wednesday', 'time' => '9:00 AM - 8:00 PM'],
        ['day' => 'Thursday', 'time' => '9:00 AM - 6:00 PM'],
        ['day' => 'Friday', 'time' => 'Closed / Emergency Only'],
    ]);

    $emergencyContact = [
        'phone' => $hospital->phone ?: '01700 000000',
        'email' => $hospital->email ?: 'info@hospital.com',
        'location' => $hospital->hospital_location ?: $hospital->address ?: 'Hospital location not added yet',
    ];

    $dummyDepartmentGroups = collect([
        [
            'name' => 'Medicine',
            'count' => 2,
            'doctors' => collect([
                (object) ['name' => 'Dr. Rahim Uddin', 'photo' => null, 'speciality' => 'Internal Medicine Specialist', 'id' => null],
                (object) ['name' => 'Dr. Farzana Akter', 'photo' => null, 'speciality' => 'General Physician', 'id' => null],
            ]),
        ],
        [
            'name' => 'Cardiology',
            'count' => 1,
            'doctors' => collect([
                (object) ['name' => 'Dr. Shafiq Hasan', 'photo' => null, 'speciality' => 'Heart and BP Care', 'id' => null],
            ]),
        ],
    ]);

    $displayDepartmentGroups = $departmentGroups->isNotEmpty() ? $departmentGroups : $dummyDepartmentGroups;

    $dummyGallery = collect([
        ['title' => 'Reception and Patient Waiting Area', 'image' => asset('assets/img/register.jpg')],
        ['title' => 'Consultation Cabin and Nursing Desk', 'image' => asset('assets/img/doctore.png')],
        ['title' => 'General Care and Observation Unit', 'image' => asset('assets/img/default.png')],
    ]);

    $dummyServices = collect([
        ['title' => '24/7 Emergency Support', 'description' => 'Immediate first-response care with on-call hospital support for urgent patient needs.', 'image' => null],
        ['title' => 'Diagnostic and Lab Service', 'description' => 'Routine testing, reporting support, and doctor-directed diagnosis follow-up in one workflow.', 'image' => null],
        ['title' => 'Indoor and Outpatient Care', 'description' => 'Consultation, observation, treatment planning, and patient monitoring for common clinical cases.', 'image' => null],
    ]);

    $dummyDoctors = collect([
        (object) ['name' => 'Dr. Nusrat Jahan', 'photo' => null, 'department' => (object) ['name' => 'Gynecology'], 'speciality' => 'Women Wellness Care', 'id' => null],
        (object) ['name' => 'Dr. Mahmud Alam', 'photo' => null, 'department' => (object) ['name' => 'Orthopedics'], 'speciality' => 'Bone and Joint Support', 'id' => null],
        (object) ['name' => 'Dr. Tania Sultana', 'photo' => null, 'department' => (object) ['name' => 'Pediatrics'], 'speciality' => 'Child Health Consultation', 'id' => null],
    ]);

    $displayDoctors = $hospital->doctors->isNotEmpty() ? $hospital->doctors : $dummyDoctors;
    $dummyReviews = collect([
        [
            'reviewer_name' => 'Rafiul Islam',
            'rating' => 2,
            'review' => 'Doctor pawa gese, kintu reception ar waiting management onek slow chilo. Report collect korteo extra wait korte hoise.',
            'created_at' => now()->subDays(9),
            'is_dummy' => true,
        ],
        [
            'reviewer_name' => 'Mst. Sumaiya',
            'rating' => 3,
            'review' => 'Service motamoti chilo. Nurse ra helpful, but billing counter e coordination better hole patient der jonne easier hoto.',
            'created_at' => now()->subDays(6),
            'is_dummy' => true,
        ],
        [
            'reviewer_name' => 'Anik Hasan',
            'rating' => 1,
            'review' => 'Emergency bole niyechilam, but response expected-er cheye onek deri chilo. Erokom situation-e hospital-er service improve kora dorkar.',
            'created_at' => now()->subDays(3),
            'is_dummy' => true,
        ],
    ]);

    $displayReviews = $hospital->hospitalReviews->isNotEmpty() ? $hospital->hospitalReviews : $dummyReviews;
    $reviewCount = $displayReviews->count();
    $reviewAverage = $reviewCount ? round($displayReviews->avg('rating'), 1) : 0;
@endphp
<section class="py-5">
    <div class="container">
        <div class="surface-card p-4 p-lg-5 mb-4 hospital-hero">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <img src="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}" alt="{{ $hospital->hospital_name }}" class="hospital-hero-photo">
                </div>
                <div class="col-lg-7">
                    <span class="section-eyebrow mb-3">{{ __('Hospital Details') }}</span>
                    <h1 class="section-title mb-3">{{ $hospital->hospital_name }}</h1>
                    <p class="muted-copy fs-5 mb-3">{{ $hospital->hospital_location ?: $hospital->address ?: __('Location not added yet') }}</p>
                    <div class="hero-metrics">
                        <div>
                            <strong>{{ $hospital->active_doctors_count }}</strong>
                            <span>{{ __('Active Doctors') }}</span>
                        </div>
                        <div>
                            <strong>{{ $hospital->services_count }}</strong>
                            <span>{{ __('Services') }}</span>
                        </div>
                        <div>
                            <strong>{{ $hospital->hospital_galleries_count }}</strong>
                            <span>{{ __('Gallery Photos') }}</span>
                        </div>
                        <div>
                            <strong>{{ $hospital->phone ?: 'N/A' }}</strong>
                            <span>{{ __('Contact') }}</span>
                        </div>
                        <div>
                            <strong>{{ $reviewAverage ?: '0.0' }}/5</strong>
                            <span>{{ $reviewCount }} {{ __('Review') }}{{ $reviewCount === 1 ? '' : 's' }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('app.booking') }}" class="btn-brand-primary">{{ __('Book a Doctor') }}</a>
                        <a href="{{ route('app.hospitals') }}" class="btn-brand-secondary">{{ __('Back to Hospitals') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="surface-card p-4 p-lg-5 mb-4">
                    <h2 class="h3 mb-3">{{ __('About Hospital') }}</h2>
                    <div class="rich-copy">
                        {!! $aboutHospital !!}
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5 mb-4">
                    <h2 class="h3 mb-3">{{ __('Privacy Policy') }}</h2>
                    <div class="rich-copy">
                        {!! $privacyPolicy !!}
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('Facilities') }}</h2>
                        <span class="muted-copy">{{ __('Hospital highlights') }}</span>
                    </div>
                    <div class="facility-grid">
                        @foreach($facilities as $facility)
                            <div class="facility-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('Opening Hours') }}</h2>
                        <span class="muted-copy">{{ __('Weekly schedule') }}</span>
                    </div>
                    <div class="hours-list">
                        @foreach($openingHours as $hour)
                            <div class="hour-row">
                                <strong>{{ $hour['day'] }}</strong>
                                <span>{{ $hour['time'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('Emergency Contact') }}</h2>
                        <span class="muted-copy">{{ __('Quick reach') }}</span>
                    </div>
                    <div class="emergency-box">
                        <div>
                            <div class="small text-uppercase muted-copy mb-1">{{ __('Phone') }}</div>
                            <div class="h5 mb-0">{{ $emergencyContact['phone'] }}</div>
                        </div>
                        <div>
                            <div class="small text-uppercase muted-copy mb-1">{{ __('Email') }}</div>
                            <div class="h5 mb-0">{{ $emergencyContact['email'] }}</div>
                        </div>
                        <div>
                            <div class="small text-uppercase muted-copy mb-1">{{ __('Location') }}</div>
                            <div class="h5 mb-0">{{ $emergencyContact['location'] }}</div>
                        </div>
                    </div>
                </div>

                <div id="hospital-reviews" class="surface-card p-4 p-lg-5 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <div>
                            <h2 class="h3 mb-1">{{ __('Hospital Reviews') }}</h2>
                            <p class="muted-copy mb-0">{{ __('User ra chaile hospital service niye positive ba negative feedback dite parbe.') }}</p>
                        </div>
                        <div class="review-score-box">
                            <strong>{{ $reviewAverage ?: '0.0' }}</strong>
                            <span>{{ __('Average rating') }}</span>
                        </div>
                    </div>

                    <div class="review-list mb-4">
                        @foreach($displayReviews as $review)
                            <article class="review-card">
                                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                    <div>
                                        <h3>{{ $review['reviewer_name'] ?? $review->reviewer_name }}</h3>
                                        <div class="review-stars mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= (int) ($review['rating'] ?? $review->rating) ? 'active' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="small muted-copy text-end">
                                        {{ \Illuminate\Support\Carbon::parse($review['created_at'] ?? $review->created_at)->format('d M Y') }}
                                        @if(($review['is_dummy'] ?? false) === true)
                                            <span class="dummy-badge ms-2">{{ __('Sample Review') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="mb-0">{{ $review['review'] ?? $review->review }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="review-form-wrap">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                            <div>
                                <h3 class="h4 mb-1">{{ __('Write a Review') }}</h3>
                                <p class="muted-copy mb-0">{{ __('Kono hospital kharap service dile ba bhalo experience hole ekhane share korte paren.') }}</p>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success review-alert" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger review-alert" role="alert">
                                <strong>{{ __('Review submit hoyni.') }}</strong>
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('app.hospitals.reviews.store', ['hospital' => $hospital->id, 'slug' => \Illuminate\Support\Str::slug($hospital->hospital_name ?: $hospital->name)]) }}#hospital-reviews" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="reviewer_name" class="form-label">{{ __('Your Name') }}</label>
                                <input type="text" id="reviewer_name" name="reviewer_name" value="{{ old('reviewer_name') }}" class="form-control review-input" required>
                            </div>
                            <div class="col-md-6">
                                <label for="reviewer_email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" id="reviewer_email" name="reviewer_email" value="{{ old('reviewer_email') }}" class="form-control review-input">
                            </div>
                            <div class="col-md-4">
                                <label for="rating" class="form-label">{{ __('Rating') }}</label>
                                <select id="rating" name="rating" class="form-select review-input" required>
                                    <option value="">{{ __('Select rating') }}</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" @selected((string) old('rating') === (string) $i)>{{ $i }} {{ __('Star') }}{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="review" class="form-label">{{ __('Review') }}</label>
                                <textarea id="review" name="review" rows="5" class="form-control review-input" required>{{ old('review') }}</textarea>
                            </div>
                            <div class="col-12">
                                <div class="small muted-copy">{{ __('Review submit korar por admin approve korle eta publicly show hobe.') }}</div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-brand-primary">{{ __('Submit Review') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('Departments') }}</h2>
                        <span class="muted-copy">{{ $displayDepartmentGroups->count() }} {{ __('department') }}{{ $displayDepartmentGroups->count() === 1 ? '' : 's' }}</span>
                    </div>
                    <div class="department-chip-list mb-4">
                        @foreach($displayDepartmentGroups as $group)
                            <a href="#department-{{ \Illuminate\Support\Str::slug($group['name']) }}" class="department-chip">{{ $group['name'] }} <span>{{ $group['count'] }}</span></a>
                        @endforeach
                    </div>

                    <div class="department-section-list">
                        @forelse($displayDepartmentGroups as $group)
                            <div id="department-{{ \Illuminate\Support\Str::slug($group['name']) }}" class="department-section-card">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                                    <div>
                                        <h3 class="h4 mb-1">{{ $group['name'] }}</h3>
                                        <p class="muted-copy mb-0">{{ $group['count'] }} {{ __('doctor') }}{{ $group['count'] === 1 ? '' : 's' }} {{ __('working in this department') }}</p>
                                    </div>
                                    @php($firstRealDoctor = $group['doctors']->firstWhere('id'))
                                    @if($firstRealDoctor)
                                        <a href="{{ route('app.booking', ['doctor' => $firstRealDoctor->id, 'department' => $group['department_id']]) }}" class="btn-brand-secondary btn-sm">
                                            {{ __('Book') }} {{ $group['name'] }}
                                        </a>
                                    @endif
                                </div>
                                <div class="row g-3">
                                    @foreach($group['doctors'] as $doctor)
                                        <div class="col-md-6">
                                            <div class="doctor-detail-card">
                                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png') }}" alt="{{ $doctor->name }}">
                                                <div>
                                                    <h4>{{ $doctor->name }}</h4>
                                                    <p>{{ $doctor->speciality ?: __('Speciality not added yet') }}</p>
                                                    @if(!empty($doctor->id))
                                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                                            <a href="{{ route('app.doctor-profile', ['doctor' => $doctor->id, 'name' => \Illuminate\Support\Str::slug($doctor->name)]) }}" class="btn-brand-secondary btn-sm">{{ __('View Profile') }}</a>
                                                            <a href="{{ route('app.booking', ['doctor' => $doctor->id, 'department' => $doctor->department_id]) }}" class="btn-brand-primary btn-sm">{{ __('Book Appointment') }}</a>
                                                        </div>
                                                    @else
                                                        <span class="dummy-badge">{{ __('Sample Doctor') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info mb-0">{{ __('No department data found for this hospital.') }}</div>
                        @endforelse
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('Hospital Gallery') }}</h2>
                        <span class="muted-copy">{{ $hospital->hospital_galleries_count }} {{ __('images') }}</span>
                    </div>
                    <div class="gallery-grid">
                        @forelse($hospital->hospitalGalleries as $gallery)
                            <figure class="gallery-card">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?: $hospital->hospital_name }}">
                                @if($gallery->title)
                                    <figcaption>{{ $gallery->title }}</figcaption>
                                @endif
                            </figure>
                        @empty
                            @foreach($dummyGallery as $gallery)
                                <figure class="gallery-card">
                                    <img src="{{ $gallery['image'] }}" alt="{{ $gallery['title'] }}">
                                    <figcaption>{{ $gallery['title'] }} <span class="dummy-badge ms-2">{{ __('Sample') }}</span></figcaption>
                                </figure>
                            @endforeach
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="surface-card p-4 p-lg-5 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('Services') }}</h2>
                        <span class="muted-copy">{{ $hospital->services_count }} {{ __('total') }}</span>
                    </div>
                    <div class="service-stack">
                        @forelse($hospital->services as $service)
                            <a href="{{ route('app.service.history', ['service' => $service->id, 'title' => \Illuminate\Support\Str::slug($service->title)]) }}" class="service-stack-item">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <div class="service-stack-fallback"><i class="fas fa-heartbeat"></i></div>
                                @endif
                                <div>
                                    <h3>{{ $service->title }}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 80) }}</p>
                                </div>
                            </a>
                        @empty
                            @foreach($dummyServices as $service)
                                <div class="service-stack-item">
                                    <div class="service-stack-fallback"><i class="fas fa-heartbeat"></i></div>
                                    <div>
                                        <h3>{{ $service['title'] }}</h3>
                                        <p>{{ $service['description'] }}</p>
                                        <span class="dummy-badge mt-2">{{ __('Sample Service') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endforelse
                    </div>
                </div>

                <div class="surface-card p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <h2 class="h3 mb-0">{{ __('All Doctors') }}</h2>
                        <span class="muted-copy">{{ $hospital->active_doctors_count }} {{ __('profiles') }}</span>
                    </div>
                    <div class="doctor-stack">
                        @forelse($displayDoctors as $doctor)
                            <div class="doctor-stack-item">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default.png') }}" alt="{{ $doctor->name }}">
                                <div>
                                    <h3>{{ $doctor->name }}</h3>
                                    <p>{{ $doctor->department?->name ?: __('Department not assigned') }}</p>
                                    @if(!empty($doctor->shifts))
                                        <div class="schedule-pills mt-2">
                                            @foreach($doctor->shifts as $shift)
                                                <span class="schedule-pill">{{ $shift['day'] ?? __('Day') }}: {{ $shift['time'] ?? __('Time') }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="dummy-badge mt-2">{{ __('Schedule not added yet') }}</span>
                                    @endif
                                    @if(empty($doctor->id))
                                        <span class="dummy-badge mt-2">{{ __('Sample Profile') }}</span>
                                    @else
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <a href="{{ route('app.doctor-profile', ['doctor' => $doctor->id, 'name' => \Illuminate\Support\Str::slug($doctor->name)]) }}" class="btn-brand-secondary btn-sm">{{ __('View Profile') }}</a>
                                            <a href="{{ route('app.booking', ['doctor' => $doctor->id, 'department' => $doctor->department_id]) }}" class="btn-brand-primary btn-sm">{{ __('Book') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info mb-0">{{ __('No active doctors found for this hospital.') }}</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .hospital-hero {
        background:
            radial-gradient(circle at top right, rgba(244, 162, 97, 0.16), transparent 22%),
            linear-gradient(135deg, rgba(18, 124, 138, 0.07), rgba(255, 255, 255, 0.95));
    }

    .hospital-hero-photo {
        width: 100%;
        height: 320px;
        object-fit: cover;
        border-radius: 28px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        box-shadow: var(--brand-shadow);
    }

    .hero-metrics {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-metrics div {
        min-width: 140px;
        padding: 16px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .hero-metrics strong {
        display: block;
        font-size: 1.5rem;
        line-height: 1;
        margin-bottom: 6px;
    }

    .hero-metrics span,
    .doctor-detail-card p,
    .doctor-stack-item p {
        color: var(--brand-muted);
        font-size: 0.92rem;
        margin-bottom: 0;
    }

    .facility-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .facility-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(18, 124, 138, 0.06);
        color: var(--brand-ink);
        font-weight: 600;
    }

    .facility-item i {
        color: var(--brand-primary);
        margin-top: 3px;
    }

    .hours-list {
        display: grid;
        gap: 10px;
    }

    .hour-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 18px;
        background: #f8fcfc;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .hour-row strong {
        color: var(--brand-ink);
    }

    .emergency-box {
        display: grid;
        gap: 14px;
        padding: 18px;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(18, 124, 138, 0.08), rgba(255, 255, 255, 0.88));
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .department-chip-list {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .review-score-box {
        min-width: 132px;
        padding: 16px 18px;
        border-radius: 20px;
        text-align: center;
        background: rgba(18, 124, 138, 0.08);
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .review-score-box strong {
        display: block;
        font-size: 1.8rem;
        line-height: 1;
        margin-bottom: 6px;
    }

    .review-score-box span {
        color: var(--brand-muted);
        font-size: 0.88rem;
        font-weight: 600;
    }

    .review-list {
        display: grid;
        gap: 14px;
    }

    .review-card {
        padding: 18px 20px;
        border-radius: 22px;
        background: #f8fcfc;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .review-card h3 {
        margin: 0 0 8px;
        font-size: 1rem;
        color: var(--brand-ink);
    }

    .review-card p {
        color: var(--brand-muted);
        line-height: 1.8;
    }

    .review-stars {
        display: inline-flex;
        gap: 4px;
        color: rgba(244, 162, 97, 0.34);
    }

    .review-stars .active {
        color: #f4a261;
    }

    .review-form-wrap {
        padding: 22px;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(18, 124, 138, 0.07), rgba(255, 255, 255, 0.98));
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .review-input {
        border-radius: 16px;
        padding: 13px 15px;
        border: 1px solid #d9e8e8;
        box-shadow: none;
    }

    .review-alert {
        border-radius: 18px;
        margin-bottom: 18px;
    }

    .department-chip {
        display: inline-flex;
        gap: 8px;
        align-items: center;
        padding: 10px 14px;
        border-radius: 999px;
        text-decoration: none;
        background: rgba(18, 124, 138, 0.08);
        color: var(--brand-primary-dark);
        font-weight: 700;
    }

    .department-chip span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        border-radius: 999px;
        background: #fff;
    }

    .department-section-list {
        display: grid;
        gap: 18px;
    }

    .department-section-card,
    .gallery-card {
        padding: 18px;
        border-radius: 24px;
        background: #f8fcfc;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .doctor-detail-card,
    .doctor-stack-item {
        display: grid;
        grid-template-columns: 72px 1fr;
        gap: 14px;
        align-items: center;
        padding: 14px;
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .doctor-detail-card img,
    .doctor-stack-item img {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        object-fit: cover;
    }

    .doctor-detail-card h4,
    .doctor-stack-item h3,
    .service-stack-item h3 {
        margin: 0 0 6px;
        font-size: 1rem;
        color: var(--brand-ink);
    }

    .btn-sm {
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 0.82rem;
    }

    .gallery-grid,
    .service-stack,
    .doctor-stack {
        display: grid;
        gap: 14px;
    }

    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    }

    .gallery-card {
        margin: 0;
    }

    .gallery-card img {
        width: 100%;
        height: 180px;
        border-radius: 18px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .gallery-card figcaption {
        color: var(--brand-primary-dark);
        font-weight: 700;
    }

    .service-stack-item {
        display: grid;
        grid-template-columns: 76px 1fr;
        gap: 14px;
        align-items: center;
        padding: 14px;
        border-radius: 22px;
        background: #f8fcfc;
        border: 1px solid rgba(21, 58, 63, 0.08);
        text-decoration: none;
        color: inherit;
    }

    .service-stack-item img,
    .service-stack-fallback {
        width: 76px;
        height: 76px;
        border-radius: 18px;
        object-fit: cover;
    }

    .service-stack-fallback {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(18, 124, 138, 0.12);
        color: var(--brand-primary-dark);
        font-size: 1.5rem;
    }

    .service-stack-item p,
    .rich-copy p:last-child {
        margin-bottom: 0;
    }

    .dummy-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(244, 162, 97, 0.18);
        color: #9a5b1e;
        font-size: 0.75rem;
        font-weight: 700;
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

    @media (max-width: 767.98px) {
        .facility-grid {
            grid-template-columns: 1fr;
        }

        .hour-row {
            flex-direction: column;
        }
    }
</style>
@endpush
