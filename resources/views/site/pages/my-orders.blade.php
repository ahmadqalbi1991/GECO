@extends('site.main')

@section('content')
    <main>
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12 pl-45">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-dark table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order #</th>
                                            <th>Subtotal</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($orders))
                                            @php $i = 0; @endphp
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $order->order_no }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>{{ strtoupper($order->order_status) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No Order</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
