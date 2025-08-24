<!-- Responsive Navigation Bar Start -->
<nav class="navbar">
    <div class="container nav-container">
        <div class="logo">Hospital Logo</div>
        <button class="nav-toggle" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/specialists">Specialists</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </div>
</nav>
<!-- Responsive Navigation Bar End -->

@extends('frontend.layout.masterlayout')

@section('title', 'Service History - Hospital Management')

@section('styles')
<style>
     /* --- CSS: Variables and Reset --- */
     :root {
            --primary-color: #08c7df;
            --sidebar-bg: #f8fafd;
            --sidebar-border: #e6e6e6;
            --sidebar-active: #08c7df;
            --main-bg: #fff;
            --section-bg: #f6fbfc;
            --footer-bg: #55b7c2;
            --footer-text: #fff;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: var(--section-bg);
            color: #222;
        }

        /* --- Top Bar & Navbar --- */
        .top-header {
            background: var(--primary-color);
            color: #fff;
            font-size: 15px;
            padding: 0;
            width: 100vw;
            min-width: 100vw;
        }

        .top-header-inner {
            display: flex;
            align-items: center;
            padding: 0 0 0 18px;
            height: 36px;
            width: 100vw;
        }

        .top-header-inner span {
            display: flex;
            align-items: center;
            margin-right: 24px;
            font-size: 15px;
            white-space: nowrap;
        }

        .top-header-inner i {
            margin-right: 7px;
            font-size: 15px;
        }

       /* Main Navigation */
        .main-nav {
            background-color: var(--white);
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .main-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-nav .logo {
            display: flex;
            align-items: center;
        }

        .main-nav .logo-circle {
            width: 40px;
            height: 40px;
            background-color: #1b3728;
            border-radius: 50%;
            margin-right: 10px;
        }

        .main-nav .logo span {
            font-size: 1.5em;
            font-weight: bold;
            color: var(--heading-color);
        }

        .main-nav .nav-links {
            display: flex;
        }

        .main-nav .nav-links li {
            margin-left: 30px;
        }

        .main-nav .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 400;
            transition: color 0.3s ease;
        }

        .main-nav .nav-links a.active {
            color: #22b8cf;
            border-radius: 6px;
            padding: 6px 18px;
            font-weight: 400;
        }

        .main-nav .nav-links a:hover {
            color: var(--primary-color);
        }
        .main-nav .nav-links a.active {
            color: var(--primary-color);
        } /* Mobile menu styles */
        @media (max-width: 900px) {
            .nav-links {
                display: none;
                width: 100%;
                background: #fff;
                position: absolute;
                top: 100%;
                left: 0;
                padding: 20px 0;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }

            .nav-links.active {
                display: block;
            }

            /* Hamburger animation */
            .nav-toggle .bar {
                transition: all 0.3s ease;
            }

            .nav-toggle.open .bar:nth-child(1) {
                transform: translateY(11px) rotate(45deg);
            }

            .nav-toggle.open .bar:nth-child(2) {
                opacity: 0;
            }

            .nav-toggle.open .bar:nth-child(3) {
                transform: translateY(-11px) rotate(-45deg);
            }
        }

        .icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border: 2px solid var(--primary-color);
            border-radius: 50%;
            color: var(--primary-color);
            font-size: 18px;
            margin-left: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .main-nav .nav-links a.active {
            color: var(--primary-color);
        }

        .icon-container:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .call-button {
            background-color: #22B8CF;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            text-decoration: none;
            margin-left: 20px;
            /* Added spacing from icon if needed */
        }

        .call-button:hover {
            background-color: #199CB0;
        }

        .call-button i {
            font-size: 16px;
        }

        /* --- Service Main Layout --- */
        .service-main {
            display: flex;
            max-width: 1200px;
            margin: 38px auto 0 auto;
            gap: 36px;
            padding: 0 32px;
        }

        .service-sidebar {
            width: 200px;
            background: var(--sidebar-bg);
            border-radius: 14px;
            border: 1.5px solid var(--sidebar-border);
            padding: 18px 0 18px 0;
            height: fit-content;
        }

        .service-sidebar h4 {
            text-align: center;
            font-size: 1.12em;
            font-weight: 600;
            margin: 0 0 18px 0;
            color: #444;
        }

        .service-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-list li {
            padding: 9px 24px;
            color: #222;
            border-left: 3px solid transparent;
            cursor: pointer;
            font-size: 15px;
            transition: background 0.17s, border 0.17s, color 0.17s;
        }

        .service-list li.active,
        .service-list li:hover {
            background: #eaf7fa;
            border-left: 3px solid var(--sidebar-active);
            color: var(--sidebar-active);
            font-weight: 600;
        }

        .service-list li i {
            float: right;
            font-size: 13px;
            margin-top: 3px;
        }

        /* --- Service Content --- */
        .service-content {
            flex: 1 1 0%;
            background: var(--main-bg);
            border-radius: 18px;
            padding: 32px 32px 24px 32px;
            box-shadow: 0 2px 18px rgba(44, 140, 153, 0.07);
            margin-bottom: 34px;
        }

        .service-title {
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .service-hero-img {
            display: block;
            margin: 0 auto 18px auto;
            max-width: 520px;
            width: 100%;
            border-radius: 16px;
        }

        .service-section-header {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .service-desc {
            margin-bottom: 18px;
            line-height: 1.6;
            color: #444;
        }

        .service-list-header {
            font-size: 1.05em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .service-list-bullets {
            margin-bottom: 24px;
            padding-left: 18px;
            color: #222;
            font-size: 14px;
        }

        .service-list-bullets li {
            margin-bottom: 4px;
        }

        /* --- Booking Section --- */
        .booking-section {
            background-color: #fff;
            padding: 24px;
            border-radius: 16px;
            margin-top: 24px;
        }

        .main-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .booking-container {
            background: #fff;
            display: flex;
            flex-direction: row;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44, 140, 153, 0.10);
            overflow: hidden;
            max-width: 950px;
            width: 100%;
            min-height: 410px;
            gap: 24px;
        }

        .booking-image {
            flex: 1.1;
            min-width: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .booking-image img {
            width: 100%;
            border-radius: 16px;
            max-width: 340px;
            max-height: 400px;
            object-fit: cover;
            margin: 32px 0 32px 0;
            box-shadow: 0 4px 18px rgba(44, 140, 153, 0.08);
        }

        .booking-content {
            flex: 2;
            padding: 44px 36px 36px 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .book-appointment-tag {
            display: inline-block;
            background: #eafafd;
            color: #1b6b7a;
            font-weight: 600;
            font-size: 1em;
            border-radius: 999px;
            padding: 8px 22px;
            margin-bottom: 18px;
        }

        .booking-title {
            font-size: 2em;
            font-weight: 700;
            color: #222;
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        .booking-desc {
            font-size: 1em;
            color: #444;
            margin-bottom: 22px;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
            gap: 13px;
            margin-top: 0;
        }

        .form-row {
            display: flex;
            gap: 18px;
            width: 100%;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.97em;
            color: #1b6b7a;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .form-group input,
        .form-group select {
            padding: 12px 16px;
            border: 1.5px solid #a3e2ea;
            border-radius: 8px;
            font-size: 1em;
            font-family: inherit;
            background: #fafdff;
            color: #222;
            outline: none;
            transition: border 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border: 1.5px solid #00bcd4;
        }

        .booking-btn {
            background: #00bcd4;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 32px;
            font-size: 1em;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            margin-top: 18px;
            align-self: flex-start;
            box-shadow: 0 2px 8px rgba(44, 140, 153, 0.06);
            transition: background 0.2s;
        }

        .booking-btn:hover {
            background: #009cb0;
        }

        .time-selectors {
            display: flex;
            gap: 16px;
        }

        /* --- Team Section --- */
        .team-section {
            background: #fff;
            padding: 60px 0 40px 0;
        }

        .team-header {
            text-align: left;
            margin-bottom: 32px;
        }

        .team-tag {
            background: #e0f2f7;
            color: #2c8c99;
            font-weight: 600;
            font-size: 1em;
            border-radius: 20px;
            padding: 7px 22px;
            margin-bottom: 18px;
            display: inline-block;
        }

        .team-title {
            font-size: 2.2em;
            color: #222;
            margin: 0 0 22px 0;
            font-weight: 700;
            line-height: 1.1;
        }

        .team-grid-custom {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
            justify-content: center;
            align-items: stretch;
        }

        .team-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(44, 140, 153, 0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 0 18px 0;
            min-width: 200px;
            max-width: 320px;
        }

        .team-photo-bg {
            background: #eaf8fa;
            border-radius: 18px;
            width: 100%;
            min-height: 260px;
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 10px;
        }

        .team-photo-bg img {
            width: 140px;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(44, 140, 153, 0.08);
            background: #fff;
        }

        .team-contact {
            position: absolute;
            left: 50%;
            bottom: 18px;
            transform: translateX(-50%);
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(44, 140, 153, 0.08);
            padding: 6px 18px;
            display: flex;
            gap: 18px;
            z-index: 2;
            align-items: center;
        }

        .team-contact a {
            color: #2c8c99;
            font-size: 1.25em;
            transition: color 0.2s;
        }

        .team-contact a:hover {
            color: #4a9e99;
        }

        .team-name {
            color: #2c8c99;
            font-weight: 600;
            font-size: 1.1em;
            margin-top: 12px;
            margin-bottom: 2px;
            text-align: center;
        }

        .team-role {
            color: #888;
            font-size: 1em;
            text-align: center;
        }

       /* Footer Styles */
       .site-footer {
            background-color: #55B7C2;
            color: #fff;
            padding: 40px 0;
        }

        .site-footer .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .footer-column {
            flex: 1;
            min-width: 250px;
            margin-bottom: 20px;
            padding-right: 20px;
        }

        .footer-column:last-child {
            padding-right: 0;
        }

        .logo-column {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .logo-placeholder {
            width: 60px;
            height: 60px;
            background-color: #a0dbe0;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .logo-text {
            font-size: 24px;
            margin: 0 0 10px 0;
            font-weight: normal;
        }

        .footer-column p {
            margin: 0 0 5px 0;
            font-size: 14px;
        }

        .footer-link {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: #e0f7fa;
        }

        .footer-column h4 {
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: normal;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .newsletter-form {
            display: flex;
            margin-bottom: 20px;
        }

        .newsletter-form input[type="email"] {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        .newsletter-form input[type="email"]::placeholder {
            color: #888;
        }

        .newsletter-form button {
            padding: 10px 20px;
            background-color: #fff;
            color: #55B7C2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .newsletter-form button:hover {
            background-color: #e0f7fa;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background-color: #fff;
            color: #55B7C2;
            border-radius: 50%;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            background-color: #e0f7fa;
            color: #4CAF50;
        }

        /* --- Media Queries --- */
        @media (max-width: 900px) {
            .booking-container {
                flex-direction: column;
                align-items: center;
                min-width: 0;
            }

            .booking-image {
                min-width: 0;
                width: 100%;
                justify-content: center;
            }

            .booking-image img {
                max-width: 90vw;
                margin: 24px 0 0 0;
            }

            .booking-content {
                padding: 32px 12px 22px 12px;
            }

            .team-grid-custom {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .booking-container {
                min-width: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .main-wrap {
                padding: 0;
            }

            .booking-content {
                padding: 18px 2vw 12px 2vw;
            }

            .form-row {
                flex-direction: column;
                gap: 8px;
            }

            .team-grid-custom {
                grid-template-columns: 1fr;
            }

            .service-main {
                flex-direction: column;
            }

            .service-sidebar {
                width: 100%;
            }
        }

        @media (max-width: 1100px) {
            .service-main {
                flex-direction: column;
                gap: 24px;
            }

            .service-sidebar {
                width: 100%;
                margin-bottom: 22px;
            }
        }

        @media (max-width: 700px) {

            .main-nav .container,
            .footer-inner {
                padding-left: 10px;
                padding-right: 10px;
            }

            .service-content,
            .therapist-section {
                padding-left: 7px;
                padding-right: 7px;
            }

            .service-main {
                padding-left: 4px;
                padding-right: 4px;
            }
        }
        /* Responsive Navigation (from about.blade.php) */
        .nav-toggle {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background: none;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        .nav-toggle .bar {
            width: 28px;
            height: 3px;
            background: #222;
            margin: 4px 0;
            border-radius: 2px;
            transition: 0.3s;
        }
        @media (max-width: 900px) {
            .main-nav .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 0;
                position: relative;
                width: 100%;
            }
            .main-nav .container > .logo,
            .main-nav .container > .nav-toggle,
            .main-nav .container > .icon-container,
            .main-nav .container > .call-button {
                margin: 0 4px;
            }
            .nav-toggle {
                display: flex;
            }
            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background: #fff;
                position: absolute;
                top: 100%;
                left: 0;
                z-index: 1000;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                padding: 8px 0;
            }
            .nav-links.active {
                display: flex;
            }
            .nav-links li {
                margin: 10px 0;
                text-align: left;
                width: 100%;
                padding-left: 24px;
            }
            .icon-container,
            .call-button {
                display: flex;
                align-items: center;
            }
            .call-button {
                font-size: 1em;
            }
        }
</style>
@endsection

@section('content')
    
    <header class="top-header">
        <div class="top-header-inner">
            <span><i class="fa fa-phone"></i> +88018674-45897</span>
            <span><i class="fa fa-envelope"></i> example@gmail.com</span>
            <span><i class="fa fa-map-marker-alt"></i> Dhaka, Bangladesh</span>
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
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('about')}}">About Us</a></li>
            <li><a href="{{route('services')}}" class="active">Services</a></li>
            <li><a href="{{route('specialists')}}">Specialists</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="{{route('blog')}}">Blog</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
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
            // Toggle the menu visibility
            const isVisible = navLinks.style.display === 'block';
            navLinks.style.display = isVisible ? 'none' : 'block';

            // Toggle hamburger animation
            this.classList.toggle('open');

            // Update accessibility attribute
            this.setAttribute('aria-expanded', !isVisible);
        });
    });
</script>
    <div class="service-main">
        <aside class="service-sidebar">
            <h4>Our Services</h4>
            <ul class="service-list">
                <li class="active">Cupping Therapy <i class="fa fa-chevron-right"></i></li>
                <li>Manual Therapy <i class="fa fa-chevron-right"></i></li>
                <li>Chronic Pain <i class="fa fa-chevron-right"></i></li>
                <li>Sports Injury <i class="fa fa-chevron-right"></i></li>
                <li>Electro Therapy <i class="fa fa-chevron-right"></i></li>
                <li>Laser Therapy <i class="fa fa-chevron-right"></i></li>
                <li>Ultrasound Therapy <i class="fa fa-chevron-right"></i></li>
                <li>Shockwave Therapy <i class="fa fa-chevron-right"></i></li>
            </ul>
        </aside>
        <section class="service-content">
            <div class="service-title">Cupping Therapy</div>
            <img class="service-hero-img" src="https://i.postimg.cc/nzzV3pn9/image.png" alt="Cupping Therapy">
            <div class="service-section-header">About Cupping Therapy Services</div>
            <div class="service-desc">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis minus natus nulla numquam voluptatibus
                maiores. Quam voluptatibus, voluptatum doloremque, totam, facilis molestiae laborum ad voluptatem
                distinctio suscipit? Quisquam, voluptates, maxime.
            </div>
            <div class="service-list-header">What Cupping Therapy?</div>
            <ul class="service-list-bullets">
                <li>Learn about pain and its cause.</li>
                <li>Learn about pain and its cause immediate.</li>
                <li>Learn about pain and its cause immediate.</li>
                <li>Learn about pain and its cause immediate.</li>
                <li>Learn about pain and its cause immediate.</li>
            </ul>
        </section>
    </div>
    <section class="booking-section">
        <div class="main-wrap">
            <div class="booking-container">
                <div class="booking-image">
                    <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="booking-image">
                </div>
                <div class="booking-content">
                    <div class="book-appointment-tag">Book Your Appointment</div>
                    <div class="booking-title">BOOK YOUR CONSULTATION</div>
                    <div class="booking-desc">Enter your details below and we will follow up with you to book your
                        appointment.</div>
                    <form class="booking-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="services">Services</label>
                                <select id="services" name="services">
                                    <option value="">Services Name</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <select id="doctor" name="doctor">
                                    <option value="">Doctor Name</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="your-name">Your Name*</label>
                                <input type="text" id="your-name" name="your-name" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <label for="your-phone">Your Phone</label>
                                <input type="text" id="your-phone" name="your-phone" placeholder="Your Phone Number">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" id="date" name="date" placeholder="Select Date">
                            </div>
                            <div class="form-group">
                                <label for="time">Time</label>
                                <div class="time-selectors">
                                    <select id="time-start" name="time-start">
                                        <option value="">3:00</option>
                                    </select>
                                    <select id="time-end" name="time-end">
                                        <option value="">4:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="booking-btn">Book Your Appointment <i
                                class="fa-solid fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="team-section">
        <div class="container">
            <div class="team-header">
                <span class="team-tag">Our Specialists</span>
                <h2 class="team-title">Our Dedicated & Experienced<br>Therapist Team</h2>
            </div>
            <div class="team-grid-custom">
                <div class="team-card">
                    <div class="team-photo-bg">
                        <img src="https://img.freepik.com/premium-photo/male-female-doctor-portrait-healthcare-medical-staff-concept-confident-doctor-portrait_1108314-405796.jpg"
                            alt="Dr. Emily Brown">
                    </div>
                    <div class="team-name">Dr. Emily Brown</div>
                    <div class="team-role">senior physiotherapist</div>
                </div>
                <div class="team-card">
                    <div class="team-photo-bg">
                        <img src="https://thumbs.dreamstime.com/z/studio-portrait-hispanic-brazilian-female-laboratory-scientist-lab-coat-wearing-mask-goggle-safety-cap-glove-260485549.jpg?w=576"
                            alt="Dr. Emily Brown">
                        <div class="team-contact">
                            <a href="#"><i class="fas fa-phone"></i></a>
                            <a href="#"><i class="fas fa-comment-dots"></i></a>
                            <a href="#"><i class="fas fa-info-circle"></i></a>
                        </div>
                    </div>
                    <div class="team-name">Dr. Emily Brown</div>
                    <div class="team-role">senior physiotherapist</div>
                </div>
                <div class="team-card">
                    <div class="team-photo-bg">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small_2x/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg"
                            alt="Dr. Emily Brown">
                    </div>
                    <div class="team-name">Dr. Emily Brown</div>
                    <div class="team-role">senior physiotherapist</div>
                </div>
                <div class="team-card">
                    <div class="team-photo-bg">
                        <img src="https://img.freepik.com/free-photo/nurse-with-stethoscope-white-medical-uniform-white-protective-sterile-mask_179666-205.jpg?t=st=1717959581~exp=1717963181~hmac=976a532d8fc64986f6c29f5c8c8f71972111de503411342eaffa23645e02218d&w=1800"
                            alt="Dr. Emily Brown">
                    </div>
                    <div class="team-name">Dr. Emily Brown</div>
                    <div class="team-role">senior physiotherapist</div>
                </div>
            </div>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-column logo-column">
                <div class="logo-placeholder"></div>
                <h3 class="logo-text">Logo</h3>
                <p>511 SW 10th Ave 1206, Portland, OR,<br>United States</p>
                <p><a href="#" class="footer-link">View Directions</a></p>
                <p><a href="tel:+8801857445897" class="footer-link">+88018574-45897</a></p>
                <p><a href="mailto:example@gmail.com" class="footer-link">example@gmail.com</a></p>
            </div>

            <div class="footer-column">
                <h4>View Directions</h4>
                <ul>
                    <li><a href="#" class="footer-link">About Us</a></li>
                    <li><a href="#" class="footer-link">Services</a></li>
                    <li><a href="#" class="footer-link">Our Team</a></li>
                    <li><a href="#" class="footer-link">Shop</a></li>
                    <li><a href="#" class="footer-link">Contacts</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#" class="footer-link">Cupping Therapy</a></li>
                    <li><a href="#" class="footer-link">Manual Therapy</a></li>
                    <li><a href="#" class="footer-link">Ultrasound Therapy</a></li>
                    <li><a href="#" class="footer-link">Cupping Therapy</a></li>
                    <li><a href="#" class="footer-link">Cupping Therapy</a></li>
                    <li><a href="#" class="footer-link">Cupping Therapy</a></li>
                    <li><a href="#" class="footer-link">Cupping Therapy</a></li>
                </ul>
            </div>

            <div class="footer-column subscribe-column">
                <h4>Subscribe to Our Newsletter</h4>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email..." aria-label="Your email">
                    <button type="submit">Subscribe</button>
                </form>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

@endsection
