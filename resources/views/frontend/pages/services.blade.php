@extends('layouts.app')

@section('title', 'Our Services - Hospital Management')

@section('content')
<section class="services-section">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="services-hero-img-wrap">
                    <img src="https://www.nurseregistry.com/wp-content/uploads/2019/01/nurses-in-hospital-setting.jpg" alt="Exercise Services">
                </div>
            </div>
            <div class="col-md-6">
                 <div class="services-hero-content">
                    <span class="services-hero-pill">Our Services</span>
                    <div class="heading_title mb-4">We Provide The Best<br>Services</div>
                    <div class="services-hero-desc">World-class rehabilitation solutions and individualized recovery plans, from acute care to ongoing outpatient treatment and beyond.</div>
                </div>    
            </div>
        </div>
    </div>
</section>

<section class="services-section py-4 py-lg-5" style="background: none">
    <div class="container px-4 px-md-0">
        <div class="row py-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="services-pill">Our Services</span>
            </div>
        </div>

        <div class="services-title heading_title">We Provide The Best<br>Services</div>
        <div class="row row-gap-4">
            <div class="col-md-6 col-xl-3">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-spa"></i></div>
                    <div class="service-title">Cupping Therapy</div>
                    <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                        justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                        turpis</div>
                    <div class="text-end mt-3">
                        <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
               <div class="service-card">
                    <div class="service-icon"><i class="fas fa-hands"></i></div>
                    <div class="service-title">Manual Therapy</div>
                    <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                        justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                        turpis</div>
                    <div class="text-end mt-3">
                        <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>         
            </div>    
            <div class="col-md-6 col-xl-3">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-heartbeat"></i></div>
                    <div class="service-title">chronic pain</div>
                    <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                        justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                        turpis</div>
                    <div class="text-end mt-3">
                        <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-hand-paper"></i></div>
                    <div class="service-title">Hand therapy</div>
                    <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                        justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                        turpis</div>
                    <div class="text-end mt-3">
                        <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-xl-3">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-hand-paper"></i></div>
                    <div class="service-title">Hand therapy</div>
                    <div class="service-desc">Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat
                        justo neque. Varius nullam adipiscing proin dapibus integer viverra eu. Quis nibh convallis
                        turpis</div>
                    <div class="text-end mt-3">
                        <button class="service-arrow"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="services-bottom-bar d-flex gap-3 flex-column flex-lg-row justify-content-between mt-4">
            <div class="services-bottom-left">
                <div class="bottom-icon"><i class="fas fa-info-circle"></i></div>
                <div>
                    <div class="bottom-title">Ready to start your journey to recovery?</div>
                    <div class="bottom-desc">We understand that injuries and acute pain can unexpectedly. Our
                        emergency physiotherapy.</div>
                </div>
            </div>
            <a href="{{ route('app.booking') }}" class="bottom-cta">Book An Appointment <span class="arrow">→</span></a>
        </div>
    </div>
</section>
@includeIf('components.app.testimonials')
@endsection