@extends('frontend.layout.masterlayout')

@section('title', 'Blog - Hospital Management')

@section('styles')

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
        /* ADDED FLEX */
        justify-content: space-between;
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
        color: #22b8cf;
        border-radius: 6px;
        padding: 6px 18px;
        font-weight: 600;
    }

    .main-nav .nav-links a:hover {
        color: var(--primary-color);
    }

    .main-nav .nav-links a.active {
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

    .blog-hero {
        background: linear-gradient(90deg, #eaf8fa 0%, #fafdff 100%);
        padding: 60px 0 40px 0;
    }

    .blog-hero-inner {
        display: flex;
        align-items: center;
        gap: 56px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 32px;
    }

    .blog-hero-img img {
        width: 360px;
        height: 360px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 6px 32px rgba(44, 140, 153, 0.13);
        background: #f3fafe;
        border: none;
        max-width: 100vw;
        max-height: 360px;
    }

    .blog-hero-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
    }

    .blog-tag {
        display: inline-block;
        background: #cdebf2;
        color: #222;
        font-weight: 500;
        font-size: 1.05em;
        border-radius: 999px;
        padding: 10px 32px;
        margin-bottom: 22px;
        box-shadow: 0 2px 8px rgba(44, 140, 153, 0.04);
    }

    .blog-hero-content h1 {
        font-size: 2.1em;
        font-weight: 700;
        color: #222;
        margin: 0 0 38px 0;
        line-height: 1.17;
        letter-spacing: -0.5px;
    }

    @media (max-width: 900px) {
        .blog-hero-inner {
            flex-direction: column;
            gap: 32px;
            padding: 0 10px;
            align-items: center;
        }

        .blog-hero-img img {
            width: 80vw;
            height: auto;
            max-width: 320px;
            max-height: 320px;
        }

        .blog-hero-content h1 {
            font-size: 1.3em;
            margin-bottom: 24px;
        }

        .blog-tag {
            font-size: 1em;
            padding: 8px 20px;
        }
    }

    @media (max-width: 600px) {
        .blog-hero {
            padding: 28px 0 18px 0;
        }

        .blog-hero-inner {
            gap: 16px;
            padding: 0 2vw;
        }

        .blog-hero-img img {
            width: 98vw;
            max-width: 240px;
            max-height: 240px;
        }

        .blog-hero-content h1 {
            font-size: 1.05em;
            margin-bottom: 14px;
        }

        .blog-tag {
            font-size: 0.98em;
            padding: 6px 12px;
        }
    }

    .blog-cards-section {
        padding: 0 0 48px 0;
        background: #fff;
    }

    .blog-cards-grid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 32px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 36px 28px;
    }

    .blog-card {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        padding: 0 0 18px 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .blog-card-img {
        width: 100%;
        height: 140px;
        border-radius: 12px 12px 0 0;
        overflow: hidden;
        background: #fff;
    }

    .blog-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-card-content {
        padding: 14px 16px 0 16px;
        flex: 1;
    }

    .blog-card-title {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 10px;
        color: #222;
    }

    .blog-card-readmore {
        color: #08c7df;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        margin-top: 8px;
    }

    .blog-card-readmore:hover {
        text-decoration: underline;
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
</style>
@endsection

@section('content')
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
            <div class="logo-circle"></div><span>LOGO</span>
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
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a class="active" href="{{ route('blog') }}">Blog</a></li>
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

<section class="blog-hero">
    <div class="blog-hero-inner">
        <div class="blog-hero-img">
            <img src="https://i.postimg.cc/RCHJmZLM/image.png" alt="Blog Hero">
        </div>
        <div class="blog-hero-content">
            <span class="blog-tag">News & Blog</span>
            <h1>Our Latest Insights & Updates</h1>
            <p>World-class rehabilitation solutions and individualized recovery plans, from acute care to ongoing outpatient treatment and beyond.</p>
        </div>
    </div>
</section>
<section class="blog-cards-section">
    <div class="blog-cards-grid">
        <!-- Row 1 -->
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/RCHJmZLM/image.png" alt="Blog 1"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">Transitional Rehab: What to Expect</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/Dfrf5Jcb/image.png" alt="Blog 2"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">How to choose the right physiotherapist for you</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/9Q4v8sjN/image.png" alt="Blog 3"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">Importance of correct posture and how to improve it</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <!-- Row 2 -->
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/RCHJmZLM/image.png" alt="Blog 4"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">10 essential benefits of regular physiotherapy</div>
                <a class="blog-card-readmore" href="{{ route('bloginfo', ['slug' => '10-essential-benefits-of-regular-physiotherapy']) }}">Read more &rarr;</a>
            </div>
        </div>
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/Dfrf5Jcb/image.png" alt="Blog 5"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">How to choose the right physiotherapist for you</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/9Q4v8sjN/image.png" alt="Blog 6"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">Importance of correct posture and how to improve it</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <!-- Row 3 -->
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/RCHJmZLM/image.png" alt="Blog 7"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">10 essential benefits of regular physiotherapy</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/Dfrf5Jcb/image.png" alt="Blog 8"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">How to choose the right physiotherapist for you</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
            </div>
        </div>
        <div class="blog-card">
            <div class="blog-card-img"><img src="https://i.postimg.cc/9Q4v8sjN/image.png" alt="Blog 9"></div>
            <div class="blog-card-content">
                <div class="blog-card-title">Importance of correct posture and how to improve it</div>
                <a class="blog-card-readmore" href="#">Read more &rarr;</a>
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