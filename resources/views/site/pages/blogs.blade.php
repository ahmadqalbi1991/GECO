@extends('site.main')

@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg third-breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Blog <span>Details</span></h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('site.home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- blog-area -->
        <section class="blog-area primary-bg pt-120 pb-175">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach($blogs as $blog)
                            <div class="blog-list-post">
                                <div class="blog-list-post-thumb">
                                    <a href="{{ route('site.blog', $blog->id) }}"><img width="350px" height="350px" src="{{ asset('blogs/' . $blog->image) }}" alt=""></a>
                                </div>
                                <div class="blog-list-post-content">
                                    <h2><a href="{{ route('site.blog', $blog->id) }}">{{ $blog->title }}</a></h2>
                                    <div class="blog-meta">
                                        <ul>
                                            <li>bY <a href="#">{{ $blog->user->name }}</a> {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}</li>
                                        </ul>
                                    </div>
                                    <p>{{ \Illuminate\Support\Str::limit($blog->content, 500) }}</p>
                                </div>
                                <div class="blog-list-post-bottom">
                                    <ul>
                                        <li><a href="{{ route('site.blog', $blog->id) }}">more reding<i class="fas fa-angle-double-right"></i></a></li>
                                        <li>
                                            <span>SHARE :</span>
                                            <div class="blog-post-share">
                                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                                <a href="https://twitter.com/home?lang=en"><i class="fab fa-twitter"></i></a>
                                                <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

    </main>
@endsection
