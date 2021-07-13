<header class="header-style-four">
    <div class="header-top-area s-header-top-area d-none d-lg-block">
        <div class="container custom-container-two">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                </div>
                <div class="col-lg-6">
                    <div class="header-social">
                        <span>Follow us on :</span>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header" class="header-four-wrap">
        <div class="container custom-container-two">
            <div class="row">
                <div class="col-12">
                    <div class="main-menu menu-style-two">
                        <nav>
                            <div class="logo">
                                <a href="index-4.html"><img src="{{ asset('site/img/logo/logo_two.png') }}" alt="Logo"></a>
                            </div>
                            <div id="mobile-menu" class="navbar-wrap d-none d-lg-flex">
                                <ul>
                                    <li class="{{ Request::is('/') ? 'active' : NULL }}"><a href="{{ route('site.home') }}">Home</a></li>
                                    <li class="{{ Request::is('tournaments') ? 'active' : NULL }}"><a href="{{ route('site.tournaments') }}">Tournaments</a></li>
                                    @if(!Auth::user())
                                        <li class="{{ Request::is('login') ? 'active' : NULL }}"><a href="{{ route('site.user.login') }}">Login</a></li>
                                        <li class="{{ Request::is('register') ? 'active' : NULL }}"><a href="{{ route('site.user.register') }}">Register</a></li>
                                    @else
                                        <li><a href="#"><i class="fa fa-cog"></i></a>
                                            <ul class="submenu">
                                                <li><a href="about-us.html">My profile</a></li>
                                                <li><a href="upcoming-games.html">My TOurnaments</a></li>
                                                <li><a href="{{ route('logout') }}">Logout</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="header-action">
                                <ul>
                                    <li class="header-shop-cart"><a href="#"><i class="fas fa-shopping-basket"></i><span>0</span></a>
                                        <ul class="minicart">
                                            <li class="d-flex align-items-start">
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img src="{{ asset('site/img/product/cart_p01.jpg') }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="cart-content">
                                                    <h4>
                                                        <a href="#">Xbox One Controller</a>
                                                    </h4>
                                                    <div class="cart-price">
                                                        <span class="new">$229.9</span>
                                                        <span>
                                                                    <del>$229.9</del>
                                                                </span>
                                                    </div>
                                                </div>
                                                <div class="del-icon">
                                                    <a href="#">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="total-price">
                                                    <span class="f-left">Total:</span>
                                                    <span class="f-right">$239.9</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkout-link">
                                                    <a href="cart.html">Shopping Cart</a>
                                                    <a class="red-color" href="checkout.html">Checkout</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-search"><a href="#" data-toggle="modal" data-target="#search-modal"><i class="fas fa-search"></i></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="mobile-menu"></div>
                </div>
                <!-- Modal Search -->
                <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form>
                                <input type="text" placeholder="Search here...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
