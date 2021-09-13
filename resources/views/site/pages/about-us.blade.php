@extends('site.main')

@section('content')
    <main>

        <section class="inner-about-area fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-6 order-0 order-lg-2">
                        <div class="inner-about-img">
                            <img src="{{ asset('site/img/images/inner_about_img01.png') }}" class="wow fadeInRight" data-wow-delay=".3s" alt="">
                            <img src="{{ asset('site/img/images/inner_about_img02.png') }}" class="wow fadeInLeft" data-wow-delay=".6s" alt="">
                            <img src="{{ asset('site/img/images/inner_about_img03.png') }}" class="wow fadeInUp" data-wow-delay=".6s" alt="">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="section-title title-style-three mb-25">
                            <h2>released <span>GAMES</span></h2>
                        </div>
                        <div class="inner-about-content">
                            <h5>Monica Global Publishing for Marketing</h5>
                            <p>Compete with 100 players on a remote Lorem Ipsn gravida. Pro ain gravida nibh vel velit an auctor aliqueenean
                                ollicitudin ain gravida nibh vel version an ipsum.</p>
                            <p>Lorem Ipsn gravida. Pro ain gravida nibh vevelit auctor aliqueenean ollicitudin ain gravida nibh vel version an ipsum.</p>
                            <a href="#" class="btn btn-style-two">BUY THEME</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-about-shape"><img src="img/images/medale_shape.png" alt=""></div>
        </section>

        <section class="team-member-area pt-115 pb-125"{{ asset('site/') }}>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title title-style-three text-center mb-70">
                            <h2>Our team <span>member</span></h2>
                            <p>Compete with 100 players on a remote island for winner takes showdown
                                known issue where certain skin strategic</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-member-box text-center mb-50">
                            <div class="team-member-thumb">
                                <img src="{{ asset('site/img/team/team_member01.jpg') }}" alt="">
                                <div class="team-member-social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-member-content">
                                <h4><a href="#">tomas aleman</a></h4>
                                <span>Marketing CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-member-box text-center mb-50">
                            <div class="team-member-thumb">
                                <img src="{{ asset('site/img/team/team_member02.jpg') }}" alt="">
                                <div class="team-member-social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-member-content">
                                <h4><a href="#">james wiseman</a></h4>
                                <span>Marketing CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-member-box text-center mb-50">
                            <div class="team-member-thumb">
                                <img src="{{ asset('site/img/team/team_member03.jpg') }}" alt="">
                                <div class="team-member-social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-member-content">
                                <h4><a href="#">emily watson</a></h4>
                                <span>Head of Iaea</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-member-box text-center mb-50">
                            <div class="team-member-thumb">
                                <img src="{{ asset('site/img/team/team_member04.jpg') }}" alt="">
                                <div class="team-member-social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-member-content">
                                <h4><a href="#">alexandra paol</a></h4>
                                <span>Web Developer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
