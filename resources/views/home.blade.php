<x-app-layout>

    <title>Chiropractic Care</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Header Styles */
        .top-header {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 10px 0;
            font-size: 0.9em;
        }

        .top-header .container {
            justify-content: space-between;
            align-items: center;
        }

        .top-header .contact-info span {
            margin-right: 20px;
        }

        .top-header .contact-info i {
            margin-right: 5px;
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
            list-style: none;
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
        }

        .call-button:hover {
            background-color: #199CB0;
        }

        .call-button i {
            font-size: 16px;
        }

        .hero-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 8vw;
            flex-wrap: wrap;
        }

        .hero-content {
            max-width: 500px;
        }

        .hero-content h1 {
            color: #22B8CF;
            font-size: 36px;
            margin: 0 0 10px 0;
            font-weight: 600;
        }

        .hero-content h2 {
            font-size: 42px;
            color: #333;
            margin: 0 0 20px 0;
            font-weight: 700;
        }

        .hero-content p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
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

        .hero-image {
            position: relative;
            width: 350px;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .circle-bg {
            position: absolute;
            width: 350px;
            height: 350px;
            background-color: #22B8CF;
            border-radius: 50%;
            z-index: 1;
        }

        .hero-image img {
            position: relative;
            width: 300px;
            height: auto;
            z-index: 2;
        }

        @media (max-width: 992px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 40px 20px;
            }

            .hero-image {
                margin-top: 30px;
            }

            .hero-content h1 {
                font-size: 28px;
            }

            .hero-content h2 {
                font-size: 32px;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 24px;
            }

            .hero-content h2 {
                font-size: 28px;
            }

            .hero-image {
                width: 250px;
                height: 250px;
            }

            .circle-bg {
                width: 250px;
                height: 250px;
            }

            .hero-image img {
                width: 220px;
            }
        }

        /* Rest of your CSS styles for other sections... */
        /* Feature Bar Section */
        .feature-bar-section {
            background: #3bb2c2;
            padding: 48px 0 36px 0;
            width: 100vw;
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
        }

        .feature-bar-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 80px;
            max-width: 1200px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            background: transparent;
            padding: 0;
            min-width: 240px;
            max-width: 320px;
        }

        .feature-icon {
            background: #7fd7e2;
            border-radius: 10px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            color: #2498a7;
            margin-top: 4px;
        }

        .feature-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .feature-title {
            font-size: 1.08em;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
            letter-spacing: 0.01em;
        }

        .feature-desc {
            font-size: 0.95em;
            color: #e2f6fa;
            font-weight: 400;
            margin-bottom: 0;
        }

        /* Welcome/About Us Section */
        .welcome-section {
            padding: 80px 0;
            background-color: #f9f9f9;
        }

        .aboutus-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 48px;
            max-width: 1200px;
            margin: 0 auto 0 auto;
            padding: 32px 0 0 0;
        }

        .aboutus-img img {
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

        .aboutus-content {
            flex: 1 1 0%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-width: 320px;
            max-width: 650px;
        }

        .aboutus-pill {
            background: #e0f2f7;
            color: #2c8c99;
            font-weight: 600;
            font-size: 1em;
            border-radius: 20px;
            padding: 7px 22px;
            margin-bottom: 18px;
            display: inline-block;
        }

        .aboutus-title {
            font-size: 2.3em;
            color: #222;
            font-weight: 700;
            margin-bottom: 18px;
            line-height: 1.13;
        }

        .aboutus-desc {
            font-size: 1.04em;
            color: #444;
            margin-bottom: 28px;
            max-width: 95%;
        }

        .aboutus-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 36px;
            margin-bottom: 32px;
            width: 100%;
        }

        .feature-item {
            font-size: 1.04em;
            color: #222;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .feature-item i {
            color: #00bcd4;
            font-size: 1.2em;
        }

        .aboutus-btn {
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .aboutus-btn .arrow {
            font-size: 1.1em;
            margin-left: 5px;
        }

        .aboutus-btn:hover {
            background: #0097a7;
        }

        /* Services Section */
        .services-section {
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

        /* Unique Condition Section */
        .unique-condition-section {
            padding: 80px 0;
            text-align: center;
            background-color: #fff;
        }

        .unique-condition-section .section-header h2 {
            font-size: 2.2em;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 0.01em;
            color: #222;
        }

        .unique-condition-section .section-header div {
            margin-bottom: 8px;
        }

        .unique-condition-section .condition-image {
            margin-top: 0;
            margin-bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .unique-condition-section svg {
            max-width: 95vw;
            height: auto;
        }

        /* Attention Section */
        .attention-section {
            padding: 80px 0;
            text-align: center;
            background-color: #e0f2f7;
        }

        .attention-header {
            margin-bottom: 50px;
            padding: 0 15%;
        }

        .attention-pill {
            display: inline-block;
            background-color: #81d4fa;
            color: #fff;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .attention-header h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .attention-header p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.8;
        }

        .attention-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
            align-items: stretch;
            max-width: 1000px;
            margin: 0 auto;
        }

        .attention-card {
            background-color: #fff;
            border: 1px solid #b3e5fc;
            border-radius: 10px;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 120px;
        }

        .attention-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .attention-card i {
            font-size: 2.5em;
            color: #00bcd4;
            margin-bottom: 15px;
        }

        .attention-card span {
            font-size: 1.2em;
            font-weight: 600;
            color: #333;
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

        .testimonials-pagination .dot.active {
            background: #55b7c2;
        }

        /* Blog Section */
        .blog-section {
            padding: 80px 0;
            background-color: #e0f2f7;
        }

        .blog-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .blog-tag {
            color: #2c8c99;
            font-size: 0.9em;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .blog-post {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .blog-post img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .blog-post h3 {
            padding: 15px;
            margin-top: 0;
            color: #333;
        }

        .blog-post p {
            padding: 0 15px;
            color: #555;
            font-size: 0.95em;
        }

        .blog-post a {
            display: block;
            padding: 15px;
            color: #2c8c99;
            text-decoration: none;
            font-weight: bold;
            border-top: 1px solid #eee;
            transition: color 0.3s ease;
        }

        .blog-post a:hover {
            color: #4a9e99;
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

        /* Responsive Design */
        @media (max-width: 1200px) {
            .team-grid-custom {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 992px) {
            .hero-section .container {
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                max-width: 100%;
                padding-right: 0;
                margin-bottom: 40px;
            }

            .hero-image::before {
                width: 350px;
                height: 350px;
                border-width: 12px;
            }

            .hero-image::after {
                width: 400px;
                height: 400px;
                border-width: 18px;
            }

            .hero-image img {
                width: 300px;
                height: 300px;
            }

            .aboutus-container {
                flex-direction: column;
                align-items: stretch;
                gap: 32px;
                padding: 18px 0 0 0;
            }

            .aboutus-img img {
                width: 98vw;
                height: 220px;
                max-width: 99vw;
            }

            .aboutus-content {
                max-width: 98vw;
            }

            .feature-bar-container {
                gap: 36px;
            }

            .feature-card {
                min-width: 180px;
            }

            .services-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 900px) {
            .hero-section {
                flex-direction: column;
                padding: 32px 4vw;
                text-align: center;
            }

            .aboutus-container {
                flex-direction: column;
                gap: 32px;
            }

            .aboutus-img img {
                max-width: 100%;
                height: auto;
                aspect-ratio: 420/340;
            }
        }

        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                margin-top: 20px;
                align-items: flex-start;
            }

            .nav-links li {
                margin-left: 0;
                margin-bottom: 10px;
            }

            .hero-title {
                font-size: 3em;
            }

            .hero-subtitle {
                font-size: 2.5em;
            }

            .feature-bar-container {
                flex-direction: column;
                gap: 24px;
                align-items: center;
            }

            .feature-card {
                min-width: 220px;
                max-width: 98vw;
            }

            .team-header,
            .testimonials-header {
                text-align: center;
            }

            .team-grid-custom,
            .testimonials-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .team-card {
                max-width: 96vw;
            }

            .team-photo-bg {
                min-height: 240px;
                height: 240px;
            }

            .team-photo-bg img {
                width: 120px;
                height: 170px;
            }

            .testimonial-card {
                max-width: 96vw;
            }

            .services-bottom-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
                padding: 18px 10px;
            }

            .bottom-cta {
                width: 100%;
                justify-content: center;
            }

            .site-footer .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer-column {
                min-width: unset;
                width: 100%;
                padding-right: 0;
                margin-bottom: 30px;
            }

            .footer-column:last-child {
                margin-bottom: 0;
            }

            .logo-column {
                align-items: center;
            }

            .newsletter-form {
                flex-direction: column;
                gap: 10px;
            }

            .newsletter-form input[type="email"] {
                margin-right: 0;
            }

            .social-icons {
                justify-content: center;
            }
        }

        @media (max-width: 600px) {
            .aboutus-title {
                font-size: 1.3em;
            }

            .aboutus-img img {
                height: 150px;
            }

            .aboutus-features {
                grid-template-columns: 1fr;
                gap: 10px 0;
            }

            .services-header-row,
            .services-title,
            .services-grid,
            .services-bottom-bar {
                max-width: 98vw;
                padding-left: 2vw;
                padding-right: 2vw;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .unique-condition-section svg {
                width: 90vw;
                height: auto;
            }

            .unique-condition-section .section-header h2 {
                font-size: 1.3em;
            }
        }

        @media (max-width: 480px) {
            .top-header .container {
                flex-direction: column;
                text-align: center;
            }

            .top-header p {
                margin-bottom: 5px;
            }

            .hero-title {
                font-size: 2.5em;
            }

            .hero-subtitle {
                font-size: 2em;
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.9em;
            }

            .hero-image::before {
                width: 280px;
                height: 280px;
                border-width: 10px;
            }

            .hero-image::after {
                width: 320px;
                height: 320px;
                border-width: 15px;
            }

            .hero-image img {
                width: 250px;
                height: 250px;
            }
        }
    </style>
    </head>

    <body>

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

        <section class="hero-section">
            <div class="hero-content">
                <h1>CHIROPRACTIC</h1>
                <h2>CARE FOR THE FAMILY</h2>
                <p>Nunc accumsan dui vel lobortis pulvinar. Duis convallis odio ut dignissim faucibus. Sed sit amet urna
                    dictum.</p>
                <a href="{{ route('booking') }}" class="book-btn">Book An Appointment →</a>
            </div>
            <div class="hero-image">
                <div class="circle-bg"></div>
                <img src="https://i.postimg.cc/14hjkcLq/image-removebg-preview.png" alt="Female Doctor">
            </div>
        </section>

        <!-- Feature Bar Section Start -->
        <section class="feature-bar-section">
            <div class="feature-bar-container">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="feature-info">
                        <div class="feature-title">Expert Therapists</div>
                        <div class="feature-desc">Our team of licensed and certified physiotherapists</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="feature-info">
                        <div class="feature-title">Emergency Service</div>
                        <div class="feature-desc">Our team of licensed and certified physiotherapists</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-briefcase-medical"></i>
                    </div>
                    <div class="feature-info">
                        <div class="feature-title">Emergency Service</div>
                        <div class="feature-desc">Our team of licensed and certified physiotherapists</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="welcome-section">
            <div class="aboutus-container">
                <div class="aboutus-img">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/042/625/450/small_2x/physiotherapist-working-with-patient-in-clinic-closeup-a-modern-rehabilitation-physiotherapy-worker-with-senior-client-physical-therapist-stretching-patient-knee-photo.jpg"
                        alt="About Us" />
                </div>
                <div class="aboutus-content">
                    <span class="aboutus-pill">About Us</span>
                    <div class="aboutus-title">We Are The Best For<br>Physiotherapy</div>
                    <div class="aboutus-desc">We understand that injuries and acute pain can happen unexpectedly. Our
                        emergency physiotherapy services are designed to provide prompt and effective care to help you
                        manage pain, prevent further injury, and start your recovery process as quickly as possible.</div>
                    <div class="aboutus-features">
                        <div class="feature-item"><i class="fas fa-apple-alt"></i> Nutrition Strategies</div>
                        <div class="feature-item"><i class="fas fa-user-check"></i> Be Pro Active</div>
                        <div class="feature-item"><i class="fas fa-dumbbell"></i> Workout Routines</div>
                        <div class="feature-item"><i class="fas fa-comments"></i> Support & Motivation</div>
                    </div>
                    <a href="{{ route('booking') }}" class="aboutus-btn">Book An Appointment <span class="arrow">→</span></a>
                </div>
            </div>
        </section>

        <section class="services-section">
            <div class="container">
                <div class="services-header-row">
                    <span class="services-pill">Our Services</span>
                    <button class="services-viewall-btn">View All Subjects <span class="arrow">→</span></button>
                </div>
                <div class="services-title">We Provide The Best<br>Services</div>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-spa"></i></div>
                        <div class="service-title">Cupping Therapy</div>
                        <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                            justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                            turpis</div>
                        <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
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
                    <a href="{{ route('booking') }}" class="bottom-cta">Book An Appointment <span class="arrow">→</span></a>
                </div>
            </div>
        </section>

        <section class="unique-condition-section">
            <div class="container">
                <div class="section-header">
                    <h2 style="font-size:2.2em; font-weight:700; margin-bottom:10px;">WE TREAT YOUR UNIQUE CONDITION</h2>
                    <div style="font-size:1em; color:#444; margin-bottom:8px;">Don't let pain stand in the way of doing what
                        you love. Consult with our expert physiotherapists to help you live a better life!</div>
                    <div style="color:#ff3c1a; font-size:1em; font-weight:500; margin-bottom:24px;">Click on the body part
                        that is causing you pain</div>
                </div>
                <div class="condition-image" style="display:flex; justify-content:center; align-items:center;">
                    <svg viewBox="0 0 200 400" width="200" height="400" style="display:block;">
                        <!-- Blue Human Silhouette (simplified for clarity) -->
                        <g>
                            <ellipse cx="100" cy="60" rx="22" ry="30" fill="#00bfff" /> <!-- Head -->
                            <rect x="80" y="90" width="40" height="80" rx="20" fill="#00bfff" /> <!-- Torso -->
                            <rect x="60" y="90" width="18" height="70" rx="9" fill="#00bfff" /> <!-- Left Arm -->
                            <rect x="122" y="90" width="18" height="70" rx="9" fill="#00bfff" /> <!-- Right Arm -->
                            <rect x="90" y="170" width="12" height="60" rx="6" fill="#00bfff" /> <!-- Left Leg -->
                            <rect x="108" y="170" width="12" height="60" rx="6" fill="#00bfff" /> <!-- Right Leg -->
                        </g>
                        <!-- Pain Dots (clickable) -->
                        <a href="#" title="Head">
                            <circle cx="100" cy="60" r="7" fill="#ff9800" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Left Shoulder">
                            <circle cx="70" cy="100" r="7" fill="#7e57c2" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Right Shoulder">
                            <circle cx="130" cy="100" r="7" fill="#d32f2f" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Left Elbow">
                            <circle cx="60" cy="140" r="7" fill="#1976d2" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Right Elbow">
                            <circle cx="140" cy="140" r="7" fill="#388e3c" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Chest">
                            <circle cx="100" cy="120" r="7" fill="#00bcd4" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Left Knee">
                            <circle cx="96" cy="220" r="7" fill="#e91e63" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Right Knee">
                            <circle cx="114" cy="220" r="7" fill="#ffeb3b" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Left Ankle">
                            <circle cx="96" cy="260" r="7" fill="#3949ab" stroke="#fff" stroke-width="2" />
                        </a>
                        <a href="#" title="Right Ankle">
                            <circle cx="114" cy="260" r="7" fill="#212121" stroke="#fff" stroke-width="2" />
                        </a>
                    </svg>
                </div>
            </div>
        </section>

        <section class="why-chiropractor-section">
            <div class="attention-section">
                <div class="container">
                    <div class="attention-header">
                        <span class="attention-pill">Need Attention</span>
                        <h2>Where Do You Need Attention?</h2>
                        <p>We understand that injuries and acute pain can happen unexpectedly. Our emergency physiotherapy
                            services are designed to provide prompt and effective care to help you manage.</p>
                    </div>

                    <div class="attention-grid">
                        <div class="attention-card">
                            <i class="fas fa-user-md"></i> <span>Neck Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-walking"></i> <span>Knee Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-hand-paper"></i> <span>Hand Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-child"></i> <span>Shoulder Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-shoe-prints"></i> <span>Ankle Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-dumbbell"></i> <span>Tricep Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-hand-rock"></i> <span>Elbow Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-shoe-prints"></i> <span>Foot Pain</span>
                        </div>
                        <div class="attention-card">
                            <i class="fas fa-running"></i> <span>Sports Injuries</span>
                        </div>
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
                <div class="testimonials-pagination">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </section>

        <section class="blog-section">
            <div class="container">
                <div class="section-header blog-header">
                    <span class="blog-tag">News & Blog</span>
                    <h2>Our Latest Insights & Updates</h2>
                </div>
                <div class="blog-grid">
                    <div class="blog-post">
                        <div class="blog-img">
                            <img src="https://lirp.cdn-website.com/83ac98e3/dms3rep/multi/opt/benefits-of-physiotherapy-01-1920w.jpg"
                                alt="Physiotherapy benefits">
                        </div>
                        <div class="blog-content">
                            <h3>10 essential benefits of regular physiotherapy</h3>
                            <a href="#" class="blog-read">Read more <span>&rarr;</span></a>
                        </div>
                    </div>
                    <div class="blog-post">
                        <div class="blog-img">
                            <img src="https://www.minsterlaw.co.uk/wp-content/uploads/2021/05/PI01-scaled.jpg"
                                alt="Choosing a physiotherapist">
                        </div>
                        <div class="card-content">
                            <h3>How to choose the right physiotherapist for you</h3>
                            <a href="#" class="read-more">Read more &rarr;</a>
                        </div>
                    </div>

                    <div class=" blog-post">
                        <div class="card-image">
                            <img src="https://www.unitekcollege.edu/wp-content/uploads/2024/06/shutterstock_2206610103-scaled.jpg"
                                alt="Correct posture importance">
                        </div>
                        <div class="card-content">
                            <h3>Importance of correct posture and how to improve it</h3>
                            <a href="#" class="read-more">Read more &rarr;</a>
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
</x-app-layout>