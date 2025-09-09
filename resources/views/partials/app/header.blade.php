
<header class="top-header">
    <div class="container">
        <div class="d-flex flex-md-row flex-column  gap-1 gap-lg-3">
            <span class="d-flex gap-1 align-items-center"><i class="fas fa-phone"></i> +88018674-45897</span>
            <span class="d-flex gap-1 align-items-center"><i class="fas fa-envelope"></i> example@gmail.com</span>
            <span class="d-flex gap-1 align-items-center"><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</span>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg app_header tm-bg-primary ">
    <div class="container navbar_container flex flex-row align-items-center">
        <a class="navbar-brand" href="">
            <img class="app_logo" src="{{ asset('assets/img/logo.jpg') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav header_main_nav d-flex align-items-center gap-3 m-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item {{ Route::is('app.home') ? 'active':'' }}">
                    <a class="nav-link" href="{{route('app.home')}}">Home</a>
                </li>
                <li class="nav-item {{ Route::is('app.about') ? 'active':'' }}">
                    <a class="nav-link" href="{{route('app.about')}}">About Us</a>
                </li>
                <li class="nav-item {{ Route::is(['app.services','app.service.history']) ? 'active':'' }}" >
                    <a class="nav-link" href="{{route('app.services')}}">Services</a>
                </li>
                <li class="nav-item {{ Route::is('app.specialists') ? 'active':'' }}" >
                    <a class="nav-link" href="{{route('app.specialists')}}">Specialists</a>
                </li>
                <li class="nav-item {{ Route::is('app.blog') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('app.blog') }}">Blog</a>
                </li>
                <li class="nav-item {{ Route::is('app.contact') ? 'active':'' }}">
                    <a class="nav-link" href="{{ route('app.contact') }}">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex align-items-center gap-4 ms-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-link">
                    <a href="{{route('patient.dashboard')}}" class="header_user_icon" style="text-decoration: none; color: inherit;">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
                <li class="nav-item header_call_button">
                    <a class="nav-link" href="">
                        <i class="fa-solid fa-phone"></i>
                        01740716676
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
        <a href="{{route('patient.dashboard')}}" class="header_user_icon">
                <i class="fas fa-user"></i>
            </a>
            <a class="nav-link" href="" style="color:#00bcd4;">
                <i class="fa-solid fa-phone"></i>
                01740716676
            </a>
       </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item {{ Route::is('app.home') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('app.home') }}">Home</a>
            </li>
            <li class="nav-item {{ Route::is('app.about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.about') }}">About Us</a>
            </li>
            <li class="nav-item {{ Route::is(['app.services','app.service.history']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.services') }}">Services</a>
            </li>
            <li class="nav-item {{ Route::is('app.specialists') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.specialists') }}">Specialists</a>
            </li>
            
            <li class="nav-item {{ Route::is('app.blog') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.blog') }}">Blog</a>
            </li>
            <li class="nav-item {{ Route::is('app.contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('app.contact') }}">Contact</a>
            </li>
        </ul>
    </div>
</div>

<style>
    .offcanvas-body .navbar-nav .nav-item.active a{
        color: #00bcd4;
    }
</style>