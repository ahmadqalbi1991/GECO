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
                            <li><a href="{{ site_setting('facebook_url') }}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ site_setting('twitter_url') }}"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ site_setting('pinterest_url') }}"><i class="fab fa-pinterest-p"></i></a>
                            </li>
                            <li><a href="{{ site_setting('linkedin_url') }}"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="{{ site_setting('youtube_url') }}"><i class="fab fa-youtube"></i></a></li>
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
                                <a href="{{ route('site.home') }}"><img src="{{ asset('site/img/logo/logo_two.png') }}" alt="Logo"></a>
                            </div>
                            <div id="mobile-menu" class="navbar-wrap d-none d-lg-flex">
                                <ul>
                                    <li class="{{ Request::is('/') ? 'active' : NULL }}"><a
                                            href="{{ route('site.home') }}">Home</a></li>
                                    <li class="{{ Request::is('about-us') ? 'active' : NULL }}"><a
                                            href="{{ route('site.about') }}">About Us</a></li>
                                    @if(!Auth::user() || !Auth::user()->is_admin)
                                        <li class="{{ Request::is('shop') ? 'active' : NULL }}"><a
                                                href="{{ route('site.shop') }}">Shop</a></li>
                                        <li class="{{ Request::is('tournaments') ? 'active' : NULL }}"><a
                                                href="{{ route('site.tournaments') }}">Tournaments</a></li>
                                    @elseif(isset(Auth::user()->is_admin) && Auth::user()->is_admin)
                                        <li><a href="{{ route('admin.login') }}">Dashboard</a></li>
                                    @endif
                                    <li class="{{ Request::is('blogs') ? 'active' : NULL }}"><a
                                            href="{{ route('site.blogs') }}">Blogs</a></li>
                                    <li class="{{ Request::is('contact-us') ? 'active' : NULL }}"><a
                                            href="{{ route('site.contact') }}">Contact Us</a></li>
                                    @if(!Auth::user())
                                        <li><a href="#"><i class="fa fa-cog"></i></a>
                                            <ul class="submenu">
                                                <li><a
                                                        href="{{ route('site.user.login') }}">Login</a></li>
                                                <li><a
                                                        href="{{ route('site.user.register') }}">Register</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="#"><i class="fa fa-cog"></i></a>
                                            <ul class="submenu">
                                                @if(isset(Auth::user()->is_admin) && !Auth::user()->is_admin)
                                                    <li><a href="{{ route('site.my-profile') }}">My profile</a></li>
                                                    <li><a href="{{ route('site.my-orders') }}">My Orders</a></li>
                                                    <li><a href="{{ route('site.my-tournaments') }}">My Tournaments</a>
                                                    </li>
                                                @endif
                                                <li><a href="{{ route('logout') }}">Logout</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="header-action">

                                <ul>
                                    <li class="header-shop-cart"><a href="#"><i
                                                class="fas fa-shopping-basket"></i><span>{{ Session::has('cart') ? count(Session::get('cart')) : 0 }}</span></a>
                                        <ul class="minicart">
                                            @if(Session::has('cart') && count(Session::get('cart')))
                                                @php $carts = Session::get('cart'); $total = 0; @endphp
                                                @foreach($carts as $key => $cart)
                                                    @php $total = $total + ($cart['price'] * $cart['qty']);  @endphp
                                                    <li class="d-flex align-items-start">
                                                        <div class="cart-img">
                                                            <a href="#">
                                                                <img src="{{ asset('products/' . $cart['image']) }}"
                                                                     alt="">
                                                            </a>
                                                        </div>
                                                        <div class="cart-content">
                                                            <h4>
                                                                <a href="#">{{ $cart['name'] }}</a>
                                                            </h4>
                                                            <div class="cart-price">
                                                                <span
                                                                    class="new">$ {{ number_format($cart['price']) }}</span>
                                                            </div>
                                                            <div class="cart-price">
                                                                QTY <span
                                                                    class="new">{{ number_format($cart['qty']) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="del-icon">
                                                            <a href="{{ route('site.remove-cart-item', $key) }}">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li>
                                                    <div class="total-price">
                                                        <span class="f-left">Total:</span>
                                                        <span class="f-right">$ {{ number_format($total) }}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout-link">
                                                        <a href="{{ route('site.cart') }}">View Cart</a>
                                                        <a class="red-color" href="{{ route('site.cart') }}">Checkout</a>
                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    No Cart
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="header-search"><a href="#" data-toggle="modal"
                                                                 data-target="#search-modal"><i
                                                class="fas fa-search"></i></a></li>
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
                            <form action="{{ route('site.shop') }}">
                                <input name="q" type="text" placeholder="Search Product">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
