@extends('layouts.app')

@section('title', __('Contact Us'))

@push('styles')
<style>
    .contact-page {
        padding: 40px 0 72px;
    }

    .contact-hero {
        padding: 36px;
        overflow: hidden;
        position: relative;
        background:
            radial-gradient(circle at top right, rgba(244, 162, 97, 0.2), transparent 24%),
            radial-gradient(circle at bottom left, rgba(18, 124, 138, 0.12), transparent 30%),
            linear-gradient(135deg, #eef9fa 0%, #ffffff 58%, #f8fcfc 100%);
    }

    .contact-hero::after {
        content: "";
        position: absolute;
        inset: auto -70px -90px auto;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(18, 124, 138, 0.08);
    }

    .contact-hero-copy,
    .contact-highlight-grid,
    .contact-form-card,
    .contact-info-card {
        position: relative;
        z-index: 1;
    }

    .contact-hero-copy .section-title {
        max-width: 14ch;
    }

    .contact-hero-copy .muted-copy {
        max-width: 58ch;
        line-height: 1.8;
    }

    .contact-highlight-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-top: 28px;
    }

    .contact-highlight {
        padding: 18px 20px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.84);
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .contact-highlight strong {
        display: block;
        margin-bottom: 6px;
        font-size: 1rem;
        color: var(--brand-ink);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
        gap: 24px;
        margin-top: 28px;
    }

    .contact-form-card,
    .contact-info-card {
        padding: 30px;
    }

    .contact-form-card .form-control,
    .contact-form-card .form-select {
        border-radius: 16px;
        padding: 13px 15px;
        border: 1px solid #d9e8e8;
        box-shadow: none;
    }

    .contact-info-stack {
        display: grid;
        gap: 16px;
    }

    .contact-info-item {
        padding: 18px 20px;
        border-radius: 22px;
        background: #f8fcfc;
        border: 1px solid rgba(21, 58, 63, 0.08);
    }

    .contact-info-item .small {
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    .contact-info-item strong,
    .contact-info-item a {
        color: var(--brand-ink);
        text-decoration: none;
        font-size: 1rem;
    }

    .contact-path-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
        margin-top: 26px;
    }

    .contact-path-card {
        padding: 24px;
        border-radius: 24px;
        background: #fff;
        border: 1px solid rgba(21, 58, 63, 0.08);
        box-shadow: 0 18px 40px rgba(15, 55, 60, 0.06);
    }

    .contact-path-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(18, 124, 138, 0.1);
        color: var(--brand-primary);
        font-size: 1.25rem;
        margin-bottom: 16px;
    }

    .contact-alert {
        border-radius: 18px;
    }

    @media (max-width: 991.98px) {
        .contact-highlight-grid,
        .contact-path-grid,
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575.98px) {
        .contact-page {
            padding: 26px 0 56px;
        }

        .contact-hero,
        .contact-form-card,
        .contact-info-card,
        .contact-path-card {
            padding: 22px;
        }

        .contact-hero-copy .section-title {
            max-width: none;
        }
    }
</style>
@endpush

