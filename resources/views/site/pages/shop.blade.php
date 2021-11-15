@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="shop-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    @if(isset($products) && count($products))
                        @foreach($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="accessories-item text-center mb-80">
                                    <div class="accessories-thumb mb-30">
                                        <a href="{{ route('site.product', $product->id) }}"><img src="{{ asset('products/' . $product->image) }}" alt=""></a>
                                    </div>
                                    <div class="accessories-content">
                                        <h5><a href="{{ route('site.product', $product->id) }}">{{ $product->product_name }}</a></h5>
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
                                        @if($product->inventory)
                                            <span>Available: {{ $product->inventory }}</span>
                                        @endif
                                        @if($product->inventory)
                                            <a href="{{ route('site.add-cart', $product->id) }}" class="shop-add-action">Add to cart</a>
                                        @else
                                            <a href="javascript:void(0);" class="shop-add-action">Out of stock</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 style="color: #0b0b0b">No Products</h5>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                {{ $products->links() }}
            </div>
        </section>
    </main>
@endsection
