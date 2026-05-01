@extends('layouts.app')

@section('title', 'Service Details - Hospital Management')

@push('styles')
<style>
    .service-details-page {
        padding: 38px 0 64px;
        background:
            radial-gradient(circle at top left, rgba(24, 144, 156, 0.12), transparent 34%),
            linear-gradient(180deg, #f7fbfc 0%, #ffffff 58%);
    }

    .service-hero-card {
        background: #ffffff;
        border: 1px solid rgba(17, 76, 84, 0.08);
        border-radius: 28px;
        box-shadow: 0 24px 60px rgba(13, 61, 66, 0.08);
        overflow: hidden;
    }

    .service-hero-media {
        height: 100%;
        min-height: 320px;
    }

    .service-hero-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .service-hero-body {
        padding: 34px;
    }

    .service-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        background: rgba(20, 139, 151, 0.1);
        color: #0d6f79;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .service-headline {
        font-size: clamp(2rem, 3vw, 3rem);
        font-weight: 600;
        color: #16393d;
        line-height: 1.1;
        margin: 18px 0 16px;
    }

    .service-summary {
        color: #567276;
        font-size: 1rem;
        line-height: 1.8;
        max-width: 58ch;
    }

    .service-stat-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-top: 28px;
    }

    .service-stat {
        padding: 18px;
        border-radius: 20px;
        background: #f4fbfb;
        border: 1px solid rgba(17, 76, 84, 0.08);
    }

    .service-stat strong {
        display: block;
        color: #16393d;
        font-size: 1.15rem;
        font-weight: 700;
    }

    .service-stat span {
        display: block;
        margin-top: 5px;
        color: #5f7a7e;
        font-size: 0.95rem;
    }

    .service-main-card,
    .service-sidebar {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(17, 76, 84, 0.08);
        box-shadow: 0 16px 44px rgba(13, 61, 66, 0.06);
    }

    .service-main-card {
        padding: 30px;
    }

    .service-section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #16393d;
        margin-bottom: 14px;
    }

    .service-rich-desc {
        color: #526d71;
        line-height: 1.9;
        font-size: 1rem;
    }

    .service-feature-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-top: 24px;
    }

    .service-feature {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 18px;
        border-radius: 18px;
        background: #f8fcfc;
        border: 1px solid rgba(17, 76, 84, 0.07);
    }

    .service-feature-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(20, 139, 151, 0.12);
        color: #0d6f79;
        flex-shrink: 0;
    }

    .service-feature strong {
        display: block;
        color: #16393d;
        margin-bottom: 4px;
    }

    .service-feature span {
        color: #5f7a7e;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .service-cta {
        margin-top: 28px;
        padding: 24px;
        border-radius: 22px;
        background: linear-gradient(135deg, #10383d 0%, #17616a 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .service-cta p {
        margin: 8px 0 0;
        color: rgba(255, 255, 255, 0.8);
    }

    .service-cta .btn {
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 700;
        white-space: nowrap;
    }

    .service-sidebar {
        padding: 24px;
        position: sticky;
        top: 100px;
    }

    .service-sidebar h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #16393d;
        margin-bottom: 16px;
    }

    .service-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 12px;
    }

    .service-list-link {
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 12px;
        border-radius: 18px;
        text-decoration: none;
        border: 1px solid rgba(17, 76, 84, 0.08);
        background: #fbfefe;
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .service-list-link:hover,
    .service-list-link.active {
        transform: translateY(-2px);
        border-color: rgba(20, 139, 151, 0.35);
        box-shadow: 0 16px 28px rgba(13, 61, 66, 0.08);
    }

    .service-list-thumb {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        overflow: hidden;
        flex-shrink: 0;
        background: #eef6f6;
    }

    .service-list-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .service-list-copy strong {
        display: block;
        color: #16393d;
        font-size: 0.98rem;
    }

    .service-list-copy span {
        color: #5f7a7e;
        font-size: 0.9rem;
    }

    @media (max-width: 991.98px) {
        .service-sidebar {
            position: static;
        }

        .service-stat-grid,
        .service-feature-list {
            grid-template-columns: 1fr;
        }

        .service-cta {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 767.98px) {
        .service-hero-body,
        .service-main-card,
        .service-sidebar {
            padding: 22px;
        }
    }
</style>
@endpush

@php
use Illuminate\Support\Str;
@endphp

@php
    $serviceImage = $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg');
    $otherServices = $services->where('id', '!=', $service->id)->take(6);
    $serviceHighlights = [
        ['icon' => 'fas fa-user-md', 'title' => 'Specialist Review', 'desc' => 'Experienced clinicians assess symptoms and create a practical care plan.'],
        ['icon' => 'fas fa-stethoscope', 'title' => 'Early Detection', 'desc' => 'Focused evaluation helps identify issues before they become more serious.'],
        ['icon' => 'fas fa-heartbeat', 'title' => 'Follow-up Support', 'desc' => 'Patients receive guidance for recovery, prevention, and consistent monitoring.'],
        ['icon' => 'fas fa-notes-medical', 'title' => 'Personalized Care', 'desc' => 'Recommendations are adjusted based on age, symptoms, history, and wellness goals.'],
    ];
@endphp

@section('content')
<div class="service-details-page">
    <div class="container">
        <div class="service-hero-card mb-4">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-5">
                    <div class="service-hero-media">
                        <img src="{{ $serviceImage }}" alt="{{ $service->title }}">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="service-hero-body">
                        <span class="service-pill"><i class="fas fa-heartbeat"></i> Trusted Health Service</span>
                        <h1 class="service-headline">{{ $service->title }}</h1>
                        <p class="service-summary">
                            {{ Str::limit(strip_tags($service->description ?: 'Reliable treatment support designed to help patients receive the right care at the right time.'), 260) }}
                        </p>

                        <div class="service-stat-grid">
                            <div class="service-stat">
                                <strong>Patient First</strong>
                                <span>Comfortable guidance from consultation to follow-up.</span>
                            </div>
                            <div class="service-stat">
                                <strong>Modern Care</strong>
                                <span>Structured treatment planning with practical next steps.</span>
                            </div>
                            <div class="service-stat">
                                <strong>Fast Support</strong>
                                <span>Easy appointment path and specialist coordination.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <section class="col-lg-8">
                <div class="service-main-card">
                    <h2 class="service-section-title">About This Service</h2>
                    <div class="service-rich-desc">
                        {!! $service->description ?: 'No description available.' !!}
                    </div>

                    <div class="service-feature-list">
                        @foreach ($serviceHighlights as $highlight)
                            <div class="service-feature">
                                <div class="service-feature-icon">
                                    <i class="{{ $highlight['icon'] }}"></i>
                                </div>
                                <div>
                                    <strong>{{ $highlight['title'] }}</strong>
                                    <span>{{ $highlight['desc'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="service-cta">
                        <div>
                            <strong>Need help choosing the right doctor for {{ $service->title }}?</strong>
                            <p>Book an appointment and get connected with the right specialist faster.</p>
                        </div>
                        <a href="{{ route('app.booking') }}" class="btn btn-light">Book Appointment</a>
                    </div>
                </div>
            </section>

            <aside class="col-lg-4">
                <div class="service-sidebar">
                    <h4>More Health Services</h4>
                    <ul class="service-list">
                        @foreach($otherServices as $s)
                            @php
                                $thumb = $s->image ? asset('storage/' . $s->image) : asset('assets/img/register.jpg');
                            @endphp
                            <li>
                                <a
                                    href="{{ route('app.service.history', ['service' => $s->id, 'title' => Str::slug($s->title)]) }}"
                                    class="service-list-link {{ $service->id == $s->id ? 'active' : '' }}"
                                >
                                    <span class="service-list-thumb">
                                        <img src="{{ $thumb }}" alt="{{ $s->title }}">
                                    </span>
                                    <span class="service-list-copy">
                                        <strong>{{ Str::limit($s->title, 28) }}</strong>
                                        <span>{{ Str::limit(strip_tags($s->description), 52) }}</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
