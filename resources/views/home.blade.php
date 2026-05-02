@extends('layouts.app')

@section('title', 'Doctor Finder')

@push('styles')
<style>
    .home-showcase {
        padding: 0 0 32px;
    }

    .home-showcase .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }

    .finder-hero {
        padding: 36px 0;
        font-family: "Poppins", sans-serif;
    }

    .finder-hero-slider {
        position: relative;
    }

    .home-showcase-slider .carousel-inner {
        border-radius: 0;
    }

    .home-showcase-slide {
        position: relative;
        min-height: clamp(280px, 46vw, 600px);
        height: clamp(280px, 46vw, 600px);
        background: linear-gradient(135deg, #10353a 0%, #127c8a 100%);
    }

    .home-showcase-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        opacity: 0.56;
    }

    .home-showcase-slide-link {
        display: block;
        width: 100%;
        height: 100%;
    }

    .finder-hero-slider .carousel-indicators {
        margin-bottom: 20px;
    }

    .finder-hero-slider .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 0;
        background-color: rgba(18, 124, 138, 0.3);
    }

    .finder-hero-slider .carousel-indicators .active {
        background-color: var(--brand-primary);
    }

    .finder-hero-slider .carousel-control-prev,
    .finder-hero-slider .carousel-control-next {
        width: 52px;
        height: 52px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.88);
        border-radius: 50%;
        opacity: 1;
        box-shadow: 0 14px 28px rgba(15, 55, 60, 0.12);
    }

    .finder-hero-slider .carousel-control-prev {
        left: 20px;
    }

    .finder-hero-slider .carousel-control-next {
        right: 20px;
    }

    .finder-hero-slider .carousel-control-prev-icon,
    .finder-hero-slider .carousel-control-next-icon {
        filter: invert(18%) sepia(30%) saturate(825%) hue-rotate(138deg) brightness(88%) contrast(95%);
        width: 1.2rem;
        height: 1.2rem;
    }

    .finder-hero-slider .carousel-inner {
        border-radius: 28px;
        overflow: hidden;
    }

    .home-showcase-slider .carousel-inner,
    .home-showcase-slide,
    .home-showcase-slide img,
    .home-showcase-slide-link {
        border-radius: 0 !important;
    }

    .finder-hero-panel {
        padding: 42px;
        overflow: hidden;
        position: relative;
        background:
            radial-gradient(circle at top right, rgba(244, 162, 97, 0.22), transparent 24%),
            radial-gradient(circle at bottom left, rgba(18, 124, 138, 0.12), transparent 28%),
            linear-gradient(135deg, #eef8fa 0%, #ffffff 52%, #f7fcfc 100%);
    }

    .finder-hero-panel::after {
        content: "";
        position: absolute;
        inset: auto -80px -120px auto;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(18, 124, 138, 0.08);
    }

    .finder-hero-panel::before {
        content: "";
        position: absolute;
        inset: 24px 24px auto auto;
        width: 120px;
        height: 120px;
        border-radius: 28px;
        border: 1px solid rgba(18, 124, 138, 0.08);
        background: rgba(255, 255, 255, 0.38);
        backdrop-filter: blur(8px);
        transform: rotate(16deg);
    }

    .finder-hero-copy,
    .hero-doctor-stage {
        position: relative;
        z-index: 1;
    }

    .finder-hero-content-row {
        justify-content: center;
    }

    .finder-hero-copy .section-title {
        font-family: "Poppins", sans-serif;
        font-weight: 700;
        letter-spacing: -0.045em;
        max-width: 22ch;
        line-height: 1.12;
        margin-left: auto;
        margin-right: auto;
    }

    .finder-hero-copy .muted-copy {
        font-size: 1.02rem;
        line-height: 1.8;
        max-width: 620px;
        margin-left: auto;
        margin-right: auto;
    }

    .finder-hero-copy {
        text-align: center;
    }

    .finder-hero-copy .section-eyebrow {
        margin-left: auto;
        margin-right: auto;
    }

    .finder-hero-copy .finder-stat-grid {
        margin-left: auto;
        margin-right: auto;
        max-width: 860px;
    }

    .finder-stat-grid,
    .finder-promise-grid,
    .concern-grid,
    .blog-grid {
        display: grid;
        gap: 20px;
    }

    .finder-stat-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-top: 30px;
    }

    .finder-stat,
    .finder-promise-card,
    .concern-card,
    .blog-card {
        border-radius: 24px;
        background: #fff;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .finder-stat {
        padding: 20px;
    }

    .finder-stat strong {
        display: block;
        font-family: "Sora", sans-serif;
        font-size: 1.8rem;
    }

    .hero-doctor-stage {
        position: relative;
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 0 12px 20px;
    }

    .hero-doctor-card {
        width: min(100%, 430px);
        padding: 20px;
        position: relative;
        z-index: 1;
        border-radius: 32px;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(244, 250, 250, 0.96) 100%);
        border: 1px solid rgba(18, 124, 138, 0.12);
        box-shadow:
            0 34px 70px rgba(15, 55, 60, 0.16),
            0 16px 28px rgba(18, 124, 138, 0.08);
        transform: translateY(-26px);
    }

    .hero-doctor-card::before {
        content: "";
        position: absolute;
        inset: -18px 28px auto auto;
        width: 92px;
        height: 92px;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(244, 162, 97, 0.24), rgba(255, 255, 255, 0));
        z-index: -1;
    }

    .hero-doctor-card::after {
        content: "";
        position: absolute;
        inset: auto auto -22px -18px;
        width: 140px;
        height: 140px;
        border-radius: 32px;
        background: linear-gradient(135deg, rgba(18, 124, 138, 0.14), rgba(18, 124, 138, 0));
        z-index: -1;
    }

    .hero-doctor-card img {
        width: 100%;
        height: 440px;
        object-fit: cover;
        border-radius: 26px;
        background: #edf6f7;
        border: 1px solid rgba(18, 124, 138, 0.08);
    }

    .hero-floating-badge {
        position: absolute;
        padding: 14px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(18, 124, 138, 0.12);
        box-shadow: 0 20px 35px rgba(15, 55, 60, 0.12);
        font-weight: 700;
        max-width: 220px;
        backdrop-filter: blur(10px);
    }

    .hero-floating-badge.top {
        top: 18px;
        left: -6px;
    }

    .hero-floating-badge.bottom {
        right: -2px;
        bottom: 26px;
    }

    .hero-doctor-meta {
        padding: 18px 6px 6px;
    }

    .hero-doctor-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(18, 124, 138, 0.1);
        color: var(--brand-primary-dark);
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .hero-doctor-name {
        margin: 14px 0 8px;
        font-family: "Poppins", sans-serif;
        font-size: 1.55rem;
        line-height: 1.2;
        font-weight: 700;
        color: var(--brand-ink);
    }

    .hero-doctor-speciality,
    .hero-doctor-hospital {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--brand-muted);
        font-size: 0.96rem;
        line-height: 1.6;
    }

    .hero-doctor-speciality i,
    .hero-doctor-hospital i {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(18, 124, 138, 0.08);
        color: var(--brand-primary);
        flex-shrink: 0;
    }

    .hero-doctor-hospital {
        margin-top: 10px;
    }

    .finder-promise-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-top: 28px;
    }

    .services-section {
        padding-bottom: 2rem !important;
    }

    .team-section {
        padding-top: 2rem !important;
    }

    .featured-hospitals-section {
        padding: 24px 0 48px;
    }

    .featured-hospital-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        margin-top: 28px;
    }

    .featured-hospital-card {
        position: relative;
        overflow: hidden;
        padding: 22px;
    }

    .featured-hospital-card::after {
        content: "";
        position: absolute;
        inset: auto -30px -48px auto;
        width: 132px;
        height: 132px;
        background: radial-gradient(circle, rgba(18, 124, 138, 0.16), transparent 68%);
    }

    .featured-hospital-card > * {
        position: relative;
        z-index: 1;
    }

    .featured-hospital-cover {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 22px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        background: #edf6f7;
    }

    .featured-hospital-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(18, 124, 138, 0.09);
        color: var(--brand-primary-dark);
        font-size: 0.82rem;
        font-weight: 700;
    }

    .featured-hospital-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        color: var(--brand-primary-dark);
        font-size: 0.94rem;
        font-weight: 700;
    }

    .finder-promise-card,
    .concern-card,
    .blog-card {
        padding: 24px;
        height: 100%;
    }

    .finder-promise-icon,
    .concern-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(18, 124, 138, 0.1);
        color: var(--brand-primary);
        font-size: 1.3rem;
        margin-bottom: 18px;
    }

    .finder-story {
        padding: 72px 0;
    }

    .finder-story-visual img {
        width: 100%;
        height: 100%;
        min-height: 420px;
        object-fit: cover;
        border-radius: 28px;
    }

    .finder-story-card {
        padding: 34px;
    }

    .finder-checks {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-top: 24px;
    }

    .finder-checks span {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--brand-ink);
        font-weight: 700;
    }

    .finder-checks i {
        color: var(--brand-primary);
    }

    .concern-section,
    .blog-section {
        padding: 72px 0;
    }

    .concern-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: 30px;
    }

    .concern-card span {
        display: block;
        margin-top: 12px;
        font-weight: 700;
    }

    .blog-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-top: 28px;
    }

    .blog-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 20px;
        margin-bottom: 20px;
        background: #edf6f7;
    }

    .blog-card a {
        color: var(--brand-primary-dark);
        text-decoration: none;
        font-weight: 700;
    }

    @media (max-width: 991.98px) {
        .home-showcase-slide {
            min-height: clamp(260px, 44vw, 460px);
            height: clamp(260px, 44vw, 460px);
        }

        .finder-hero-slider .carousel-control-prev,
        .finder-hero-slider .carousel-control-next {
            width: 44px;
            height: 44px;
        }

        .finder-hero-slider .carousel-control-prev {
            left: 14px;
        }

        .finder-hero-slider .carousel-control-next {
            right: 14px;
        }

        .finder-hero-panel,
        .finder-story-card {
            padding: 28px;
        }

        .hero-doctor-stage {
            padding-left: 0;
        }

        .hero-doctor-card {
            transform: translateY(-12px);
        }

        .finder-stat-grid,
        .finder-promise-grid,
        .featured-hospital-grid,
        .concern-grid,
        .blog-grid,
        .finder-checks {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .hero-floating-badge.top {
            left: 10px;
        }

        .hero-floating-badge.bottom {
            right: 10px;
        }
    }

    @media (max-width: 767.98px) {
        .home-showcase {
            padding-bottom: 18px;
        }

        .finder-hero {
            padding-top: 28px;
        }

        .home-showcase-slide {
            min-height: clamp(220px, 62vw, 340px);
            height: clamp(220px, 62vw, 340px);
        }

        .finder-hero-slider .carousel-indicators {
            margin-bottom: 12px;
        }

        .finder-hero-slider .carousel-indicators button {
            width: 8px;
            height: 8px;
        }

        .finder-hero-slider .carousel-control-prev,
        .finder-hero-slider .carousel-control-next {
            display: none;
        }

        .finder-stat-grid,
        .finder-promise-grid,
        .featured-hospital-grid,
        .concern-grid,
        .blog-grid,
        .finder-checks {
            grid-template-columns: 1fr;
        }

        .hero-doctor-card img {
            height: 320px;
        }

        .hero-doctor-card {
            transform: none;
        }

        .finder-hero-copy .section-title {
            max-width: none;
        }
    }

    @media (max-width: 575.98px) {
        .finder-hero-panel,
        .finder-story-card,
        .finder-promise-card,
        .featured-hospital-card,
        .concern-card,
        .blog-card {
            padding: 22px;
        }

        .home-showcase-slide {
            min-height: clamp(200px, 68vw, 280px);
            height: clamp(200px, 68vw, 280px);
        }

        .hero-floating-badge {
            position: static;
            width: 100%;
            margin-top: 12px;
        }

        .hero-doctor-card {
            padding: 18px;
        }

        .hero-doctor-card img {
            height: 260px;
        }

        .hero-doctor-name {
            font-size: 1.3rem;
        }

        .services-section {
            padding-bottom: 1.5rem !important;
        }

        .team-section {
            padding-top: 1.5rem !important;
        }
    }
</style>
@endpush

@section('content')
@php
    $featuredDoctor = $doctores->first();
    $heroSlides = ($heroSlides ?? collect())->values();
    $heroSlide = $heroSlides->first();
    $doctorCount = $doctores->count();
    $hospitalCount = $doctores->pluck('owner.hospital_name')->filter()->unique()->count();
    $specialtyCount = $doctores->pluck('department.name')->filter()->unique()->count();

    if (!$heroSlide) {
        $heroSlide = [
            'photo' => $featuredDoctor?->photo ?? null,
        ];
    }

    $slidePhoto = !empty($heroSlide['photo'])
        ? asset('storage/' . $heroSlide['photo'])
        : ($featuredDoctor?->photo ? asset('storage/' . $featuredDoctor->photo) : asset('assets/img/default.png'));
    $heroSliderItems = $heroSlides->isNotEmpty()
        ? $heroSlides
        : collect([[
            'photo' => $heroSlide['photo'] ?? null,
            'link' => route('app.specialists'),
        ]]);
@endphp

<section class="home-showcase">
    <div class="container-fluid">
        <div id="homeHeroTopSlider" class="carousel slide finder-hero-slider home-showcase-slider" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($heroSliderItems as $index => $slide)
                    <button type="button" data-bs-target="#homeHeroTopSlider" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($heroSliderItems as $index => $slide)
                    @php
                        $topSlidePhoto = !empty($slide['photo'])
                            ? asset('storage/' . $slide['photo'])
                            : ($featuredDoctor?->photo ? asset('storage/' . $featuredDoctor->photo) : asset('assets/img/default.png'));
                    @endphp
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="home-showcase-slide">
                            <a href="{{ $slide['link'] ?? '#' }}" class="home-showcase-slide-link">
                                <img src="{{ $topSlidePhoto }}" alt="Homepage slider image {{ $index + 1 }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($heroSliderItems->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#homeHeroTopSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#homeHeroTopSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</section>

<section class="finder-hero">
    <div class="container">
        <div class="finder-hero-slider">
            <div class="finder-hero-panel surface-card">
                <div class="row align-items-center row-gap-4 finder-hero-content-row">
                    <div class="col-lg-10 col-xl-8">
                        <div class="finder-hero-copy">
                        <span class="section-eyebrow mb-3">{{ $heroSlide['heading'] ?? 'Doctor discovery platform' }}</span>
                        <h1 class="section-title mb-3">{{ $heroSlide['title'] ?? 'Find trusted doctors, compare hospitals, and book in minutes.' }}</h1>
                        <p class="muted-copy fs-5 mb-4">{{ $heroSlide['description'] ?? 'Browse verified doctor profiles and send an appointment request in a simple patient-first flow.' }}</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ $heroSlide['primary_button_url'] ?? route('app.specialists') }}" class="btn-brand-primary">
                                {{ $heroSlide['primary_button_text'] ?? 'Find Doctors' }} <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ $heroSlide['secondary_button_url'] ?? route('app.booking') }}" class="btn-brand-secondary">
                                {{ $heroSlide['secondary_button_text'] ?? 'Quick Booking' }}
                            </a>
                        </div>
                        <div class="finder-stat-grid">
                            <div class="finder-stat">
                                <strong>{{ $doctorCount ?: 10 }}+</strong>
                                <span class="muted-copy">Active doctors to explore</span>
                            </div>
                            <div class="finder-stat">
                                <strong>{{ $hospitalCount ?: 5 }}+</strong>
                                <span class="muted-copy">Hospitals and clinics</span>
                            </div>
                            <div class="finder-stat">
                                <strong>{{ $specialtyCount ?: 6 }}+</strong>
                                <span class="muted-copy">Specialties covered</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="finder-promise-grid">
            <div class="finder-promise-card">
                <div class="finder-promise-icon"><i class="fas fa-user-doctor"></i></div>
                <h3 class="h5">{{ __('Verified doctors') }}</h3>
                <p class="muted-copy mb-0">{{ __('Browse approved doctor profiles with specialty, hospital, and professional details in one place.') }}</p>
            </div>
            <div class="finder-promise-card">
                <div class="finder-promise-icon"><i class="fas fa-location-dot"></i></div>
                <h3 class="h5">{{ __('Hospital visibility') }}</h3>
                <p class="muted-copy mb-0">{{ __('See where the doctor practices before you book, so the decision feels practical, not random.') }}</p>
            </div>
            <div class="finder-promise-card">
                <div class="finder-promise-icon"><i class="fas fa-calendar-check"></i></div>
                <h3 class="h5">{{ __('Fast booking request') }}</h3>
                <p class="muted-copy mb-0">{{ __('Send patient details directly to the selected hospital owner with a lightweight request form.') }}</p>
            </div>
        </div>
    </div>
