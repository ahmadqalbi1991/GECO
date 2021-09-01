@extends('site.main')

@section('content')
    <main>
        @if(!Session::has('message') && !Session::has('status'))
            <section class="contact-area pt-120 pb-120">
                <div class="container">
                    <form action="{{ route('site.update-shipment') }}" id="shipment_form" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order_id }}">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        Shipping
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="client_name">Name</label>
                                                    <input type="text" name="client_name" id="client_name"
                                                           value="{{ Auth::user()->name }}"
                                                           class="form-control @error('name') is-invalid @enderror">
                                                    @error('name')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" id="email"
                                                           value="{{ Auth::user()->email }}"
                                                           readonly
                                                           class="form-control @error('email') is-invalid @enderror">
                                                    @error('email')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="shipping_address">Shipping Address</label>
                                                    <textarea name="shipping_address" id="shipping_address"
                                                              rows="3"
                                                              class="form-control @error('shipping_address') is-invalid @enderror"></textarea>
                                                    @error('shipping_address')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email">Contact Number</label>
                                                    <input type="text" name="contact_number" id="contact_number"
                                                           value="{{ Auth::user()->contact_number }}"
                                                           class="form-control @error('contact_number') is-invalid @enderror">
                                                    @error('contact_number')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
{{--                                                    <label>Payment Method</label><br>--}}
{{--                                                    <label for="cod">--}}
{{--                                                        <input type="radio" name="payment_method" id="cod" value="cod">--}}
{{--                                                        Cash on delivery--}}
{{--                                                    </label>--}}
                                                    <div id="paypal-button-container"></div>

                                                    @error('payment_method')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-right">
                                    <button type="submit" class="btn btn-success">Pay</button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        Item in cart
                                    </div>
                                    <div class="card-body">
                                        <div class="cart">
                                            @php $subtotal = 0;  @endphp
                                            @foreach($cart as $item)
                                                @php $subtotal = $subtotal + ($item['qty'] * $item['price']);  @endphp
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('products/' . $item['image']) }}" alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <h5>{{ $item['name'] }}</h5>
                                                        <p>Rs. {{ $item['price'] }}</p>
                                                        <p>Quantity:{{ $item['qty'] }}</p>
                                                        <p>Item Total: {{ $item['qty'] * $item['price'] }}</p>
                                                    </div>
                                                </div>
                                                @if(count($cart) > 1)
                                                    <hr>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        Summary
                                    </div>
                                    <div class="card-body">
                                        <div class="cart-total">
                                            <h3>Total</h3>
                                            <hr>
                                            <h5>Subtotal <span id="subtotal_text"
                                                               class="float-right">Rs. {{ $subtotal }}</span>
                                            </h5>
                                            <h5>Delivery Charges <span id="subtotal_text"
                                                                       class="float-right">Free</span>
                                            </h5>
                                            <hr>
                                            <h5>Total <span
                                                    class="float-right" id="cart-total">Rs. {{ $subtotal }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        @else
            <section class="regiration-sucess pt-120 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="registration-success">
                                <h2>Thank you for shopping.</h2>
                                <h4>Your order has been placed against order number {{ $order_number }}, You will receive your item(s) in 24 hours.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    <script
        src="https://www.paypal.com/sdk/js?client-id={{ site_setting('paypal_secret') }}"> // Required. Replace YOUR_CLIENT_ID with your sandbox
        // client ID.
    </script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $subtotal }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    if(details.status == 'COMPLETED') {
                        $("#shipment_form").append('<input type="hidden" name="payment_status" value="done" >');
                        $("#shipment_form").append('<input type="hidden" name="payment_method" value="paypal" >');
                        $("#shipment_form").submit();
                    }
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
