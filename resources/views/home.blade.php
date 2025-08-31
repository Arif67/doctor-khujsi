@extends('layouts.app')

@section('content')
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
@endsection