</section>

@if(($featuredHospitals ?? collect())->isNotEmpty())
<section class="featured-hospitals-section">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between gap-3">
            <div>
                <span class="section-eyebrow mb-3">{{ __('Featured hospitals') }}</span>
                <h2 class="section-title mb-2">{{ $featuredHospitalsSection->data['title'] ?? __('Hospitals handpicked for the homepage.') }}</h2>
                <p class="muted-copy mb-0">{{ $featuredHospitalsSection->data['description'] ?? __('Admin can highlight up to ten approved hospitals here, so visitors immediately see the strongest options.') }}</p>
            </div>
            <a href="{{ route('app.hospitals') }}" class="btn-brand-secondary">{{ __('View All Hospitals') }}</a>
        </div>

        <div class="featured-hospital-grid">
            @foreach ($featuredHospitals->take(10) as $hospital)
                <article class="surface-card featured-hospital-card">
                    <img src="{{ $hospital->photo ? asset('storage/' . $hospital->photo) : asset('assets/img/register.jpg') }}" alt="{{ $hospital->hospital_name }}" class="featured-hospital-cover mb-4">
                    <div class="featured-hospital-badge mb-3">
                        <i class="fas fa-circle-check"></i>
                        {{ __('Verified hospital') }}
                    </div>
                    <h3 class="h4 mb-2">{{ $hospital->hospital_name ?: $hospital->name }}</h3>
                    <p class="muted-copy mb-3">{{ $hospital->hospital_location ?: $hospital->address ?: __('Location not added yet') }}</p>
                    <div class="featured-hospital-stats mb-4">
                        <span><i class="fas fa-user-md"></i> {{ $hospital->doctors_count }} {{ __('Doctors') }}</span>
                        <span><i class="fas fa-briefcase-medical"></i> {{ $hospital->services_count }} {{ __('Services') }}</span>
                        <span><i class="fas fa-sitemap"></i> {{ $hospital->departments_count }} {{ __('Departments') }}</span>
                    </div>
                    <p class="muted-copy mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($hospital->about_hospital ?: __('Hospital details will be updated soon.')), 120) }}</p>
                    <a href="{{ route('app.hospitals.show', ['hospital' => $hospital->id, 'slug' => \Illuminate\Support\Str::slug($hospital->hospital_name ?: $hospital->name)]) }}" class="btn-brand-primary">{{ __('View Details') }}</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(($services ?? collect())->isNotEmpty())
