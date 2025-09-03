<section class="testimonials-section py-5">
    <div class="container px-4 px-md-0">
        <div class="testimonials-header  mb-4">
            <span class="testimonials-tag  mb-2">Clients Review</span>
            <h2 class="testimonials-title">What Our Client Say</h2>
        </div>
        <div class="testimonial_sliders row ">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-stars mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-text mb-3">
                        Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mr. Tom" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Mr. Tom</a>
                            <div class="testimonial-location text-muted">Baridhara, Dhaka</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-stars mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-text mb-3">
                        Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Ms. Lucy" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Ms. Lucy</a>
                            <div class="testimonial-location text-muted">Banani, Dhaka</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-stars mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-text mb-3">
                        Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Mr. Ali" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Mr. Ali</a>
                            <div class="testimonial-location text-muted">Gulshan, Dhaka</div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-stars mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-text mb-3">
                        Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Mr. Ali" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Mr. Ali</a>
                            <div class="testimonial-location text-muted">Gulshan, Dhaka</div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-stars mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-text mb-3">
                        Lorem ipsum dolor sit amet consectetur. Elementum egestas sed consequat justo neque.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Mr. Ali" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Mr. Ali</a>
                            <div class="testimonial-location text-muted">Gulshan, Dhaka</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
    <script>
        $(document).ready(function(){
            $('.testimonial_sliders').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                autoplay: false,
                autoplaySpeed: 3000,
                responsive: [
                    {
                        breakpoint: 992, // tablet
                        settings: { slidesToShow: 2 }
                    },
                    {
                        breakpoint: 768, // mobile
                        settings: { slidesToShow: 1 }
                    }
                ]
            });
        });
        </script>
@endpush