@section('content')
<section class="contact-page">
    <div class="container">
        <div class="surface-card contact-hero">
            <div class="contact-hero-copy">
                <span class="section-eyebrow mb-3">Contact and support</span>
                <h1 class="section-title mb-3">{{ __('Need help before booking, after booking, or with a hospital issue?') }}</h1>
                <p class="muted-copy fs-5 mb-0">{{ __('Use this page for general questions, support requests, hospital complaints, or partnership contact. If you already know which doctor you want, booking is still the fastest route.') }}</p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('app.booking') }}" class="btn-brand-primary">{{ __('Book an Appointment') }}</a>
                    <a href="{{ route('app.hospitals') }}" class="btn-brand-secondary">{{ __('Browse Hospitals') }}</a>
                </div>
            </div>

            <div class="contact-highlight-grid">
                <div class="contact-highlight">
                    <strong>{{ __('General Support') }}</strong>
                    <span class="muted-copy">{{ __('Platform, doctor listing, hospital browsing, or booking guidance.') }}</span>
                </div>
                <div class="contact-highlight">
                    <strong>{{ __('Complaint or Issue') }}</strong>
                    <span class="muted-copy">{{ __('Share a bad service experience or workflow issue clearly.') }}</span>
                </div>
                <div class="contact-highlight">
                    <strong>{{ __('Fastest Path') }}</strong>
                    <span class="muted-copy">{{ __('For doctor request, direct booking usually gets the fastest response.') }}</span>
                </div>
            </div>
        </div>

        <div class="contact-grid">
            <div class="surface-card contact-form-card">
                <div class="mb-4">
                    <h2 class="h3 mb-2">{{ __('Send a Message') }}</h2>
                    <p class="muted-copy mb-0">{{ __('Write clearly so the support team can understand the issue fast and respond properly.') }}</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success contact-alert" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger contact-alert" role="alert">
                        <strong>{{ __('Message send hoyni.') }}</strong>
                        <ul class="mb-0 mt-2 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('app.contact.msg.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="contact-name" class="form-label">{{ __('Your Name') }}</label>
                        <input id="contact-name" name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter your name') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="contact-email" class="form-label">{{ __('Your Email') }}</label>
                        <input id="contact-email" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}">
                    </div>
                    <div class="col-12">
                        <label for="contact-subject" class="form-label">{{ __('Subject') }}</label>
                        <input id="contact-subject" name="subject" type="text" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" placeholder="{{ __('e.g. Booking issue, hospital complaint, general help') }}">
                    </div>
                    <div class="col-12">
                        <label for="contact-message" class="form-label">{{ __('Message') }}</label>
                        <textarea id="contact-message" name="message" rows="6" class="form-control @error('message') is-invalid @enderror" placeholder="{{ __('Explain the issue or question in detail...') }}">{{ old('message') }}</textarea>
                    </div>
                    <div class="col-12 d-flex flex-wrap gap-3 align-items-center">
                        <button type="submit" class="btn-brand-primary">{{ __('Send Message') }}</button>
                        <span class="small muted-copy">{{ __('For emergency medical need, contact the hospital directly instead of waiting for email support.') }}</span>
                    </div>
                </form>
            </div>

            <div class="surface-card contact-info-card">
                <div class="mb-4">
                    <h2 class="h3 mb-2">{{ __('Support Information') }}</h2>
                    <p class="muted-copy mb-0">{{ __('Use the right path based on what you need.') }}</p>
                </div>

                <div class="contact-info-stack">
                    <div class="contact-info-item">
                        <div class="small muted-copy mb-2">{{ __('Booking route') }}</div>
                        <strong>{{ __('Doctor appointment request') }}</strong>
                        <p class="muted-copy mb-3">{{ __('If your goal is to see a doctor, use the booking flow first.') }}</p>
                        <a href="{{ route('app.booking') }}" class="btn-brand-secondary">{{ __('Go to Booking') }}</a>
                    </div>
                    <div class="contact-info-item">
                        <div class="small muted-copy mb-2">{{ __('Hospital directory') }}</div>
                        <strong>{{ __('Compare hospitals first') }}</strong>
                        <p class="muted-copy mb-3">{{ __('Browse approved hospitals and check their profile before messaging support.') }}</p>
                        <a href="{{ route('app.hospitals') }}" class="btn-brand-secondary">{{ __('View Hospitals') }}</a>
                    </div>
                    <div class="contact-info-item">
                        <div class="small muted-copy mb-2">{{ __('Email') }}</div>
                        <strong><a href="mailto:support@doctorfinder.test">support@doctorfinder.test</a></strong>
                    </div>
                    <div class="contact-info-item">
                        <div class="small muted-copy mb-2">{{ __('Phone') }}</div>
                        <strong><a href="tel:+8801700000000">+880 1700-000000</a></strong>
                    </div>
                    <div class="contact-info-item">
                        <div class="small muted-copy mb-2">{{ __('Support window') }}</div>
                        <strong>{{ __('Every day, 9:00 AM - 8:00 PM') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-path-grid">
            <div class="contact-path-card">
                <div class="contact-path-icon"><i class="fas fa-circle-question"></i></div>
                <h3 class="h5">{{ __('General Question') }}</h3>
                <p class="muted-copy mb-0">{{ __('Use contact form if you need platform help, browsing support, or process explanation.') }}</p>
            </div>
            <div class="contact-path-card">
                <div class="contact-path-icon"><i class="fas fa-triangle-exclamation"></i></div>
                <h3 class="h5">{{ __('Hospital Complaint') }}</h3>
                <p class="muted-copy mb-0">{{ __('If a hospital gave poor service, mention hospital name, date, and exact issue clearly.') }}</p>
            </div>
            <div class="contact-path-card">
                <div class="contact-path-icon"><i class="fas fa-handshake"></i></div>
                <h3 class="h5">{{ __('Business or Listing') }}</h3>
                <p class="muted-copy mb-0">{{ __('Hospitals or partners can use this same page for listing or coordination related contact.') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
