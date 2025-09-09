<section class="services-section pt-2 pb-5">
    <div class="container px-4 px-md-0">
        <div class="row py-3 py-lg-5">
            <div class="d-flex flex-column flex-md-row align-items-start  justify-content-between align-items-md-center">
                <span class="services-pill">Our Services</span>
                <button class="services-viewall-btn">View All Subjects <span class="arrow">→</span></button>
            </div>
        </div>

        <div class="services-title heading_title">We Provide The Best<br>Services</div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @foreach ($services as $service)
                <div class="col d-flex">
                    <div class="service-card card flex-fill d-flex flex-column">
                        <div class="service-icon">
                            {!! 
                                html_entity_decode($service->icon)
                            !!}
                        </div>
                        <div class="service-title mt-2">{{ $service->title }}</div>
                        <div class="service-desc mt-2"> 
                            {!! $service->description
                                ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($service->description)), 70)
                                : 'No Description'
                            !!}
                        </div>
                        <br>
                        <div class="text-end mt-auto ">
                            <a href="{{ route('app.service.history', ['service' => $service->id, 'title' => \Illuminate\Support\Str::slug($service->title)]) }}" class="service-arrow"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
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