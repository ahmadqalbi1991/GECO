@extends('site.main')

@section('content')
    <main>
        @if(!Session::has('message') && !Session::has('status'))
            <section class="contact-area pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="md-stepper-horizontal orange">
                                <div class="md-step active">
                                    <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                    <div class="md-step-title">My Cart</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                </div>
                                <div class="md-step active">
                                    <div class="md-step-circle"><span>2</span></div>
                                    <div class="md-step-title">Checkout</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                </div>
                                <div class="md-step">
                                    <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                                    <div class="md-step-title">Paid</div>
                                    <div class="md-step-bar-left"></div>
                                    <div class="md-step-bar-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="comment_section">Extra</label>
                                                    <textarea name="comment_section" id="comment_section"
                                                              rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        Item in cart
                                    </div>
                                    <div class="card-body">
                                        <div class="cart">
                                            @php $subtotal = 0;
                                             $shipping_charges = site_setting('shipping_charges');  @endphp
                                            @foreach($cart as $item)
                                                @php
                                                    $discount = $item['price'] * ($item['discount'] / 100);
                                                    $item_price = $item['price'] - $discount;
                                                    $subtotal = $subtotal + ($item_price * $item['qty']);
                                                @endphp
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('products/' . $item['image']) }}" alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <h5>{{ $item['name'] }}</h5>
                                                        <p>$ {{ $item['price'] }}</p>
                                                        <p>Quantity:{{ $item['qty'] }}</p>
                                                        <p>Item Total: $ {{ $item['qty'] * $item_price }}</p>
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
                                                               class="float-right">$ {{ $subtotal }}</span>
                                            </h5>
                                            <h5>Delivery Charges <span id="subtotal_text"
                                                                       class="float-right">$ {{ $shipping_charges }}</span>
                                            </h5>
                                            <hr>
                                            <h5>Total <span
                                                    class="float-right" id="cart-total">$ {{ $subtotal + $shipping_charges }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        @endif
    </main>

    <script
        src="https://www.paypal.com/sdk/js?client-id={{ site_setting('paypal_password') }}"> // Required. Replace YOUR_CLIENT_ID with your sandbox
        // client ID.
    </script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $subtotal + $shipping_charges }}'
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
