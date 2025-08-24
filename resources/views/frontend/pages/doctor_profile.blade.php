@extends('frontend.layout.masterlayout')

@section('title', 'Doctor Profile - Hospital Management')

@section('styles')
<style>
    .main-nav .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    .profile-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        background: #e2f6fa;
        border-radius: 16px;
        padding: 32px 60px;
        margin: 40px 60px 0 60px;
    }

    .profile-info {
        flex: 1;
    }

    .profile-info h2 {
        font-size: 28px;
        margin-bottom: 12px;
    }

    .profile-info .contact {
        font-size: 15px;
        margin-bottom: 14px;
        color: #555;
    }

    .profile-info .social {
        margin-top: 12px;
    }

    .profile-info .social a {
        margin-right: 18px;
        color: #36b7c5;
        font-size: 18px;
        text-decoration: none;
        transition: color 0.2s;
    }

    .profile-info .social a:hover {
        color: #222;
    }

    .profile-pic {
        width: 320px;
        height: 260px;
        background: #b6e6ee;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .profile-pic img {
        width: 180px;
        height: 220px;
        object-fit: cover;
        border-radius: 12px;
    }

    .heart {
        position: absolute;
        top: 18px;
        right: 20px;
        background: #fff;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #36b7c5;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
    }

    .main-content {
        display: flex;
        margin: 40px 60px;
        gap: 40px;
    }

    .booking-form {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 24px rgba(0, 0, 0, 0.06);
        padding: 32px 26px;
        width: 320px;
        min-width: 280px;
        margin-top: 0;
        align-self: flex-start;
    }

    .booking-form h3 {
        color: #36b7c5;
        font-size: 18px;
        margin-bottom: 18px;
        text-align: center;
    }

    .booking-form label {
        font-size: 14px;
        color: #222;
        margin-bottom: 6px;
        display: block;
    }

    .booking-form input,
    .booking-form select {
        width: 100%;
        padding: 8px 10px;
        margin-bottom: 14px;
        border: 1px solid #c8e4ea;
        border-radius: 7px;
        font-size: 15px;
        background: #f6fbfc;
    }

    .booking-form button {
        width: 100%;
        padding: 10px 0;
        background: #36b7c5;
        color: #fff;
        border: none;
        border-radius: 7px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .booking-form button:hover {
        background: #2499a7;
    }

    .bio-section {
        flex: 1;
        background: none;
        padding: 0;
    }

    .bio-section h2 {
        font-size: 22px;
        margin-bottom: 16px;
    }

    .bio-section p {
        font-size: 15px;
        color: #555;
        margin-bottom: 22px;
    }

    .edu-exp {
        margin-bottom: 22px;
    }

    .edu-exp h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .edu-exp table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    .edu-exp td {
        padding: 6px 0;
        color: #444;
    }

    .working-shifts {
        font-size: 16px;
        color: #222;
        margin-bottom: 20px;
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

    @media (max-width: 900px) {
        .profile-section {
            flex-direction: column;
            align-items: center;
            gap: 24px;
            margin: 24px 0 0 0;
            padding: 18px 4vw;
        }

        .profile-pic {
            width: 200px;
            height: 160px;
            margin-bottom: 12px;
        }

        .profile-pic img {
            width: 120px;
            height: 140px;
        }

        .profile-info {
            text-align: center;
            padding: 0;
        }

        .main-content {
            flex-direction: column;
            margin: 24px 0;
            gap: 18px;
            padding: 10px 4vw;
        }

        .booking-form {
            width: 100%;
            min-width: 0;
            margin: 0 auto;
            padding: 18px 2vw;
        }

        .bio-section {
            padding: 0;
            width: 100%;
        }
    }

    .container {
        padding: 0 10px;
    }

    .profile-section {
        flex-direction: column;
        align-items: center;
        gap: 24px;
    }

    .profile-img {
        width: 180px;
        height: 180px;
    }

    .profile-info {
        text-align: center;
    }

    .main-content {
        padding: 18px 2vw;
    }

    .booking-form {
        padding: 12px 2vw;
    }
    }

    @media (max-width: 600px) {
        .container {
            padding: 0 2vw;
        }

        .profile-section {
            margin: 10px 0 0 0;
            padding: 8px 1vw;
        }

        .profile-pic {
            width: 110px;
            height: 90px;
        }

        .profile-pic img {
            width: 60px;
            height: 70px;
        }

        .main-content {
            margin: 10px 0;
            padding: 4px 1vw;
            gap: 10px;
        }

        .booking-form {
            padding: 6px 1vw;
            border-radius: 10px;
        }

        .profile-info h2 {
            font-size: 1em;
        }

        .bio-section h2 {
            font-size: 1em;
        }

        .booking-form h3 {
            font-size: 1em;
        }
    }

    .container {
        padding: 0 2vw;
    }

    .profile-img {
        width: 110px;
        height: 110px;
    }

    .main-content {
        padding: 8px 1vw;
    }

    .booking-form {
        padding: 4px 1vw;
    }

    .profile-info h2 {
        font-size: 1.1em;
    }
    }
</style>
@endsection

@section('content')
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

<!-- Profile Section -->
<div class="profile-section">
    <div class="profile-info">
        <h2>Dr. Emily Brown</h2>
        <div class="contact">
            Phone: +8801555-548965<br>
            Office: +8801555-548965<br>
            Email: example@gmail.com
        </div>
        <div class="social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
    <div class="profile-pic">
        <img src="https://img.freepik.com/free-photo/nurse-with-stethoscope-white-medical-uniform-white-protective-sterile-mask_179666-205.jpg?t=st=1717959581~exp=1717963181~hmac=976a532d8fc64986f6c29f5c8c8f71972111de503411342eaffa23645e02218d&w=1800"
            alt="Doctor Photo">
        <span class="heart"><i class="fa fa-heart"></i></span>
    </div>
</div>
<!-- Main Content -->
<div class="main-content">
    <div class="booking-form">
        <h3>Book a Consultation:</h3>
        <form>
            <label>Services</label>
            <select>
                <option>Services Name</option>
            </select>
            <label>Your Name</label>
            <input type="text" placeholder="Your Name">
            <label>Your Phone</label>
            <input type="text" placeholder="Your Phone Number">
            <label>Date</label>
            <input type="date">
            <label>Time</label>
            <select>
                <option>03:00</option>
                <option>04:00</option>
            </select>
            <button type="submit">Book Your Appointment →</button>
        </form>
    </div>
    <div class="bio-section">
        <h2>Short Biography</h2>
        <p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the
            all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day
            however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of
            Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild
            Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven
            versalia, put her initial into the belt and made herself on the way. When she reached the first hills of
            the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the
            headline of Alphabet Village and the subline of her own road, the Line Lane.</p>
        <div class="edu-exp">
            <h3>Education & Experience</h3>
            <table>
                <tr>
                    <td>Education</td>
                    <td>University of Virginia, M.D. of Medicine</td>
                </tr>
                <tr>
                    <td>Board certification</td>
                    <td>National Commission on Certification of Physician Assistants</td>
                </tr>
                <tr>
                    <td>Field of expertise</td>
                    <td>University of Virginia, M.D. of Medicine</td>
                </tr>
                <tr>
                    <td>Years of practice</td>
                    <td>10</td>
                </tr>
            </table>
        </div>
        <div class="working-shifts">
            <b>Working Shifts</b><br>
            Mon-Fri: 10am-8pm<br>
            Sat-Sun: Off day
        </div>
    </div>
</div>
<!-- Footer -->
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
@endsection