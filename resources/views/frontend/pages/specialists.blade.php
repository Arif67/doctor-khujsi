@extends('layouts.app')
@push('styles')
    <style>
        /* Booking Section */
        .booking-section {
            width: 100%;
            background: #fff;
            padding: 80px 0px;
        }

        .booking-section .container {
            background: #fff;
            display: flex;
            flex-direction: row;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44, 140, 153, 0.10);
            overflow: hidden;
        }

        .booking-image {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .booking-image img {
            width: 100%;
            object-fit: cover;
            border-radius: 16px;
            margin: 32px 0 32px 0;
            box-shadow: 0 4px 18px rgba(44, 140, 153, 0.08);
        }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-bottom: 6px;
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

        label {
            font-size: 0.97em;
            color: #1b6b7a;
            font-weight: 500;
            margin-bottom: 2px;
            display: block;
        }

        input.form-control,
        select.form-select {
            padding: 11px 14px;
            border: 1.5px solid #a3e2ea;
            border-radius: 8px;
             font-size: 1em;
            font-family: inherit;
            color: #222;
             outline: none;
            transition: border 0.2s; 
        }

        input.form-control,
        select.form-select {
            padding: 12px 16px;
        }


        select.form-control:focus,
        select.form-select:focus {
            border: none;
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

        
        @media only screen and (max-width: 600px){
            .booking-section{
                padding: 50px 0px;
            }
        }
        @media (min-width: 600px) and (max-width: 767px) {
            .booking-section{
                padding: 50px 0px;
            }
        }
    </style>  
@endpush
@section('content')
   {{-- <section class="services-section">
        <div class="container px-4 px-md-0">
            <div class="row row-gap-5 align-items-center">
                <div class="col-md-6">
                    <div class="services-img">
                        <img src="https://i.postimg.cc/44FzPQc8/image.png" alt="Exercise Services">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="services-content">
                        <span class="services-pill">Our Specialists</span>
                        <h2 class="heading_title mb-4">Our Dedicated & Experienced Therapist Team</h2>
                        <p class="services-desc">
                            World-class rehabilitation solutions and individualized recovery plans,
                            from acute care to ongoing outpatient treatment and beyond.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @includeIf('components.app.doctors') --}}

    <section class="booking-section">
        <div class="">
            <div class="container p-4">
                <div class="row align-items-center row-gap-5">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="booking-image">
                            <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="booking-image">
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                         <div class="booking-content px-md-4 ">
                            <div class="book-appointment-tag">Book Your Appointment</div>
                            <h2 class="heading_title mb-4">BOOK YOUR CONSULTATION</h2>
                            <div class="booking-desc">Enter your details below and we will follow up with you to book your
                                appointment.</div>
                            <form class="booking-form">
                                <div class="row row-gap-4">
                                    <div class="col-md-6">
                                        <label for="services">Services</label>
                                        <select class="form-select" id="services" name="services">
                                            <option value="">Services Name</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                       <label for="doctor">Doctor</label>
                                        <select class="form-select" id="doctor" name="doctor">
                                            <option value="">Doctor Name</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="your-name">Your Name*</label>
                                        <input type="text" class="form-control" id="your-name" name="your-name" placeholder="Your Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="your-phone">Your Phone</label>
                                        <input type="text" class="form-control" id="your-phone" name="your-phone" placeholder="Your Phone Number">
                                    </div>
                                     <div class="col-md-6">
                                        <label for="your-phone">Your Phone</label>
                                        <input type="text" class="form-control" id="your-phone" name="your-phone" placeholder="Your Phone Number">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="time">Time</label>
                                        <div style="display: flex; gap: 16px;">
                                            <select class="form-select" id="time-start" name="time-start">
                                                <option value="">3:00</option>
                                            </select>
                                            <select class="form-select" id="time-end" name="time-end">
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
                
            </div>
        </div>

    </section>
@endsection
