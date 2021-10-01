@extends('site.main')

@section('content')
    <main>

        <!-- slider-area -->
        <section class="slider-area home-four-slider">
            <div class="slider-active">
                <div class="single-slider slider-bg slider-style-two">
                    <div class="container custom-container-two">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-11">
                                <div class="slider-content">
                                    <h6 data-animation="fadeInUp" data-delay=".4s">world gaming</h6>
                                    <h2 data-animation="fadeInUp" data-delay=".4s">Create <span>Manage</span> Matches
                                    </h2>
                                    <p data-animation="fadeInUp" data-delay=".6s">Find technology or people for digital
                                        projects in public sector and Find an individual specialist develope
                                        researcher.</p>
                                    <a href="{{ route('site.blog', 1) }}" class="btn btn-style-two"
                                       data-animation="fadeInUp" data-delay=".8s">READ
                                        MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="slider-img"><img src="{{ asset('site/img/slider/four_slider_img01.png') }}" alt=""
                                                     data-animation="slideInRightS" data-delay=".8s"></div>
                    </div>
                </div>
                <div class="single-slider slider-bg slider-style-two">
                    <div class="container custom-container-two">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-11">
                                <div class="slider-content">
                                    <h6 data-animation="fadeInUp" data-delay=".4s">world gaming</h6>
                                    <h2 data-animation="fadeInUp" data-delay=".4s">Create <span>Manage</span> Matches
                                    </h2>
                                    <p data-animation="fadeInUp" data-delay=".6s">Find technology or people for digital
                                        projects in public sector and Find an individual specialist develope
                                        researcher.</p>
                                    <a href="#" class="btn btn-style-two" data-animation="fadeInUp" data-delay=".8s">READ
                                        MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="slider-img"><img src="{{ asset('site/img/slider/four_slider_img02.png') }}" alt=""
                                                     data-animation="slideInRightS" data-delay=".8s"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- brand-area -->
        <div class="brand-area brand-bg home-four-brand">
            <div class="container">
                <div class="row brand-active">
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo01.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo02.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo03.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo04.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo05.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo06.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="brand-item">
                            <img src="{{ asset('site/img/brand/brand_logo03.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand-area-end -->

        <!-- home-four-area-bg -->
        <div class="home-four-area-bg">
            <div class="bg"></div>
            <!-- latest-games-area -->
            <section class="latest-games-area home-four-latest-games pt-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="section-title home-four-title mb-50">
                                <span>Our Games</span>
                                <h2>Buy & <span>Enjoy</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="latest-games-active owl-carousel">
                                @foreach($tournaments as $tournament)
                                    <div class="latest-games-items mb-30">
                                        <div class="latest-games-thumb">
                                            <a href="#"><img
                                                    src="{{ asset('games/tournaments/' . $tournament->image) }}" alt=""></a>
                                        </div>
                                        <div class="latest-games-content">
                                            <div class="lg-tag">
                                                <a href="#">{{ $tournament->game->game_type }}</a>
                                            </div>
                                            <h4><a href="#">{{ $tournament->game->game_name }}
                                                    <span>{{ $tournament->game->game_name }}</span></a></h4>
                                            <p>entry fee :
                                                <span>Rs. {{ $tournament->price ? $tournament->price : 'free' }}</span>
                                            </p>
                                            <p>@if(\Carbon\Carbon::parse($tournament->tournament_start_date)->format('Y-m-d') >= \Carbon\Carbon::now
                                            ()->format('Y-m-d')) Open @else Ended @endif</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- latest-games-area-end -->

            <!-- live-match-area -->
            <section class="live-match-area pt-90">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="section-title home-four-title text-center mb-60">
                                <h2>watch live <span>match</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-9">
                            <div class="live-match-wrap">
                                <img src="{{ asset('site/img/images/live_match_img.jpg') }}" alt="">
                                <a href="{{ site_setting('streaming_url') }}" class="popup-video"><img
                                        src="{{ asset('site/img/icon/video_play_icon.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- live-match-area-end -->

            <!-- live-match-team-area -->
            <section class="live-match-area fix pt-120 pb-110">
                <div class="container custom-container-two">
                    <div class="row">
                        <div class="col-12">
                            <div class="latest-games-active owl-carousel">
                                @foreach($upcoming_tournaments as $tournament)
                                    <div class="latest-games-items mb-30">
                                        <div class="latest-games-thumb">
                                            <a href="#"><img
                                                    src="{{ asset('games/tournaments/' . $tournament->image) }}" alt=""></a>
                                        </div>
                                        <div class="latest-games-content">
                                            <div class="lg-tag">
                                                <a href="#">{{ $tournament->game->game_type }}</a>
                                            </div>
                                            <h4><a href="#">{{ $tournament->game->game_name }}
                                                    <span>{{ $tournament->game->game_name }}</span></a></h4>
                                            <p>entry fee :
                                                <span>Rs. {{ $tournament->price ? $tournament->price : 'free' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- live-match-team-area-end -->

        </div>
        <!-- home-four-area-bg-end -->

        <!-- featured-game-area -->
        <section class="featured-game-area new-released-game-area pt-115 pb-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-title home-four-title black-title text-center mb-60">
                            <h2>ALL <span>GAMES</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid container-full">
                <div class="row no-gutters new-released-game-active">
                    @foreach($games as $game)
                        <div class="col-lg-3">
                            <div class="featured-game-item mb-30">
                                <div class="featured-game-thumb">
                                    <img src="{{ asset('games/' . $game->image) }}" alt="">
                                </div>
                                <div class="featured-game-content">
                                    <h4><a href="#">{{ $game->game_name }} <span>{{ $game->game_type }}</span></a></h4>
                                </div>
                                <div class="featured-game-content featured-game-overlay-content">
                                    <div class="featured-game-icon"><img
                                            src="{{ asset('site/img/icon/featured_game_icon.png') }}" alt=""></div>
                                    <h4><a href="#">J{{ $game->game_name }}</a></h4>
                                    <div class="featured-game-meta">
                                        <i class="fas fa-bell"></i>
                                        <span>{{ $game->game_type }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- featured-game-area-end -->

        <!-- shop-area -->
        <section class="shop-area home-four-shop-area pt-115 pb-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title home-four-title text-center mb-35">
                            <h2>gaming product <span>corner</span></h2>
                            <p>Compete with 100 players on a remote island for winner takes showdown known issue where
                                certain skin strategic</p>
                        </div>
                    </div>
                </div>
                <div class="row product-active">
                    @foreach($products as $product)
                        <div class="col-xl-3">
                            <div class="shop-item">
                                <div class="product-thumb">
                                    <a href="#"><img src="{{ asset('products/' . $product->image) }}" alt=""></a>
                                </div>
                                <div class="product-content">
                                    <div class="product-tag"><a href="#">{{ $product->category }}</a></div>
                                    <h4><a href="#">{{ $product->product_name }}</a></h4>
                                    <div class="product-meta">
                                        <div class="product-price">
                                            <h5>Rs. {{ number_format($product->price) }}</h5>
                                            <span class="invnetory-note">{{ $product->inventory ? 'Available: ' . $product->inventory : 'OUT OF
                                            STOCK' }}</span>
                                        </div>
                                        @if($product->inventory)
                                            <div class="product-cart-action">
                                                <a href="{{ route('site.add-cart', $product->id) }}"><i
                                                        class="fas fa-shopping-basket"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- shop-area-end -->

        <!-- blog-area -->
        <section class="blog-area pt-115 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title home-four-title black-title text-center mb-65">
                            <h2>Latest News & <span>Articles</span></h2>
                            <p>Compete with 100 players on a remote island for winner takes showdown known issue where
                                certain skin strategic</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach($blogs as $blog)
                        <div class="col-lg-4 col-md-6 col-sm-9">
                            <div class="blog-post home-four-blog-post mb-50">
                                <div class="blog-thumb mb-30">
                                    <a href="{{ route('site.blog', $blog->id) }}"><img style="height: 200px;"
                                                                                       src="{{ asset('blogs/' . $blog->image) }}"
                                                                                       alt=""></a>
                                </div>
                                <div class="blog-post-content">
                                    <div class="blog-meta">
                                        <ul>
                                            <li>
                                                <i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <h4><a href="{{ route('site.blog', $blog->id) }}">{{ $blog->title }}</a></h4>
                                    <p>{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</p>
                                    <a href="{{ route('site.blog', $blog->id) }}" class="read-more">Read More <i
                                            class="fas fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

    </main>
@endsection
