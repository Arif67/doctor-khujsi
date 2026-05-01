@php
    $sectionData = $homeServicesSection->data ?? [];
@endphp

<section class="services-section py-5">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between gap-3 mb-4">
            <div>
                <span class="section-eyebrow mb-3">{{ __('Browse specialties') }}</span>
                <h2 class="section-title mb-2">{{ $sectionData['title'] ?? 'Explore care areas before choosing a doctor.' }}</h2>
                <p class="muted-copy mb-0">{{ $sectionData['description'] ?? 'Each category helps patients narrow down which doctor profile to open first.' }}</p>
            </div>
            <a href="{{ route('app.services') }}" class="btn-brand-secondary">{{ __('See All Specialties') }}</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 g-xl-5">
            @foreach ($services as $service)
                <div class="col d-flex">
                    <article class="service-card flex-fill">
                        <div class="service-image">
                            <img
                                src="{{ $service->image ? asset('storage/' . $service->image) : asset('assets/img/register.jpg') }}"
                                alt="{{ $service->title }}"
                            >
                        </div>
                        <h3 class="service-title mt-3">{{ $service->title }}</h3>
                        <p class="service-desc mt-2 mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($service->description ?: 'Find doctors in this specialty and review the profile that best matches your needs.')), 88) }}
                        </p>
                        <a href="{{ route('app.service.history', ['service' => $service->id, 'title' => \Illuminate\Support\Str::slug($service->title)]) }}" class="service-link">
                            {{ __('Explore specialty') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="specialty-cta">
            <div>
                <strong>{{ __('Not sure which specialty fits your symptoms?') }}</strong>
                <p class="muted-copy mb-0">{{ __('Start with a general booking request and the receiving hospital can guide your next step.') }}</p>
            </div>
            <a href="{{ route('app.booking') }}" class="btn-brand-primary">{{ __('Request Appointment') }}</a>
        </div>
    </div>
</section>

<style>
    .service-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        padding: 30px;
        box-shadow: 0 16px 34px rgba(15, 55, 60, 0.06);
    }

    .service-image {
        width: 100%;
        aspect-ratio: 16 / 11;
        overflow: hidden;
        border-radius: 18px;
        min-height: 240px;
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
        margin-bottom: 0;
    }

    .service-desc {
        color: var(--brand-muted);
        font-size: 1rem;
        line-height: 1.8;
    }

    .service-link {
        color: var(--brand-primary-dark);
        text-decoration: none;
        font-weight: 700;
    }

    .specialty-cta {
        margin-top: 26px;
        border-radius: 24px;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        background: linear-gradient(135deg, #eff9fa 0%, #ffffff 100%);
        border: 1px solid rgba(18, 124, 138, 0.12);
    }

    @media (max-width: 767.98px) {
        .service-card {
            padding: 24px;
        }

        .service-image {
            min-height: auto;
        }

        .specialty-cta {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
