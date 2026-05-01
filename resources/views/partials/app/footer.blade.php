<footer class="site-footer">
    <div class="container px-4 px-md-0">
        <div class="footer-cta surface-card">
            <div>
                <span class="section-eyebrow mb-3">{{ __('Need help choosing?') }}</span>
                <h2 class="h3 mb-2">{{ __('Tell us your problem, we will guide you to the right doctor.') }}</h2>
                <p class="mb-0 muted-copy">{{ __('Browse verified profiles, compare hospitals, then send a booking request in under two minutes.') }}</p>
            </div>
            <a href="{{ route('app.booking') }}" class="btn-brand-primary">{{ __('Start Booking') }}</a>
        </div>

        <div class="row row-gap-5 mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="footer-column pe-lg-4">
                    <a class="finder-brand mb-4" href="{{ route('app.home') }}">
                        <span class="finder-brand-mark">
                            <i class="fas fa-stethoscope"></i>
                        </span>
                        <span>
                            <strong>Doctor Finder</strong>
                            <small>{{ __('Find the right doctor faster') }}</small>
                        </span>
                    </a>
                    <p class="muted-copy mb-3">{{ __('A patient-first platform for discovering trusted doctors, checking specialties, and sending fast appointment requests.') }}</p>
                    <p class="mb-2"><a href="tel:+8801740716676" class="footer-link">+880 1740-716676</a></p>
                    <p class="mb-2"><a href="mailto:care@doctorfinder.app" class="footer-link">care@doctorfinder.app</a></p>
                    <p class="mb-0 muted-copy">{{ __('Dhaka, Bangladesh') }}</p>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="footer-column">
                    <h4>{{ __('Explore') }}</h4>
                    <ul>
                        <li><a href="{{ route('app.home') }}" class="footer-link">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('app.specialists') }}" class="footer-link">{{ __('Find Doctors') }}</a></li>
                        <li><a href="{{ route('app.services') }}" class="footer-link">{{ __('Specialties') }}</a></li>
                        <li><a href="{{ route('app.blog') }}" class="footer-link">{{ __('Health Blog') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-3">
                <div class="footer-column">
                    <h4>{{ __('For Patients') }}</h4>
                    <ul>
                        <li><a href="{{ route('app.booking') }}" class="footer-link">{{ __('Book Appointment') }}</a></li>
                        <li><a href="{{ route('app.about') }}" class="footer-link">{{ __('How It Works') }}</a></li>
                        <li><a href="{{ route('app.contact') }}" class="footer-link">{{ __('Support') }}</a></li>
                        <li><a href="{{ route('auth.redirect') }}" class="footer-link">{{ __('Patient Login') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-lg-3">
                <div class="footer-column">
                    <h4>{{ __('Why people use it') }}</h4>
                    <ul class="footer-points">
                        <li>{{ __('Verified doctor profiles') }}</li>
                        <li>{{ __('Hospital and location visibility') }}</li>
                        <li>{{ __('Quick request without account') }}</li>
                        <li>{{ __('Simple patient-friendly flow') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .site-footer {
        padding: 48px 0 56px;
        margin-top: 48px;
        background:
            radial-gradient(circle at top right, rgba(244, 162, 97, 0.16), transparent 28%),
            linear-gradient(180deg, #103438 0%, #0d2a2e 100%);
        color: #fff;
    }

    .footer-cta {
        padding: 28px;
        margin-top: -92px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .site-footer .finder-brand {
        color: #fff;
    }

    .site-footer .finder-brand small,
    .site-footer .muted-copy {
        color: rgba(255, 255, 255, 0.72);
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.86);
        text-decoration: none;
    }

    .footer-link:hover {
        color: #fff;
    }

    .footer-column h4 {
        font-family: "Sora", sans-serif;
        font-size: 1rem;
        margin-bottom: 16px;
    }

    .footer-column ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-column li + li {
        margin-top: 10px;
    }

    .footer-points li {
        color: rgba(255, 255, 255, 0.76);
        padding-left: 18px;
        position: relative;
    }

    .footer-points li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--brand-accent);
    }

    @media (max-width: 767.98px) {
        .footer-cta {
            flex-direction: column;
            align-items: flex-start;
            margin-top: 0;
        }
    }
</style>
