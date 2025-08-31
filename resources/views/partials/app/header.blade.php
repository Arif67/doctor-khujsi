
<header class="top-header">
    <div class="container">
        <div class="contact-info">
            <span><i class="fas fa-phone"></i> +88018674-45897</span>
            <span><i class="fas fa-envelope"></i> example@gmail.com</span>
            <span><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</span>
        </div>
    </div>
</header>

 <nav class="main-nav">
    <div class="container">
        <div class="logo">
            <div class="logo-circle"></div>
            <span>LOGO</span>
        </div>
        <button class="nav-toggle" aria-label="Toggle navigation">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="active">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('specialists') }}">Specialists</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <a href="{{ route('profile') }}" class="icon-container" style="text-decoration: none; color: inherit;">
            <i class="fas fa-user"></i>
        </a>
        <div class="call-button">
            <span>+88018574-45897</span>
            <i class="fa-solid fa-phone"></i>
        </div>
    </div>
</nav>