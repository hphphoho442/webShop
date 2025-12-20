@extends('layouts.main')

@section('title', 'Giỏ hàng')
@section('js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/shop/cart/change_quantity_item.js')
@endsection

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
                        <td>
                        <form class="d-flex gap-2"
                            method="POST"
                            action="{{ route('cart.update', $item->id) }}">
                            @csrf
                            <input type="number"
                                name="quantity"
                                data-id="{{ $item->id }}"
                                data-price="{{ $item->product->price }}"
                                value="{{ $item->quantity }}"
                                min="1"
                                class="form-control form-control-sm quantity-input"
                                style="width: 60px; border: none">
                        </form>

                        </td>
                        <td class="item-subtotal" data-id="{{$item->id}}">
                            {{number_format($item->product->price * $item->quantity)}} đ
                        </td>
                        {{-- <td>{{ $item->quantity }}</td> --}}
                        {{-- <td>{{ number_format($subtotal) }} đ</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h4>Tổng tiền: <strong id="cart-total">{{ number_format($total) }} đ</strong></h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                Tiến hành thanh toán →
            </a>
        </div>

    @endif
</div>
@endsection
