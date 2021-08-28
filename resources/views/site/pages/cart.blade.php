@extends('site.main')

@section('content')
    <main>
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Shopping Cart
                            </div>
                            <div class="card-body">
                                <div class="cart">
                                    <div class="row cart-item-wrapper">
                                        <div class="col-12">
                                            @php $i = 0; $subtotal = 0; @endphp
                                            @if(count($cart))
                                                <form action="{{ route('site.update-cart') }}" method="post">
                                                    @csrf
                                                    @foreach($cart as $key => $item)
                                                        @php
                                                            $i++;
                                                             $subtotal = $subtotal + ($item['price'] * $item['qty']);
                                                        @endphp
                                                        <div class="row my-2">
                                                            <div
                                                                class="col-2 d-flex align-items-start justify-content-center flex-column flex-wrap">
                                                                <img class="product-thumb"
                                                                     src="{{ asset('products/' . $item['image']) }}"
                                                                     alt="">
                                                            </div>
                                                            <div
                                                                class="col-5 d-flex align-items-start justify-content-center flex-column flex-wrap">
                                                                <h5>{{ $item['name'] }}</h5>
                                                                <p>Rs. {{ $item['price'] }}</p>
                                                                <input type="hidden" id="price{{ $i }}"
                                                                       value="{{ $item['price'] }}">
                                                                <input type="hidden" id="price_total{{ $i }}"
                                                                       class="prices" value="{{ $item['price'] }}">
                                                                <span class="item-total"
                                                                      id="item-total{{ $i }}">Rs. {{ $item['price'] * $item['qty'] }}</span>
                                                            </div>
                                                            <div
                                                                class="col-3 d-flex align-items-start justify-content-center flex-column flex-wrap">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <button class="" onclick="minus({{ $i }})"
                                                                                type="button"><i
                                                                                class="fas fa-minus"></i>
                                                                        </button>
                                                                    </div>
                                                                    <input type="text" id="qty{{ $i }}" name="qty[]"
                                                                           value="{{ $item['qty'] }}"
                                                                           class="text-center form-control"
                                                                           aria-label="Recipient's username"
                                                                           aria-describedby="basic-addon2">
                                                                    <div class="input-group-append">
                                                                        <button class="" onclick="plus({{ $i }})"
                                                                                type="button"><i
                                                                                class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-1 d-flex align-items-start justify-content-center flex-column flex-wrap">
                                                                <a href="{{ route('site.remove-cart-item', $key) }}"
                                                                   class="delete"><i class="fa fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="m-2 text-right">
                                                        <button class="btn btn-primary">Update Cart</button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="m-5 p-5 text-center">No items in cart</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="cart-total">
                                    <h3>Total</h3>
                                    <hr>
                                    <h5>Subtotal <span id="subtotal_text" class="float-right">Rs. {{ $subtotal }}</span>
                                    </h5>
                                    <input type="hidden" id="subtotal" value="{{ $subtotal }}">
                                    <hr>
                                    <h5>Total <span
                                            class="float-right" id="cart-total">Rs. {{ $subtotal }}</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
                            <a href="{{ route('site.checkout') }}" class="btn btn-block btn-primary">CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function minus(i) {
            var qty = parseInt(document.getElementById('qty' + i).value);
            var price = parseInt(document.getElementById('price' + i).value);

            if (qty == 1) {
                alert('Quantity cannot be less than 1');
                return false;
            }

            qty = qty - 1;
            price = price * qty;
            document.getElementById('qty' + i).value = qty;
            document.getElementById('item-total' + i).innerText = 'Rs ' + price;
            document.getElementById('price_total' + i).value = price;
            calculateSubtotal();
        }

        function plus(i) {
            var qty = parseInt(document.getElementById('qty' + i).value);
            var price = parseInt(document.getElementById('price' + i).value);
            qty = qty + 1;
            price = price * qty;
            document.getElementById('qty' + i).value = qty;
            document.getElementById('item-total' + i).innerText = 'Rs. ' + price;
            document.getElementById('price_total' + i).value = price;
            calculateSubtotal();
        }

        function calculateSubtotal() {
            var prices = document.getElementsByClassName('prices');
            var subtotal = 0;
            for (var i = 0; i < prices.length; i++) {
                subtotal = subtotal + parseInt(prices.item(i).value);
            }

            document.getElementById('subtotal_text').innerText = 'Rs. ' + subtotal;
            document.getElementById('cart-total').innerText = 'Rs. ' + (subtotal)
        }
    </script>
@endsection
