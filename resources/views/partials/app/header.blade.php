
<header class="top-header">
    <div class="container">
        <div class="d-flex gap-3">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">About Us</a>
                    </li>
                    <li class="nav-item position-relative mega-menu-parent">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Contact Us</a>
                    </li>
                    
            </ul>
            <ul class="navbar-nav d-flex align-items-center gap-4 ms-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-link">
                    <a href="{{ route('profile') }}" class="header_user_icon" style="text-decoration: none; color: inherit;">
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
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navbar</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</div>
