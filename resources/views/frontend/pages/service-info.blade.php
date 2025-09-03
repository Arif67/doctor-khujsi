
@extends('layouts.app')

@section('title', 'Service History - Hospital Management')

@push('styles')
<style>

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

</style>
@endpush

@section('content')
    
   
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

    @includeIf('components.app.doctors')
@endsection
