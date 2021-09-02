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
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order #/th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment
                                            Status
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($orders) && count($orders))
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="text-center">#{{ $order->order_no }}</td>
                                                <td class="text-center">{{ $order->client_name ? $order->client_name : $order->user->name }}</td>
                                                <td class="text-center">${{ $order->total }}</td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($order->date)->format('d M, Y') }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.order-change-status') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                                        <div class="d-flex flex-row justify-content-evenly align-items-start">
                                                            <div class="form-group">
                                                                <select class="form-control" name="order_status" id="order_status"
                                                                        @if($order->payment_status == 'done') disabled @endif>
                                                                    <option @if($order->order_status == 'pending') selected @endif
                                                                    value="pending">Pending
                                                                    </option>
                                                                    <option @if($order->order_status == 'done') selected @endif
                                                                    value="done">Done
                                                                    </option>
                                                                    <option @if($order->order_status == 'delete') selected @endif
                                                                    value="delete">Delete
                                                                    </option>
                                                                    <option @if($order->order_status == 'cancel') selected @endif
                                                                    value="cancel">Cancel
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    @if($order->payment_status == 'done')
                                                        <button class="btn btn-sm btn-success">Done</button>
                                                    @else
                                                        <button class="btn btn-sm btn-warning">Pending</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">No data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
