@extends('site.main')

@section('content')
    <main>
        <section class="regiration-sucess pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="registration-success">
                            <h2>Thank you for shopping.</h2>
                            <h4>Your order has been placed against order number #{{ $order_number }}, You will receive
                                your item(s) in 24 hours.</h4>
                            <div class="form-group">
                                <a href="{{ route('site.download-shop-invoice', $order_id) }}" class="btn btn-success">Download Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
