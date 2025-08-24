@extends('frontend.layout.masterlayout')

@section('title', 'Our Services - Hospital Management')

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

    .main-nav .nav-links li {
        margin-left: 30px;
    }

    .main-nav .nav-links a {
        text-decoration: none;
        color: var(--text-color);
        font-weight: 500;
        transition: color 0.3s ease;
        position: relative;
    }

    .main-nav .nav-links a.active {
        color: var(--primary-color);
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

    .book-btn {
        background-color: #22B8CF;
        color: white;
        padding: 14px 24px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .book-btn:hover {
        background-color: #199CB0;
    }

    /* Services Section (Hero) */
    .services-section {
        padding: 54px 0 54px 0;
        background: #f1fafc;
    }

    .services-hero-flex {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 54px;
        padding: 0 32px;
    }

    .services-hero-img-wrap {
        background: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 6px 30px rgba(44, 140, 153, 0.10);
        flex-shrink: 0;
    }

    .services-hero-img-wrap img {
        width: 390px;
        height: 320px;
        object-fit: cover;
        border-radius: 24px;
        display: block;
    }

    .services-hero-content {
        flex: 1 1 0%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 320px;
        max-width: 900px;
    }

    .services-hero-pill {
        display: inline-block;
        background: #d5f2f7;
        color: #2693a6;
        font-weight: 700;
        font-size: 1.35rem;
        border-radius: 28px;
        padding: 13px 38px 11px 38px;
        margin-bottom: 32px;
    }

    .services-hero-title {
        font-size: 2.7rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 28px;
        line-height: 1.13;
        letter-spacing: 0px;
    }

    .services-hero-desc {
        font-size: 1.13rem;
        color: #2d2d2d;
        font-weight: 400;
        margin-bottom: 0;
        max-width: 800px;
        line-height: 1.5;
    }

    @media (max-width: 1100px) {
        .services-hero-flex {
            gap: 28px;
        }

        .services-hero-img-wrap img {
            width: 300px;
            height: 220px;
        }

        .services-hero-title {
            font-size: 2.1rem;
        }
    }

    @media (max-width: 800px) {
        .services-hero-flex {
            flex-direction: column;
            align-items: center;
            padding: 0 10px;
        }

        .services-hero-img-wrap img {
            width: 95vw;
            max-width: 340px;
            height: auto;
        }

        .services-hero-content {
            align-items: center;
            max-width: 98vw;
            text-align: center;
        }

        .services-hero-title {
            font-size: 1.4rem;
        }

        .services-hero-pill {
            font-size: 1rem;
            padding: 8px 18px;
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

    /* Services Section2 */
    .services-section2 {
        background: #fff;
        padding: 40px 0 0 0;
        margin-bottom: 0;
    }

    .services-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto 0 auto;
        padding: 0 0 12px 0;
    }

    .services-pill {
        background: #e0f2f7;
        color: #2c8c99;
        font-weight: 600;
        font-size: 1em;
        border-radius: 20px;
        padding: 7px 22px;
        margin-left: 0;
        margin-bottom: 0;
        display: inline-block;
    }

    .services-viewall-btn {
        background: #e0f2f7;
        color: #2c8c99;
        border: none;
        border-radius: 20px;
        padding: 7px 28px 7px 18px;
        font-size: 1em;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
        outline: none;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .services-viewall-btn .arrow {
        font-size: 1.1em;
        margin-left: 5px;
    }

    .services-viewall-btn:hover {
        background: #b2ebf2;
    }

    .services-title {
        font-size: 2.2em;
        color: #222;
        font-weight: 700;
        margin: 0 0 30px 0;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.12;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 28px;
        max-width: 1200px;
        margin: 0 auto;
        margin-bottom: 40px;
    }

    .service-card {
        background: #fff;
        border: 2px solid #e0f2f7;
        border-radius: 16px;
        padding: 32px 22px 22px 22px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: relative;
        min-height: 270px;
        box-shadow: 0 2px 12px rgba(44, 140, 153, 0.04);
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .service-card:hover {
        box-shadow: 0 8px 32px rgba(44, 140, 153, 0.13);
        transform: translateY(-4px) scale(1.01);
    }

    .service-icon {
        background: #e0f7fa;
        color: #2c8c99;
        border-radius: 16px;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2em;
        margin-bottom: 18px;
    }

    .service-title {
        color: #00bcd4;
        font-size: 1.1em;
        font-weight: 600;
        margin-bottom: 10px;
        text-decoration: underline transparent;
        cursor: pointer;
        transition: text-decoration 0.2s;
    }

    .service-title:hover {
        text-decoration: underline #00bcd4;
    }

    .service-desc {
        color: #444;
        font-size: 0.98em;
        margin-bottom: 30px;
        flex: 1 1 auto;
    }

    .service-arrow {
        position: absolute;
        right: 18px;
        bottom: 18px;
        background: #e0f2f7;
        color: #2c8c99;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15em;
        cursor: pointer;
        transition: background 0.2s;
    }

    .service-arrow:hover {
        background: #b2ebf2;
    }

    .services-bottom-bar {
        background: #f8fdfe;
        border: 2px solid #e0f2f7;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 30px auto 0 auto;
        padding: 18px 32px;
        gap: 18px;
    }

    .services-bottom-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .bottom-icon {
        background: #e0f7fa;
        color: #2c8c99;
        border-radius: 12px;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.55em;
    }

    .bottom-title {
        color: #00bcd4;
        font-weight: 700;
        font-size: 1.08em;
        margin-bottom: 2px;
    }

    .bottom-desc {
        color: #444;
        font-size: 1em;
    }

    .bottom-cta {
        background: #00bcd4;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 12px 32px;
        font-size: 1em;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
        outline: none;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .bottom-cta .arrow {
        font-size: 1.1em;
        margin-left: 5px;
    }

    .bottom-cta:hover {
        background: #0097a7;
    }

    /* Testimonials Section */
    .testimonials-section {
        background: #fff;
        padding: 70px 0 40px 0;
    }

    .testimonials-header {
        text-align: left;
        margin-bottom: 32px;
    }

    .testimonials-tag {
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

    .testimonials-title {
        font-size: 2.2em;
        color: #222;
        margin: 0 0 22px 0;
        font-weight: 700;
    }

    .testimonials-grid {
        display: flex;
        gap: 30px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .testimonial-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #b2e5ee;
        box-shadow: 0 2px 16px rgba(44, 140, 153, 0.06);
        padding: 28px 24px 20px 24px;
        flex: 1 1 320px;
        max-width: 370px;
        min-width: 260px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .testimonial-card:hover {
        box-shadow: 0 8px 32px rgba(44, 140, 153, 0.13);
        transform: translateY(-4px) scale(1.01);
    }

    .testimonial-stars {
        color: #ffc107;
        font-size: 1.25em;
        margin-bottom: 12px;
    }

    .testimonial-text {
        color: #444;
        font-size: 1em;
        margin-bottom: 26px;
        min-height: 74px;
    }

    .testimonial-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e0f2f7;
        box-shadow: 0 2px 8px rgba(44, 140, 153, 0.07);
    }

    .testimonial-name {
        color: #2c8c99;
        font-weight: 600;
        text-decoration: none;
        font-size: 1.05em;
        margin-bottom: 2px;
        display: inline-block;
    }

    .testimonial-name:hover {
        text-decoration: underline;
    }

    .testimonial-location {
        color: #888;
        font-size: 0.97em;
    }

    .testimonials-pagination {
        text-align: center;
        margin-top: 28px;
    }

    .testimonials-pagination .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin: 0 6px;
        background: #e0f2f7;
        border-radius: 50%;
        transition: background 0.2s;
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
            <li><a href="{{ route('services') }}" class="active">Services</a></li>
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
    <div class="services-hero-flex">
        <div class="services-hero-img-wrap">
            <img src="https://www.nurseregistry.com/wp-content/uploads/2019/01/nurses-in-hospital-setting.jpg" alt="Exercise Services">
        </div>
        <div class="services-hero-content">
            <span class="services-hero-pill">Our Services</span>
            <div class="services-hero-title">We Provide The Best<br>Services</div>
            <div class="services-hero-desc">World-class rehabilitation solutions and individualized recovery plans, from acute care to ongoing outpatient treatment and beyond.</div>
        </div>
    </div>
</section>

<section class="services-section2">
    <div class="container">
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-spa"></i></div>
                <div class="service-title">Cupping Therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><a href="{{route('serviceinfo')}}"><i class="fas fa-arrow-right"></i></a></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-hands"></i></div>
                <div class="service-title">Manual Therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-heartbeat"></i></div>
                <div class="service-title">chronic pain</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-hand-paper"></i></div>
                <div class="service-title">Hand therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-running"></i></div>
                <div class="service-title">Sports Therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="service-title">Laser Therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-deaf"></i></div>
                <div class="service-title">Ultrasound Therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-deaf"></i></div>
                <div class="service-title">Ultrasound Therapy</div>
                <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                    justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                    turpis</div>
                <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="services-bottom-bar">
            <div class="services-bottom-left">
                <div class="bottom-icon"><i class="fas fa-info-circle"></i></div>
                <div>
                    <div class="bottom-title">Ready to start your journey to recovery?</div>
                    <div class="bottom-desc">We understand that injuries and acute pain can unexpectedly. Our
                        emergency physiotherapy.</div>
                </div>
            </div>
            <a href="{{ route('booking') }}" class="book-btn">Book An Appointment →</a>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <div class="container">
        <div class="testimonials-header">
            <span class="testimonials-tag">Clients Review</span>
            <h2 class="testimonials-title">What Our Client Say</h2>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-text">
                    Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque. Varius
                    nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis turpis.Lorem ipsum dolor
                    sit amet consectetur. Elementum egestas sed consequat justo neque.
                </div>
                <div class="testimonial-user">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mr. Tom"
                        class="testimonial-avatar">
                    <div>
                        <a href="#" class="testimonial-name">Mr. Tom</a>
                        <div class="testimonial-location">Baridhara, Dhaka</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-text">
                    Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque. Varius
                    nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis turpis.Lorem ipsum dolor
                    sit amet consectetur. Elementum egestas sed consequat justo neque.
                </div>
                <div class="testimonial-user">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mr. Tom"
                        class="testimonial-avatar">
                    <div>
                        <a href="#" class="testimonial-name">Mr. Tom</a>
                        <div class="testimonial-location">Baridhara, Dhaka</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-text">
                    Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque. Varius
                    nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis turpis.Lorem ipsum dolor
                    sit amet consectetur. Elementum egestas sed consequat justo neque.
                </div>
                <div class="testimonial-user">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mr. Tom"
                        class="testimonial-avatar">
                    <div>
                        <a href="#" class="testimonial-name">Mr. Tom</a>
                        <div class="testimonial-location">Baridhara, Dhaka</div>
                    </div>
                </div>
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
@endsection