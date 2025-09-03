<footer class="site-footer">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="footer-column logo-column">
                    <a href=""><img class="app_logo" src="{{ asset('assets/img/logo.jpg') }}" alt=""></a>
                    <p class="mt-2">511 SW 10th Ave 1206, Portland, OR,<br>United States</p>
                    <p><a href="#" class="footer-link">View Directions</a></p>
                    <p><a href="tel:+8801857445897" class="footer-link">+88018574-45897</a></p>
                    <p><a href="mailto:example@gmail.com" class="footer-link">example@gmail.com</a></p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                   <div class="footer-column">
                        <h4>View Directions</h4>
                        <ul>
                            <li><a href="{{ route('app.about') }}" class="footer-link">About Us</a></li>
                            <li><a href="{{ route('app.services') }}" class="footer-link">Services</a></li>
                            <li><a href="{{ route('app.specialists') }}" class="footer-link">Our Team</a></li>
                            <li><a href="{{ route('app.shop') }}" class="footer-link">Shop</a></li>
                            <li><a href="{{ route('app.contact') }}" class="footer-link">Contacts</a></li>
                        </ul>
                    </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
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
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="footer-column subscribe-column">
                    <h4>Subscribe </h4>
                    <form class="newsletter-form d-flex flex-column gap-3">
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
        </div>
    
    </div>
</footer>