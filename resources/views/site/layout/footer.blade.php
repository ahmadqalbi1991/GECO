<footer>
    <div class="footer-top footer-bg s-footer-bg">
        <!-- newsletter-area -->
        <div class="newsletter-area s-newsletter-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="newsletter-wrap">
                            <div class="section-title newsletter-title">
                                <h2>Our <span>Newsletter</span></h2>
                            </div>
                            <div class="newsletter-form">
                                <form action="{{ route('site.subscribe') }}" method="post">
                                    @csrf
                                    <div class="newsletter-form-grp">
                                        <i class="far fa-envelope"></i>
                                        <input name="email" type="email" placeholder="Enter your email for subscription">
                                    </div>
                                    <button>SUBSCRIBE <i class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- newsletter-area-end -->
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="footer-logo mb-35">
                            <a href="index.html"><img src="{{ asset('site/img/logo/logo.png') }}" alt=""></a>
                        </div>
                        <div class="footer-text">
                            <p>Gemas marketplace the relase etras thats sheets continig passag.</p>
                            <div class="footer-contact">
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i> <span>Address : </span>PO Box W75 Street
                                        lan West new queens</li>
                                    <li><i class="fas fa-headphones"></i> <span>Phone : </span>+24 1245 654 235</li>
                                    <li><i class="fas fa-envelope-open"></i><span>Email : </span>info@exemple.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Products</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                <li><a href="{{ route('site.shop') }}?cat=console">Console ({{ \App\Models\Product::where('category',
                                'console')
                                ->count() }})</a></li>
                                <li><a href="{{ route('site.shop') }}?cat=headphones">Headphones ({{ \App\Models\Product::where('category',
                                'headphones')->count() }})</a></li>
                                <li><a href="{{ route('site.shop') }}?cat=gamepad">Gamepad ({{ \App\Models\Product::where('category', 'gamepad')
                                ->count() }})</a></li>
                                <li><a href="{{ route('site.shop') }}?cat=gamecontroller">Game Controller ({{ \App\Models\Product::where('category',
                                'gamecontroller')->count() }})</a></li>
                                <li><a href="{{ route('site.shop') }}?cat=games">Games ({{ \App\Models\Product::where('category', 'games')->count()
                                 }})</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Need Help?</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                <li><a href="{{ route('site.terms') }}">Terms & Conditions</a></li>
                                <li><a href="{{ route('site.privacy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('site.shop') }}">Shop</a></li>
                                <li><a href="{{ route('site.tournaments') }}">Tournaments</a></li>
                                <li><a href="{{ route('site.about') }}">About Us</a></li>
                                <li><a href="{{ route('site.contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 cseaol-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-35">
                            <h5>Follow us</h5>
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li><a href="{{ site_setting('facebook_url') }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ site_setting('twitter_url') }}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{ site_setting('pinterest_url') }}"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="{{ site_setting('linkedin_url') }}"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-fire"><img src="{{ asset('site/img/images/footer_fire.png') }}" alt=""></div>
        <div class="footer-fire footer-fire-right"><img src="{{ asset('site/img/images/footer_fire.png') }}" alt=""></div>
    </div>
    <div class="copyright-wrap s-copyright-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text">
                        <p>Copyright © 2020 <a href="#">Geco</a> All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <div class="payment-method-img text-right" style="font-size: 30px">
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
