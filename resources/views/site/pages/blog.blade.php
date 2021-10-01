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
                                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
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
                    <div class="col-lg-8">
                        <div class="blog-list-post blog-details-wrap">
                            <div class="blog-list-post-content">
                                <h2>{{ $blog->title }}</h2>
                                <div class="blog-meta">
                                    <ul>
                                        <li>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}</li>
                                    </ul>
                                </div>
                                <p>{{ $blog->content }}</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="blog-details-img">
                                            <img src="{{ asset('blogs/' . $blog->image) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-img">
                            <img src="{{ asset('blogs/' . $blog->image) }}" alt="" style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

    </main>
@endsection