@includeIf('components.app.services', ['services' => $services, 'homeServicesSection' => $homeServicesSection ?? null])
@endif

@includeIf('components.app.doctors', ['doctores' => $doctores, 'featuredDoctorsSection' => $featuredDoctorsSection])

@includeIf('components.app.testimonials')

<section class="blog-section">
    <div class="container">
        <span class="section-eyebrow mb-3">{{ __('Health stories') }}</span>
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between gap-3">
            <div>
                <h2 class="section-title mb-2">{{ __('Learn before you book.') }}</h2>
                <p class="muted-copy mb-0">{{ __('Helpful content can reduce confusion and help patients choose the right doctor faster.') }}</p>
            </div>
            <a href="{{ route('app.blog') }}" class="btn-brand-secondary">{{ __('View All Articles') }}</a>
        </div>
        <div class="blog-grid">
            @foreach ($blogs->take(3) as $blog)
                <article class="blog-card">
                    <img src="{{ $blog->thumbnail_image ? asset('storage/' . $blog->thumbnail_image) : asset('assets/img/default.png') }}" alt="{{ $blog->title }}">
                    <h3 class="h5">{{ $blog->title }}</h3>
                    <p class="muted-copy">{{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($blog->description ?? '')), 120) ?: __('Read practical health insights and patient-friendly guidance from our latest articles.') }}</p>
                    <a href="{{ route('app.blog.info', ['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)]) }}">{{ __('Read article') }} <i class="fas fa-arrow-right"></i></a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
