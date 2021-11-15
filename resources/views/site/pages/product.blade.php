@extends('site.main')

@section('content')
    <main>
        <section class="shop-area pt-120 pb-90">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-5">
                                    <img width="500" height="500" src="{{ asset('products/' . $product->image) }}"
                                         alt="">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex flex-column justify-content-center">
                                <h5 class="text-dark">{{ $product->product_name }} ({{ $product->sku_code }}) </h5>
                                <p>{{ $product->description }}</p>
                                <p>{{ ucwords($product->category) }}</p>
                                <div class="my-4">
                                    <h2>
                                        @if($product->discount)
                                            @php
                                            $discount = ($product->price * $product->discount) / 100;
                                                $price = $product->price - $discount;
                                                @endphp
                                            <del class="text-danger">${{ $product->price }}</del>
                                            <span class="text-primary">${{ $price }}</span>
                                        @else
                                            <span class="text-primary">${{ $product->price }}</span>
                                        @endif
                                    </h2>
                                </div>
                                <div class="my-5">
                                    <a href="{{ route('site.add-cart', $product->id) }}" class="btn btn-block">Add to
                                        cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
