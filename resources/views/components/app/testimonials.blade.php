<section class="testimonials-section py-5">
    <div class="container">
        <div class="testimonials-header mb-4">
            <span class="section-eyebrow mb-3">{{ __('Patient feedback') }}</span>
            <h2 class="section-title">{{ __('Why patients trust the doctor-finding flow.') }}</h2>
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
                        Doctor khuje shortlist korte onek easy lagse. Hospital, specialty ar doctor info ekshathe dekhe decision nite perechi.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mr. Tom" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Rezaul Karim</a>
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
                        Account khola chara booking request dite perechi. Eita family member-er jonno doctor book korte onek helpful.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Ms. Lucy" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Nusrat Jahan</a>
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
                        Age, note, ar doctor select kore instantly request pathate perechi. Flow ta clear and patient-friendly.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Mr. Ali" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Imran Hossain</a>
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
                        Department and hospital details visible thakar jonno right doctor choose kora onek easier hoyeche.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Mr. Ali" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Shihab Ahmed</a>
                            <div class="testimonial-location text-muted">Mirpur, Dhaka</div>
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
                        Amar ma-r jonno doctor search korte giye profile page-r education and shift info ta onek useful lagse.
                    </div>
                    <div class="testimonial-user d-flex align-items-center gap-3">
                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Mr. Ali" class="testimonial-avatar rounded-circle" width="50" height="50">
                        <div>
                            <a href="#" class="testimonial-name fw-bold">Farhana Islam</a>
                            <div class="testimonial-location text-muted">Uttara, Dhaka</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .testimonial-card {
        background: #fff;
        border-radius: 24px;
        padding: 24px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        box-shadow: 0 16px 32px rgba(15, 55, 60, 0.06);
        margin: 8px;
    }

    .testimonial-stars {
        color: #f4a261;
    }

    .testimonial-text {
        color: var(--brand-muted);
        min-height: 84px;
    }

    .testimonial-name {
        color: var(--brand-ink);
        text-decoration: none;
    }

    .testimonial-location {
        color: var(--brand-muted) !important;
    }
</style>


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
