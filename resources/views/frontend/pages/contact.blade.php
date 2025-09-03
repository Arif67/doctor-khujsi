@extends('layouts.app')

@section('title', 'Contact Us - Hospital Management')

@section('content')

<section class="contact_banner_section">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="">
                    <span class="section-pill">Contact Us</span>
                    <h1 class="heading_title mb-5">Contact Us Easily Online,<br>by Phone or by Dropping In</h1>
                    <div class="about-btn-row">
                        <a href="#" class="about-btn about-btn-main">
                            Book An Appointment <i class="fa fa-arrow-right"></i>
                        </a>
                        <a href="tel:+8801857445897" class="about-btn about-btn-call">
                            +88018574-45897 <i class="fa fa-phone"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact_banner_img">
                    <img src="{{asset('blogs/blog_1.png')}}" alt="Contact Hero">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info + Map Section -->
 <section class="contact-map-section">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="contact-info-col">
                    <h2 class="heading_title">Contact Information</h2>
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
            </div>
            <div class="col-md-6">
                <div class="contact-map-embed">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9021397204415!2d90.39109741498116!3d23.750885984589207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b896b3b4a63b%3A0x123456789abcdef!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1594274197294!5m2!1sen!2sbd"
                        width="100%" height="320" style="border:0; border-radius:18px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form + Image Section -->
<section class="contact-form-section">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                 <div class="contact-form-img">
                    <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="Contact Physiotherapy">
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                 <div class="contact-form-block">
                    <h2 class="heading_title">Contact Information</h2>
                    <p class="contact-form-desc">If you have any questions, you can contact us. Please, fill out the form
                        below.</p>
                    <form class="contact-form">
                        <div class="row row-gap-4">
                            <div class="col-lg-6">
                                <label for="contact-name" class="form-label">Your Name</label>
                                <input id="contact-name" type="text" class="form-input form-control" placeholder="Your Name">
                            </div>
                            <div class="col-lg-6">
                                <label for="contact-email" class="form-label">Your Email</label>
                                <input id="contact-email" type="email" class="form-input form-control" placeholder="Your Email">
                            </div>
                            <div class="col-12">
                                <label for="contact-message" class="form-label">Your Message</label>
                                <textarea id="contact-message" class="form-textarea form-control" rows="4"
                                    placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="form-submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
       
       
    </div>
</section>

@endsection