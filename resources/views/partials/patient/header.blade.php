<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top shadow-sm">
    <div class="container-fluid">
        <!-- Sidebar toggle button for mobile -->
        <button class="btn btn-outline-secondary d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
            ☰
        </button>

        <!-- Logo -->
        <a class="navbar-brand" href="">
            <img class="app_logo" src="{{ asset('assets/img/logo.jpg') }}" alt="">
        </a>

        <!-- Right side dropdown -->
        <div class="dropdown ms-auto">
            <a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-2" width="32" height="32" alt="User">
                John Doe
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item {{Route::is('patient.profile') ? 'active':''}}" href="{{route('patient.profile')}}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
