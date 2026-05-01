@extends('layouts.app')

@section('title', __('Our Services - Hospital Management'))

@section('content')
<section class="services-section">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="services-hero-img-wrap">
                    <img src="{{ asset('assets/img/register.jpg') }}" alt="{{ __('Hospital care team') }}">
                </div>
            </div>
            <div class="col-md-6">
                 <div class="services-hero-content">
                    <span class="services-hero-pill">{{ __('Our Services') }}</span>
                    <div class="heading_title mb-4">{{ __('We Provide The Best') }}<br>{{ __('Services') }}</div>
                    <div class="services-hero-desc">{{ __('World-class rehabilitation solutions and individualized recovery plans, from acute care to ongoing outpatient treatment and beyond.') }}</div>
                </div>    
            </div>
        </div>
    </div>
</section>

<section class="services-section py-4 py-lg-5" style="background: none">
    <div class="container px-4 px-md-0">
            <div class="row py-3">
                <div class="d-flex justify-content-between align-items-center">
                <span class="services-pill">{{ __('Our Services') }}</span>
            </div>
        </div>

        <div class="services-title heading_title">{{ __('We Provide The Best') }}<br>{{ __('Services') }}</div>
         <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 g-xl-5">
           @foreach ($services as $service)
    <div class="col d-flex">
        <a href="{{ route('app.service.history', ['service' => $service->id, 'title' => \Illuminate\Support\Str::slug($service->title)]) }}" 
           class="service-card card flex-fill d-flex flex-column text-decoration-none text-dark">

            <div class="service-image">
                <img
                    src="{{ $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg') }}"
                    alt="{{ $service->title }}"
                >
            </div>

            <div class="service-title mt-2">{{ $service->title }}</div>

            <div class="service-desc mt-2">
                {{ $service->description
                    ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($service->description)), 70)
                    : __('No Description')
                }}
            </div>

            <br>

            <div class="text-end mt-auto">
                <span class="service-arrow"><i class="fas fa-arrow-right"></i></span>
            </div>

        </a>
    </div>
@endforeach
        </div>
        <div class="services-bottom-bar d-flex gap-3 flex-column flex-lg-row justify-content-between mt-4">
            <div class="services-bottom-left">
                <div class="bottom-icon"><i class="fas fa-info-circle"></i></div>
                <div>
                    <div class="bottom-title">{{ __('Ready to start your journey to recovery?') }}</div>
                    <div class="bottom-desc">{{ __('We understand that injuries and acute pain can unexpectedly. Our emergency physiotherapy.') }}</div>
                </div>
            </div>
            <a href="{{ route('app.booking') }}" class="bottom-cta">{{ __('Book An Appointment') }} <span class="arrow">→</span></a>
        </div>
    </div>
</section>

<style>
    .service-card {
        padding: 24px;
        border-radius: 20px;
    }

    .service-image {
        width: 100%;
        aspect-ratio: 16 / 11;
        overflow: hidden;
        border-radius: 16px;
        margin-bottom: 16px;
    }

    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .service-title {
        font-size: 1.35rem;
        font-weight: 700;
    }

    .service-desc {
        font-size: 1rem;
        line-height: 1.75;
    }

    @media (min-width: 1200px) {
        .service-card {
            padding: 30px;
        }

        .service-image {
            min-height: 260px;
        }
    }
</style>

@includeIf('components.app.testimonials')
@endsection
