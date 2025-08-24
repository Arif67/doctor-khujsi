@extends('frontend.layout.masterlayout')

@section('title', 'About Us - Hospital Management')

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
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    @media (max-width: 900px) {
        .top-header .container {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
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

    .main-nav .nav-links li {
        margin-left: 30px;
    }

    .main-nav .nav-links a {
        text-decoration: none;
        color: var(--text-color);
        font-weight: 500;
        transition: color 0.3s ease;
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

    /* Services Section */
    .services-section {
        padding: 80px 0;
        background-color: #EBF7F9;
    }

    .services-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 48px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px 20px 0 20px;
        flex-wrap: wrap;
    }

    .services-img img {
        width: 100%;
        max-width: 420px;
        height: auto;
        aspect-ratio: 420/340;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 6px 30px rgba(44, 140, 153, 0.08);
        background: #f3fafe;
        display: block;
    }

    .services-content {
        flex: 1 1 0%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 320px;
        max-width: 650px;
    }

    .services-pill {
        display: inline-block;
        background: #bbe0e4;
        color: #3a3939;
        font-weight: 600;
        font-size: 1em;
        border-radius: 20px;
        padding: 7px 22px;
        margin-bottom: 18px;

    }

    .services-title {
        font-size: 2.3em;
        color: #222;
        font-weight: 700;
        margin-bottom: 18px;
        line-height: 1.13;
    }

    .services-desc {
        font-size: 1.04em;
        color: #444;
        margin-bottom: 28px;
        max-width: 95%;
    }

    @media (max-width: 768px) {
        .services-container {
            flex-direction: column;
            text-align: center;
        }

        .services-content {
            align-items: center;
        }

        .services-img img {
            width: 100%;
            height: auto;
        }
    }

    /* About Section */
    .about-section {
        padding: 80px 0;
        background-color: #ffffff;
        /* Change to your preferred background color */
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .about-conent {
        flex: 1;
        min-width: 300px;
    }

    .heading {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        /* Change to your preferred heading color */
        margin-bottom: 30px;
        line-height: 1.2;
    }

    .description {
        font-size: 1rem;
        line-height: 1.6;
        color: #666;
        /* Change to your preferred text color */
        margin-bottom: 20px;
        white-space: pre-line;
    }

    .about-image {
        flex: 1;
        min-width: 300px;
        display: flex;
        justify-content: center;
    }

    .about-image img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        /* Optional: adds rounded corners to the image */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* Optional: adds subtle shadow */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .about-container {
            flex-direction: column;
        }

        .about-conent,
        .about-image {
            width: 100%;
        }

        .heading {
            font-size: 2rem;
        }
    }

    /* Team Section */
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
        font-size: 2.2em;
        color: #222;
        margin: 0 0 22px 0;
        font-weight: 700;
        line-height: 1.1;
    }

    .team-grid-custom {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    @media (max-width: 1100px) {
        .team-grid-custom {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .team-grid-custom {
            grid-template-columns: 1fr;
            gap: 16px;
        }
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

    @media (max-width: 900px) {
        .container {
            padding: 0 8px;
        }

        .team-section {
            flex-direction: column;
            gap: 32px;
        }

        .services-img img {
            max-width: 100%;
            height: auto;
            aspect-ratio: 420/340;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 4px;
        }

        .team-section {
            flex-direction: column;
            gap: 16px;
        }
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
            <div class="logo-circle"></div>
            <span>LOGO</span>
        </div>
        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="active">About Us</a></li>
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
    <div class="services-container">
        <div class="services-img">
            <img src="https://i.postimg.cc/YSb49tfX/image.png" alt="Exercise Services">
        </div>
        <div class="services-content">
            <span class="services-pill">Our Services</span>
            <div class="services-title">We Provide The Best <br> Services</div>
            <div class="services-desc">
                World-class rehabilitation solutions and individualized recovery plans,
                from acute care to ongoing outpatient treatment and beyond.
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="about-container">
        <div class="about-conent">
            <h1 class="heading">How We Get You Better</h1>
            <p class="description">
                Lorem ipsum dolor sit amet consectetur. Duis mattis penatibus tellus urna et eget. Nec ornare enim
                ornare ligula elit a nibh laoreet diam. Auctor at nisl fermentum tellus morbi sed pretium quam
                neque.

                Volutpat volutpat vitae pretium suscipit eros ultrices massa nam. Ut cursus sed massa faucibus quam
                eget vulputate. Morbi lorem libero porttitor posuere arcu mauris vulputate lacus blandit.

                Felis nunc lectus mattis arcu a. Auctor consequat at nibh sit tortor. Viverra eu sed habitant morbi
                libero neque et penatibus dignissim.

            </p>
        </div>
        <div class="about-image">
            <img src="https://i.postimg.cc/44FzPQc8/image.png" alt="About Us Image">
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