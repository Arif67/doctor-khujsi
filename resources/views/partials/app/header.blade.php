@php
    $headerUserPhoto = asset('assets/img/default.png');

    if (Auth::check()) {
        if ($globalUser->photo) {
            $headerUserPhoto = asset('storage/' . $globalUser->photo);
        } elseif ($globalUser->gender) {
            $genderPhoto = public_path('assets/img/' . ucfirst(strtolower($globalUser->gender)) . '.jpg');

            if (file_exists($genderPhoto)) {
                $headerUserPhoto = asset('assets/img/' . ucfirst(strtolower($globalUser->gender)) . '.jpg');
            }
        }
    }
@endphp

<header class="finder-topbar">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex flex-wrap align-items-center gap-3 small">
            <span><i class="fas fa-phone-alt"></i> {{ __('24/7 Booking Help') }}: +880 1740-716676</span>
            <span><i class="fas fa-envelope"></i> care@doctorfinder.app</span>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-3 small">
            <span><i class="fas fa-hospital"></i> {{ __('Verified doctors from trusted hospitals') }}</span>
            <span><i class="fas fa-map-marker-alt"></i> {{ __('Dhaka, Bangladesh') }}</span>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg finder-navbar">
    <div class="container navbar_container flex flex-row align-items-center">
        <a class="navbar-brand finder-brand" href="{{ route('app.home') }}">
            <span class="finder-brand-mark">
                <i class="fas fa-stethoscope"></i>
            </span>
            <span>
                <strong>Doctor Finder</strong>
                <small>{{ __('Find the right doctor faster') }}</small>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav header_main_nav d-flex align-items-center gap-3 m-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item {{ Route::is('app.home') ? 'active':'' }}">
                    <a class="nav-link" href="{{route('app.home')}}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item {{ Route::is('app.about') ? 'active':'' }}">
                    <a class="nav-link" href="{{route('app.about')}}">{{ __('About') }}</a>
                </li>
                <li class="nav-item {{ Route::is(['app.services','app.service.history']) ? 'active':'' }}" >
                    <a class="nav-link" href="{{route('app.services')}}">{{ __('Service') }}</a>
                </li>
                <li class="nav-item {{ Route::is(['app.hospitals','app.hospitals.show']) ? 'active':'' }}" >
                    <a class="nav-link" href="{{route('app.hospitals')}}">{{ __('Hospitals') }}</a>
                </li>
                <li class="nav-item {{ Route::is('app.specialists') ? 'active':'' }}" >
                    <a class="nav-link" href="{{route('app.specialists')}}">{{ __('Find Doctors') }}</a>
                </li>
                <li class="nav-item {{ Route::is('app.blog') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('app.blog') }}">{{ __('Blog') }}</a>
                </li>
                <li class="nav-item {{ Route::is('app.contact') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('app.contact') }}">{{ __('Contact') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex align-items-center gap-4 ms-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item">
                    <div class="locale-switcher">
                        <a href="{{ route('language.switch', 'en') }}" class="locale-chip {{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
                        <a href="{{ route('language.switch', 'bn') }}" class="locale-chip {{ app()->getLocale() === 'bn' ? 'is-active' : '' }}">বাং</a>
                    </div>
                </li>
                <li class="nav-link">
                   <a href="{{ route('auth.redirect') }}" class="header_user_icon" style="text-decoration: none; color: inherit;">
                    @if (Auth::check())
                        <img src="{{ $headerUserPhoto }}"
                            class="rounded-circle shadow-sm"
                            width="28" height="30" alt="Patient">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </a>
                </li>
                <li class="nav-item">
                    <a class="btn-brand-primary py-2 px-3" href="{{ route('app.booking') }}">
                        <i class="fas fa-calendar-check"></i>
                        {{ __('Book Now') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Offcanvas Menu for Mobile -->
<div class="offcanvas offcanvas-start" style="width: 300px" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
       <div class="d-flex align-items-center gap-3">
            <a href="{{route('auth.redirect')}}" class="header_user_icon">
                @if (Auth::check())
                    <img src="{{ $headerUserPhoto }}"
                        class="rounded-circle shadow-sm"
                        width="28" height="30" alt="Patient">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </a>
            <div>
                <div class="fw-bold">Doctor Finder</div>
                <div class="text-muted small">{{ __('Find and book verified doctors') }}</div>
            </div>
       </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item {{ Route::is('app.home') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('app.home') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item {{ Route::is('app.about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.about') }}">{{ __('About') }}</a>
            </li>
            <li class="nav-item {{ Route::is(['app.services','app.service.history']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.services') }}">{{ __('Specialties') }}</a>
            </li>
            <li class="nav-item {{ Route::is(['app.hospitals','app.hospitals.show']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.hospitals') }}">{{ __('Hospitals') }}</a>
            </li>
            <li class="nav-item {{ Route::is('app.specialists') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.specialists') }}">{{ __('Find Doctors') }}</a>
            </li>
            
            <li class="nav-item {{ Route::is('app.blog') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.blog') }}">{{ __('Blog') }}</a>
            </li>
            <li class="nav-item {{ Route::is('app.contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.contact') }}">{{ __('Contact') }}</a>
            </li>
            <li class="nav-item">
                <div class="locale-switcher mobile">
                    <a href="{{ route('language.switch', 'en') }}" class="locale-chip {{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
                    <a href="{{ route('language.switch', 'bn') }}" class="locale-chip {{ app()->getLocale() === 'bn' ? 'is-active' : '' }}">বাং</a>
                </div>
            </li>
            <li class="nav-item mt-3">
                <a class="btn-brand-primary w-100" href="{{ route('app.booking') }}">{{ __('Book Appointment') }}</a>
            </li>
        </ul>
    </div>
</div>

<style>
    .finder-topbar {
        padding: 12px 0;
        background: #0f2f33;
        color: rgba(255, 255, 255, 0.86);
        font-size: 0.88rem;
    }

    .finder-navbar {
        padding: 18px 0;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(21, 58, 63, 0.08);
        position: sticky;
        top: 0;
        z-index: 1050;
    }

    .finder-brand {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: var(--brand-ink);
    }

    .finder-brand strong {
        display: block;
        font-family: "Sora", sans-serif;
        font-size: 1.05rem;
        line-height: 1.1;
    }

    .finder-brand small {
        display: block;
        color: var(--brand-muted);
        font-size: 0.78rem;
    }

    .finder-brand-mark {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #127c8a, #1fa6a5);
        color: #fff;
        box-shadow: 0 16px 28px rgba(18, 124, 138, 0.24);
    }

    .finder-navbar .nav-link {
        color: var(--brand-ink);
        font-weight: 700;
        padding: 0 !important;
    }

    .finder-navbar .nav-item.active .nav-link,
    .offcanvas-body .navbar-nav .nav-item.active a {
        color: var(--brand-primary);
    }

    .finder-navbar .navbar-nav {
        row-gap: 18px;
    }

    .finder-navbar .navbar-toggler {
        border: none;
        padding: 0;
        color: var(--brand-ink);
        font-size: 1.3rem;
    }

    .finder-navbar .navbar-toggler:focus {
        box-shadow: none;
    }

    .locale-switcher {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .locale-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 36px;
        padding: 0 12px;
        border-radius: 999px;
        border: 1px solid rgba(18, 124, 138, 0.18);
        text-decoration: none;
        color: var(--brand-primary-dark);
        font-weight: 700;
        font-size: 0.8rem;
        background: #fff;
    }

    .locale-chip.is-active {
        background: var(--brand-primary);
        border-color: var(--brand-primary);
        color: #fff;
    }

    .locale-switcher.mobile {
        margin-top: 8px;
    }

    @media (max-width: 991.98px) {
        .finder-topbar {
            display: none;
        }
    }
</style>
