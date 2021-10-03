@extends('admin.main')

@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        @include('admin.layout.navbar')
        @include('admin.layout.alert')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="text-right">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn bg-gradient-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body ">
                            <h5>Order# <strong>{{ $order->order_no }}</strong>
                                <span class="float-end">${{ $order->total }}</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Order Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <h5>{{ $order->client_name ? $order->client_name : $order->user->name }}</h5>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <h5>{{ $order->email }}</h5>
                                    </div>
                                    <div class="form-group">
                                        <label>Shipping Address</label>
                                        <h5>{{ $order->shipping_address }}</h5>
                                    </div>
                                    <div class="form-group">
                                        <label>Extra</label>
                                        <h5>{{ $order->comment_section }}</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h5>Items</h5>
                                    <div class="items">
                                        <ul style="list-style-type: none" class="">
                                            @foreach($order->items as $item)
                                                <li>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img width="75" height="75" src="{{ asset('products/' . $item->product->image) }}" alt="">
                                                        </div>
                                                        <div class="col-9">
                                                            <h5>{{ $item->product->product_name }}</h5>
                                                            <p class="m-0">QTY: {{ $item->qty }}</p>
                                                            <span>${{ $item->price }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
