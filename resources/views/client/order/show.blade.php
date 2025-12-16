@extends('layouts.main')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container mt-4">
    <h3>🧾 Đơn hàng #{{ $order->id }}</h3>

    <p>
        Trạng thái: <strong>{{ ucfirst($order->status) }}</strong><br>
        Thanh toán: <strong>{{ $order->status }}</strong>
    </p>

    <hr>

    <h5>📍 Địa chỉ giao hàng</h5>
    <p>
        {{ $order->shippingAddress->recipient }}<br>
        {{ $order->shippingAddress->phone }}<br>
        {{ $order->shippingAddress->line }},
        {{ $order->shippingAddress->ward }},
        {{ $order->shippingAddress->district }},
        {{ $order->shippingAddress->province }}
    </p>

    <hr>

    <h5>🛒 Sản phẩm</h5>
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>SL</th>
                <th>Giá</th>
                <th>Tạm tính</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price) }} đ</td>
                <td>{{ number_format($item->subtotal) }} đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4>Tổng tiền:
            <strong>{{ number_format($order->total_amount) }} đ</strong>
        </h4>
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">
        Quay lại danh sách
    </a>
</div>
@endsection
