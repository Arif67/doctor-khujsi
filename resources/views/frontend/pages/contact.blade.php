@extends('frontend.layout.masterlayout')

@section('title', 'Contact Us - Hospital Management')

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


    /* About Section */
    .about-section {
        padding: 80px 0;
        background-color: #EBF7F9;
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

    /* About Section */
    .about-section {
        background: #f3fbfd;
        padding: 60px 0 40px 0;
        width: 100%;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 56px;
        padding: 0 32px;
    }

    .about-content {
        flex: 1.2;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        min-width: 320px;
    }

    .contact-pill {
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

    .about-title {
        font-size: 2.1em;
        font-weight: 700;
        color: #222;
        margin: 0 0 38px 0;
        line-height: 1.17;
        letter-spacing: -0.5px;
    }

    .about-btn-row {
        display: flex;
        gap: 12px;
    }

    .about-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
        border-radius: 8px;
        font-size: 1em;
        font-weight: 500;
        padding: 12px 24px;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    }

    .about-btn-main {
        background: #22b8cf;
        color: #fff;
        box-shadow: 0 2px 8px rgba(44, 140, 153, 0.10);
    }

    .about-btn-main:hover {
        background: #199cb0;
    }

    .about-btn-call {
        background: #fff;
        color: #22b8cf;
        border: 1.5px solid #22b8cf;
    }

    .about-btn-call:hover {
        background: #eafafd;
    }

    .about-btn i {
        font-size: 1.1em;
    }

    .about-image {
        flex: 1;
        display: flex;
        justify-content: flex-end;
    }

    .about-image img {
        width: 420px;
        height: 260px;
        object-fit: cover;
        border-radius: 18px;
        box-shadow: 0 6px 30px rgba(44, 140, 153, 0.08);
        background: #f3fafe;
        display: block;
        border: none;
    }

    @media (max-width: 900px) {
        .about-container {
            flex-direction: column;
            gap: 38px;
            padding: 0 10px;
        }

        .about-content {
            align-items: center;
            text-align: center;
        }

        .about-image {
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .about-title {
            font-size: 1.2em;
        }

        .about-image img {
            width: 98vw;
            height: auto;
            min-width: 0;
        }

        .about-btn-row {
            flex-direction: column;
            gap: 10px;
            width: 100%;
            align-items: stretch;
        }

        .about-btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Contact Map Section */
    .contact-map-section {
        width: 100%;
        background: #fff;
        padding: 60px 0 30px 0;
        display: flex;
        justify-content: center;
    }

    .contact-map-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        width: 100%;
        padding: 0 32px;
    }

    .contact-info-col {
        flex: 1.1;
        min-width: 320px;
    }

    .contact-map-title {
        font-size: 2em;
        font-weight: 700;
        color: #333;
        margin-bottom: 16px;
    }

    .contact-map-desc {
        font-size: 1.06em;
        color: #444;
        margin-bottom: 28px;
        max-width: 390px;
    }

    .contact-map-details {
        display: flex;
        gap: 56px;
        font-size: 1em;
        color: #222;
    }

    .contact-map-details div {
        min-width: 140px;
    }

    .contact-map-embed {
        flex: 1;
        min-width: 320px;
        display: flex;
        justify-content: flex-end;
    }

    .contact-map-embed iframe {
        width: 420px;
        height: 260px;
        border-radius: 18px;
        box-shadow: 0 6px 30px rgba(44, 140, 153, 0.08);
        border: none;
    }

    @media (max-width: 1000px) {
        .contact-map-container {
            flex-direction: column;
            gap: 32px;
            padding: 0 10px;
        }

        .contact-map-embed {
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .contact-map-title {
            font-size: 1.2em;
        }

        .contact-map-embed iframe {
            width: 98vw;
            height: 180px;
        }

        .contact-map-details {
            flex-direction: column;
            gap: 12px;
        }
    }

    /* Contact Form Section */
    .contact-form-section {
        width: 100%;
        background: #fff;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 64px 0 0 0;
    }

    .contact-form-container {
        background: #fff;
        border-radius: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 54px;
        width: 900px;
        max-width: 98vw;
        padding: 44px 38px;
        margin: 0 auto;
    }

    @media (max-width: 1000px) {
        .contact-form-container {
            flex-direction: column;
            gap: 32px;
            padding: 0 10px;
            width: 100%;
            max-width: 100vw;
        }

        .contact-form-img {
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .contact-form-title {
            font-size: 1.2em;
        }

        .contact-form-img img {
            width: 98vw;
            height: auto;
            max-width: 340px;
            max-height: 340px;
        }

        .form-row {
            flex-direction: column;
            gap: 10px;
        }

        .contact-form-block {
            min-width: 0;
            max-width: 100vw;
            padding: 0 4px;
        }

        .contact-form-container {
            padding: 12px 2px;
            gap: 18px;
        }
    }

    .contact-form-img {
        flex: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-form-img img {
        width: 340px;
        height: 340px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 6px 32px rgba(44, 140, 153, 0.13);
        background: #f3fafe;
        border: none;
        max-width: 100vw;
        max-height: 340px;
    }

    .contact-form-block {
        flex: 1;
        background: none;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 18px;
        min-width: 340px;
        max-width: 400px;
    }

    .contact-form-title {
        font-size: 2em;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
        text-align: left;
    }

    .contact-form-desc {
        font-size: 1em;
        color: #444;
        margin-bottom: 18px;
        text-align: left;
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .form-row {
        display: flex;
        gap: 18px;
        margin-bottom: 0;
    }

    .form-input {
        flex: 1;
        padding: 12px 16px;
        border: 1.5px solid #22b8cf;
        border-radius: 8px;
        font-size: 1em;
        font-family: inherit;
        background: #fafdff;
        color: #222;
        outline: none;
        transition: border 0.2s;
    }

    .form-input:focus {
        border: 1.5px solid #00bcd4;
    }

    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #22b8cf;
        border-radius: 8px;
        font-size: 1em;
        font-family: inherit;
        background: #fafdff;
        color: #222;
        outline: none;
        resize: none;
        transition: border 0.2s;
    }

    .form-textarea:focus {
        border: 1.5px solid #00bcd4;
    }

    .form-submit {
        background: #22b8cf;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 1em;
        font-family: inherit;
        font-weight: 500;
        cursor: pointer;
        align-self: flex-start;
        margin-top: 8px;
        box-shadow: 0 2px 8px rgba(44, 140, 153, 0.06);
        transition: background 0.2s;
    }

    .form-submit:hover {
        background: #009cb0;
    }

    @media (max-width: 1000px) {
        .contact-form-container {
            flex-direction: column;
            gap: 32px;
            padding: 24px 6vw;
            width: 98vw;
        }

        .contact-form-img {
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .contact-form-title {
            font-size: 1.2em;
        }

        .contact-form-img img {
            width: 98vw;
            height: auto;
        }

        .form-row {
            flex-direction: column;
            gap: 10px;
        }

        .contact-form-container {
            padding: 12px 2vw;
        }
    }

    .contact-form-title {
        font-size: 2em;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
    }

    .contact-form-desc {
        font-size: 1em;
        color: #444;
        margin-bottom: 18px;
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .form-row {
        display: flex;
        gap: 18px;
        margin-bottom: 0;
    }

    .form-row {
        display: flex;
        gap: 18px;
        margin-bottom: 0;
    }

    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 1.08em;
        color: #666;
        font-weight: 600;
        margin-bottom: 8px;
        margin-left: 2px;
    }

    .form-input {
        flex: 1;
        padding: 12px 16px;
        border: 1.5px solid #22b8cf;
        border-radius: 8px;
        font-size: 1em;
        font-family: inherit;
        background: #fafdff;
        color: #222;
        outline: none;
        transition: border 0.2s;
    }

    .form-input:focus {
        border: 1.5px solid #00bcd4;
    }

    .form-textarea {
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        padding: 12px 16px;
        border: 1.5px solid #22b8cf;
        border-radius: 8px;
        font-size: 1em;
        font-family: inherit;
        background: #fafdff;
        color: #222;
        outline: none;
        resize: none;
        transition: border 0.2s;
    }

    .form-textarea:focus {
        border: 1.5px solid #00bcd4;
    }

    .form-submit {
        background: #22b8cf;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 1em;
        font-family: inherit;
        font-weight: 500;
        cursor: pointer;
        align-self: flex-start;
        margin-top: 8px;
        box-shadow: 0 2px 8px rgba(44, 140, 153, 0.06);
        transition: background 0.2s;
    }

    .form-submit:hover {
        background: #009cb0;
    }

    @media (max-width: 1000px) {
        .contact-form-container {
            flex-direction: column;
            gap: 32px;
            padding: 0 10px;
        }

        .contact-form-img {
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .contact-form-title {
            font-size: 1.2em;
        }

        .contact-form-img img {
            width: 98vw;
            height: auto;
        }

        .form-row {
            flex-direction: column;
            gap: 10px;
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
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('contact') }} " class="active">Contact</a></li>
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

<section class="about-section">
    <div class="about-container">
        <div class="about-content">
            <span class="contact-pill">Contact Us</span>
            <h1 class="about-title">Contact Us Easily Online,<br>by Phone or by Dropping In</h1>
            <div class="about-btn-row">
                <a href="#" class="about-btn about-btn-main">
                    Book An Appointment <i class="fa fa-arrow-right"></i>
                </a>
                <a href="tel:+8801857445897" class="about-btn about-btn-call">
                    +88018574-45897 <i class="fa fa-phone"></i>
                </a>
            </div>
        </div>
        <div class="about-image">
            <img src="https://i.postimg.cc/qvrfzNTp/image.png" alt="Contact Hero">
        </div>
    </div>
</section>

<!-- Contact Info + Map Section -->
<section class="contact-map-section">
    <div class="contact-map-container">
        <div class="contact-info-col">
            <h2 class="contact-map-title">Contact Information</h2>
            <p class="contact-map-desc">Learn more about our clinic and doctors and why they are trusted by so many
                families in our community.</p>
            <div class="contact-map-details">
                <div>
                    <strong>Address:</strong><br>
                    Dhaka, Bangladesh<br>
                    Apple Valley, MN 55124
                </div>
                <div>
                    <strong>Open:</strong><br>
                    Monday – Sunday,<br>
                    9am – 7pm EST
                </div>
            </div>
        </div>
        <div class="contact-map-embed">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9021397204415!2d90.39109741498116!3d23.750885984589207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b896b3b4a63b%3A0x123456789abcdef!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1594274197294!5m2!1sen!2sbd"
                width="100%" height="320" style="border:0; border-radius:18px;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<!-- Contact Form + Image Section -->
<section class="contact-form-section">
    <div class="contact-form-container">
        <div class="contact-form-img">
            <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="Contact Physiotherapy">
        </div>
        <div class="contact-form-block">
            <h2 class="contact-form-title">Contact Information</h2>
            <p class="contact-form-desc">If you have any questions, you can contact us. Please, fill out the form
                below.</p>
            <form class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact-name" class="form-label">Your Name</label>
                        <input id="contact-name" type="text" class="form-input" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="contact-email" class="form-label">Your Email</label>
                        <input id="contact-email" type="email" class="form-input" placeholder="Your Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact-message" class="form-label">Your Message</label>
                    <textarea id="contact-message" class="form-textarea" rows="4"
                        placeholder="Your Message"></textarea>
                </div>
                <button type="submit" class="form-submit">Send Message</button>
            </form>
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