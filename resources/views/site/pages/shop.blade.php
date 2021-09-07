@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="shop-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="accessories-item text-center mb-80">
                                <div class="accessories-thumb mb-30">
                                    <a href="#"><img src="{{ asset('products/' . $product->image) }}" alt=""></a>
                                </div>
                                <div class="accessories-content">
                                    <h5><a href="#">{{ $product->product_name }}</a></h5>
                                    <span>Price: ${{ number_format($product->price) }}</span>
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
                </div>
                {{ $products->links() }}
            </div>
        </section>
    </main>
@endsection
