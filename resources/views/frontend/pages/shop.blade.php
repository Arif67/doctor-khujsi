@extends('frontend.layout.masterlayout')

@section('title', 'Medical Shop - Hospital Management')

@section('styles')
<style>
    .shop-container {
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
}
@media (max-width: 900px) {
    .shop-container {
        padding: 30px 4vw;
    }
    .shop-title {
        font-size: 1.3em;
    }
}
@media (max-width: 600px) {
    .shop-container {
        padding: 16px 2vw;
    }
    .shop-title {
        font-size: 1.1em;
    }
}
        padding: 60px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .shop-title {
        text-align: center;
        margin-bottom: 40px;
    }
</style>
@endsection

@section('content')
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
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('specialists') }}">Specialists</a></li>
            <li><a href="{{ route('shop') }}" class="active">Shop</a></li>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.querySelector('.nav-toggle');
        const navLinks = document.querySelector('.nav-links');
        navToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    });
</script>
    <div class="shop-container">
        <h1 class="shop-title">Medical Products Shop</h1>
        <p>Coming soon - Our online medical shop will be available shortly.</p>
    </div>

    @include('frontend.partials.footer')
@endsection
