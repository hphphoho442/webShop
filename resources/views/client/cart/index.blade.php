@extends('layouts.main')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container mt-4">
    <h2>🛒 Giỏ hàng của bạn</h2>

    @if(!$cart || $cart->items->isEmpty())
        <div class="alert alert-info mt-3">
            Giỏ hàng của bạn đang trống
        </div>
    @else
        <table class="table align-middle mt-3">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tạm tính</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp

                @foreach($cart->items as $item)
                    @php
                        $product = $item->product;
                        $subtotal = $product->price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td width="90">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->url) }}"
                                     class="img-thumbnail" width="70">
                            @else
                                <span class="text-muted">none</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }} đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($subtotal) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h4>Tổng tiền: <strong>{{ number_format($total) }} đ</strong></h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                Tiến hành thanh toán →
            </a>
        </div>

    @endif
</div>
@endsection
