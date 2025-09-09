@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<section class="hero-section overflow-hidden">
    <div class="container">
        <div class="row align-items-center row-gap-5">
            <div class="col-12 col-lg-6">
                <div class="hero-content">
                    <h1>CHIROPRACTIC</h1>
                    <h2>CARE FOR THE FAMILY</h2>
                    <p>Nunc accumsan dui vel lobortis pulvinar. Duis convallis odio ut dignissim faucibus. Sed sit amet urna
                        dictum.</p>
                    <a href="{{ route('app.booking') }}" class="book-btn">Book An Appointment →</a>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="hero-image d-flex align-items-center justify-content-center justify-content-lg-end">
                    <div class="circle-bg"></div>
                        <img src="https://i.postimg.cc/14hjkcLq/image-removebg-preview.png" alt="Female Doctor">
                </div>
            </div>
        </div>
    </div>
</section> 

<!-- Feature Bar Section Start -->
<section class="feature-bar-section">
    <div class="container">
        <div class="row row-gap-4">
            <div class="col-12 col-md-4 text-center">
                 <div class="feature-card d-flex row-gap-2 flex-column align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="feature-info">
                        <div class="feature-title">Expert Therapists</div>
                        <div class="feature-desc px-lg-5">Our team of licensed and certified physiotherapists</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center">
                <div class="feature-card d-flex row-gap-2 flex-column align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="feature-info">
                        <div class="feature-title">Emergency Service</div>
                        <div class="feature-desc px-lg-5">Our team of licensed and certified physiotherapists</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center">
                 <div class="feature-card d-flex row-gap-2 flex-column align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-briefcase-medical"></i>
                    </div>
                    <div class="feature-info">
                        <div class="feature-title">Emergency Service</div>
                        <div class="feature-desc px-lg-5">Our team of licensed and certified physiotherapists</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="welcome-section">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-lg-6">
                <div class="aboutus-img">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/042/625/450/small_2x/physiotherapist-working-with-patient-in-clinic-closeup-a-modern-rehabilitation-physiotherapy-worker-with-senior-client-physical-therapist-stretching-patient-knee-photo.jpg"
                        alt="About Us" />
                </div>
            </div>
            <div class="col-lg-6">
                 <div class="aboutus-content">
                    <span class="aboutus-pill">About Us</span>
                    <div class="aboutus-title heading_title">We Are The Best For<br>Physiotherapy</div>
                    <div class="aboutus-desc">We understand that injuries and acute pain can happen unexpectedly. Our
                        emergency physiotherapy services are designed to provide prompt and effective care to help you
                        manage pain, prevent further injury, and start your recovery process as quickly as possible.</div>
                    <div class="aboutus-features">
                        <div class="feature-item"><i class="fas fa-apple-alt"></i> Nutrition Strategies</div>
                        <div class="feature-item"><i class="fas fa-user-check"></i> Be Pro Active</div>
                        <div class="feature-item"><i class="fas fa-dumbbell"></i> Workout Routines</div>
                        <div class="feature-item"><i class="fas fa-comments"></i> Support & Motivation</div>
                    </div>
                    <a href="{{ route('app.booking') }}" class="aboutus-btn">Book An Appointment <span class="arrow">→</span></a>
                </div>
            </div>
        </div>
    </div>
</section> 

@includeIf('components.app.services',$services)

<section class="unique-condition-section">
    <div class="container">
        <div class="section-header">
            <h2 class="heading_title">WE TREAT YOUR UNIQUE CONDITION</h2>
            <div style="font-size:1em; color:#444; margin-bottom:8px;">Don't let pain stand in the way of doing what
                you love. Consult with our expert physiotherapists to help you live a better life!</div>
            <div style="color:#ff3c1a; font-size:1em; font-weight:500; margin-bottom:24px;">Click on the body part
                that is causing you pain</div>
        </div>
        <div class="condition-image" style="display:flex; justify-content:center; align-items:center;">
            <svg viewBox="0 0 200 400" width="200" style="display:block;">
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
        <div class="container px-4 px-md-0">
            <div class="attention-header">
                <span class="attention-pill">Need Attention</span>
                <h2 class="heading_title">Where Do You Need Attention?</h2>
                <p class="">We understand that injuries and acute pain can happen unexpectedly. Our emergency physiotherapy
                    services are designed to provide prompt and effective care to help you manage.</p>
            </div>

            <div class="attention-grid">
                @foreach($attentions as $attention)
                    <div class="attention-card">
                        {!! $attention->icon ?? '<i class="fas fa-user-md"></i>' !!}
                        <span>{{ $attention->title ?? 'No Title' }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@includeIf('components.app.doctors',$doctores)

@includeIf('components.app.testimonials')

<section class="blog-section">
    <div class="container px-4 px-md-0">
        <div class="section-header blog-header">
            <span class="blog-tag">News & Blog</span>
            <h2>Our Latest Insights & Updates</h2>
        </div>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-lg-4">
                    <div class="blog-post ">
                        <div class="blog-img">
                            <img src="{{ $blog->thumbnail_image ? asset('storage/' . $blog->thumbnail_image) : 'https://lirp.cdn-website.com/83ac98e3/dms3rep/multi/opt/benefits-of-physiotherapy-01-1920w.jpg' }}" 
                                alt="{{ $blog->title }}">
                        </div>
                        <div class="blog-content">
                            <h3>{{ $blog->title }}</h3>
                            <a href="{{ route('app.blog.info', ['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)]) }}" class="blog-read">
                                Read more <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
