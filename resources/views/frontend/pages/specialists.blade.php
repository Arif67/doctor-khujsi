<x-app-layout>
    <title>Our Specialists - Hospital Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary-color: #00bcd4;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
            --text-color: #333;
            --heading-color: #2c3e50;
            --white: #ffffff;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f8fcfd;
            color: #222;
            box-sizing: border-box;
            line-height: 1.6;
        }

        body {
            min-width: 320px;
            font-size: 16px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100%;
            display: block;
        }

        * {
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .top-header {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 10px 0;
            font-size: 0.9em;
        }

        .top-header .container {
            display: flex;
            justify-content: flex-start;
            /* Align items to the left */
            align-items: center;
        }

        .top-header .contact-info span {
            margin-right: 20px;
        }

        .top-header .contact-info i {
            margin-right: 5px;
        }

        @media (max-width: 480px) {
            .top-header .container {
                flex-direction: column;
                text-align: center;
            }

            .top-header p {
                margin-bottom: 5px;
            }
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

        /* Mobile menu styles */
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

        @media (max-width: 900px) {
            .main-nav .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 0;
                position: relative;
                width: 100%;
            }

            .main-nav .container>.logo,
            .main-nav .container>.nav-toggle,
            .main-nav .container>.icon-container,
            .main-nav .container>.call-button {
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
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

            .main-nav .container>.logo,
            .main-nav .container>.nav-toggle,
            .main-nav .container>.icon-container,
            .main-nav .container>.call-button {
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
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

        .main-nav .nav-links li {
            margin-left: 30px;
        }

        .main-nav .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .main-nav .nav-links a.active {
            color: var(--primary-color);
            border-bottom: none;
            padding-bottom: 4px;
        }


        .main-nav .nav-links a:hover {
            color: var(--primary-color);
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

        /* Services Section */
        .services-section {
            padding: 60px 0;
            background-color: #eafafd;
        }

        .services-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .services-container.rtl-section {
            flex-direction: row-reverse;
        }

        .services-img img {
            width: 100%;
            max-width: 450px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 6px 30px rgba(44, 140, 153, 0.08);
        }

        .services-content {
            max-width: 550px;
        }

        .services-pill {
            display: inline-block;
            background: #bbe0e4;
            color: #3a3939;
            font-weight: 600;
            font-size: 16px;
            border-radius: 20px;
            padding: 8px 22px;
            margin-bottom: 20px;
        }

        .services-title {
            font-size: 32px;
            color: #222;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .services-desc {
            font-size: 18px;
            color: #444;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* RTL specific styles */
        .rtl-section .services-content {
            text-align: right;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .services-container {
                flex-direction: column;
                gap: 40px;
            }

            .services-container.rtl-section {
                flex-direction: column;
            }

            .services-content,
            .rtl-section .services-content {
                text-align: center;
                max-width: 100%;
            }

            .services-img img {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .services-title {
                font-size: 28px;
            }

            .services-desc {
                font-size: 16px;
            }
        }

        /* Team Section */
        .team-section {
            background: #fff;
            padding: 70px 0 40px 0;
        }

        .team-header {
            text-align: left;
            margin-bottom: 32px;
        }

        .team-tag {
            display: inline-block;
            background: #e0f2f7;
            color: #2c8c99;
            font-weight: 600;
            font-size: 1em;
            border-radius: 20px;
            padding: 7px 22px;
            margin-bottom: 18px;
            margin-left: 0;
        }

        .team-title {
            font-size: 1.8em;
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
            background: transparent;
            border-radius: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 0 18px 0;
            min-width: 220px;
            max-width: 320px;
            box-sizing: border-box;
        }

        .team-photo-bg {
            background: #eaf8fa;
            border-radius: 18px;
            width: 100%;
            min-height: 320px;
            height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 10px;
            overflow: visible;
        }

        .team-photo-bg img {
            width: 180px;
            height: 260px;
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

        .team-contact {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .team-photo-bg:hover .team-contact {
            opacity: 1;
        }

        .team-name {
            color: #2c8c99;
            font-weight: 600;
            font-size: 1em;
            margin-top: 12px;
            margin-bottom: 2px;
            text-align: center;
        }

        .team-role {
            color: #888;
            font-size: 0.9em;
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
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .footer-column p,
        .footer-link {
            font-size: 13px;
            line-height: 1.6;
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

        /* Booking Section */
        .booking-section {
            width: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 70px 0 40px 0;
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
            height: 100%;
            max-width: 340px;
            max-height: 400px;
            object-fit: cover;
            border-radius: 16px;
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

        .top-bar {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-bottom: 6px;
        }

        .login-btn,
        .close-btn {
            background: #eafafd;
            border: none;
            border-radius: 18px;
            color: #1b6b7a;
            font-size: 1em;
            font-weight: 500;
            padding: 7px 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: background 0.2s;
        }

        .login-btn:hover,
        .close-btn:hover {
            background: #d1f0f6;
        }

        .close-btn {
            padding: 7px 12px;
            color: #b6b6b6;
            background: transparent;
        }

        .login-btn a {
            color: #1b6b7a;
            text-decoration: none;
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
            padding: 11px 14px;
            border: 1.5px solid #a3e2ea;
            border-radius: 8px;
            font-size: 1em;
            font-family: inherit;
            background: #fafdff;
            color: #222;
            outline: none;
            transition: border 0.2s;
        }

        .form-group input,
        .form-group select {
            padding: 12px 16px;
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
        }

        @media (max-width: 900px) {
            .team-section {
                padding: 40px 0 24px 0;
            }

            .team-grid-custom {
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }

            .team-card {
                max-width: 98vw;
                min-width: 0;
            }

            .team-photo-bg {
                min-height: 220px;
                height: 220px;
            }

            .team-photo-bg img {
                width: 110px;
                height: 160px;
            }

            .team-title {
                font-size: 1.2em;
            }
        }

        @media (max-width: 600px) {
            .team-section {
                padding: 18px 0 8px 0;
            }

            .team-grid-custom {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .team-card {
                max-width: 100vw;
                padding: 0 0 12px 0;
            }

            .team-photo-bg {
                min-height: 120px;
                height: 120px;
            }

            .team-photo-bg img {
                width: 70px;
                height: 100px;
            }

            .team-title {
                font-size: 1em;
            }
        }
    </style>
    </style>
    </head>


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
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('specialists') }}" class="active">Specialists</a></li>
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

    <section class="services-section">
        <div class="services-container rtl-section">
            <div class="services-content">
                <span class="services-pill">Our Specialists</span>
                <h2 class="services-title">Our Dedicated & Experienced Therapist Team</h2>
                <p class="services-desc">
                    World-class rehabilitation solutions and individualized recovery plans,
                    from acute care to ongoing outpatient treatment and beyond.
                </p>
            </div>
            <div class="services-img">
                <img src="https://i.postimg.cc/44FzPQc8/image.png" alt="Exercise Services">
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
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
                    <a href="{{ route('doctor-profile', ['id' => 1]) }}">
                        <div class="team-name">Dr. Emily Brown</div>
                    </a>
                    <div class="team-role">senior physiotherapist</div>
                </div>
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
                                <div style="display: flex; gap: 16px;">
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
                    <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link">Services</a></li>
                    <li><a href="{{ route('specialists') }}" class="footer-link">Our Team</a></li>
                    <li><a href="{{ route('shop') }}" class="footer-link">Shop</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link">Contacts</a></li>
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

    </div>
    </div>
    </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navToggle = document.querySelector('.nav-toggle');
            const navLinks = document.querySelector('.nav-links');
            if (navToggle && navLinks) {
                navToggle.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                });
            }
        });
    </script>
    @endpush
    <script>
        console.log('script loaded');
        document.addEventListener('DOMContentLoaded', function() {
            var navToggle = document.querySelector('.nav-toggle');
            var navLinks = document.querySelector('.nav-links');
            if (navToggle && navLinks) {
                navToggle.addEventListener('click', function() {
                    console.log('hamburger clicked');
                    navLinks.classList.toggle('active');
                });
            } else {
                console.log('navToggle or navLinks not found');
            }
        });
    </script>
</x-app-layout>