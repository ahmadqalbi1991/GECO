<!doctype html>
<html lang="en">
<head>
    <style>
        @import url('/public/fonts/josefin.tff');

        body {
            font-family: 'Josefin Sans', sans-serif;
        }

        .invoice_header {
            background: #1a1a1a;
            color: #e0e0e0;
            border-top: 10px solid #e9a401;
        }

        .p-10-20 {
            padding: 10px 20px;
        }

        table {
            width: 100%;
        }

        .header-invoice-detail {
            text-align: right;
        }

        .header-invoice-detail h2 {
            margin: 0;
            margin-bottom: .9rem;
            font-size: 24px;
        }

        .header-invoice-detail p {
            margin: 0;
            margin-bottom: .2rem;
            font-size: 14px;
        }

        .header-logo {
            width: 150px;
        }

        .header-logo img {
            width: 100%;
        }

        .invoice-details {
            padding: 10px 20px;
            text-align: left;
        }

        .invoice-details table td {
            width: 50%;
            vertical-align: top;
        }

        .contact-details h5 {
            margin: 0;
            text-transform: uppercase;
            font-size: 16px;
        }

        .contact-details p {
            margin: 0;
            font-size: 14px;
        }

        .contact-details p span {
            color: #606060;
        }

        .light-grey-border {
            margin: 20px 0;
            height: 2px;
            background: #e0e0e0;
            width: 250px;
        }

        .contact-details {
            line-height: 1.5;
        }

        .items-table {
            margin-top: 50px;
            font-size: 14px;
            text-align: center;
        }

        .items-table > table > tbody > tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .items-table th, .items-table td {
            border: 1px solid #e0e0e0;
            padding: 8px;
        }

        .items-table th {
            background: #e9a401;
            color: #fff;
            text-transform: uppercase;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .total-wrapper h4, .total-wrapper h3 {
            margin: 2.5px 0;
            text-transform: uppercase;
        }

        .total-wrapper span {
            float: right;
            font-weight: normal;
        }

    </style>
</head>
<body>
<div class="invoice_header p-10-20">
    <table>
        <tr>
            <td>
                <div class="header-logo">
                    <img src="{{ asset('site/img/logo/logo.png') }}" alt="">
                </div>
            </td>
            <td>
                <div class="header-invoice-detail">
                    <h2>Invoice</h2>
                    <p>Invoice: #{{ $order->order_no }}</p>
                    <p>{{ \Carbon\Carbon::parse($order->order_time)->format('d M, Y') }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="invoice-details p-10-20">
    <table>
        <tr>
            <td>
                <div class="contact-details">
                    <h5>Company Details</h5>
                    <div class="light-grey-border"></div>
                    <p>Address: <span>Your Address</span></p>
                    <p>Contact Number: <span>03004477112</span></p>
                    <p>Email: <span>test@gmail.com</span></p>
                </div>
            </td>
            <td>
                <div class="contact-details">
                    <h5>Customer Details</h5>
                    <div class="light-grey-border"></div>
                    <p>Name: <span>{{ $order->user->name }}</span></p>
                    <p>Contact Number: <span>{{ $order->user->contact_number }}</span></p>
                    <p>Email: <span>{{ $order->user->email }}</span></p>
                    <p>Address: <span>{{ $order->shipping_address }}</span></p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="items-table p-10-20">
    <table>
        <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php
            $subtotal = 0;
        @endphp
        @foreach($order->items as $item)
            <tr>
                <td class="text-center">{{ $item->product->product_name . ' (' . $item->product->category . ')' }}</td>
                <td class="text-right">{{ $item->qty }}</td>
                <td class="text-right">${{ number_format($item->price) }}</td>
                @php $product_subtotal = $item->price * $item->qty; @endphp
                <td class="text-right">${{ number_format($product_subtotal) }}</td>
                @php $subtotal = $subtotal + $product_subtotal; @endphp
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="totals p-10-20">
    <table>
        <tr>
            <td style="width: 50%">

            </td>
            <td>
                <div class="total-wrapper">
                    <h4>Subtotal <span>${{ number_format($subtotal) }}</span></h4>
                    <div class="light-grey-border" style="width: 100%"></div>
                    <h3>Total <span>${{ number_format($subtotal) }}</span></h3>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
