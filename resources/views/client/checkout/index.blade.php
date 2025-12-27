@extends('layouts.main')

@section('title', 'Thanh toán')

@section('content')
<div class="container mt-4">
    <h2>💳 Thanh toán</h2>

    <table class="table mt-3 align-middle">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>SL</th>
                <th>Giá</th>
                <th>Tạm tính</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price) }} đ</td>
                    <td>
                        {{ number_format($item->product->price * $item->quantity) }} đ
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4>Tổng thanh toán: <strong>{{ number_format($subtotal) }} đ</strong></h4>
    </div>

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        {{-- ĐỊA CHỈ GIAO HÀNG --}}
        <h4 class="mt-4">📍 Địa chỉ giao hàng</h4>

        @if($addresses->isEmpty())
            <div class="alert alert-warning">
                Bạn chưa có địa chỉ giao hàng.
                <a href="{{ route('address.index') }}">Thêm địa chỉ mới</a>
            </div>
        @else
            @foreach($addresses as $address)
                <div class="form-check border rounded p-3 mb-2">
                    <input class="form-check-input"
                        type="radio"
                        name="shipping_address_id"
                        value="{{ $address->id }}"
                        required>

                    <label class="form-check-label w-100">
                        <strong>{{ $address->label }}</strong><br>
                        {{ $address->recipient }} – {{ $address->phone }}<br>
                        {{ $address->line }},
                        {{ $address->ward }},
                        {{ $address->district }},
                        {{ $address->province }}
                    </label>
                </div>
            @endforeach
        @endif

        {{-- PHƯƠNG THỨC THANH TOÁN --}}
        <h4 class="mt-4">💳 Phương thức thanh toán</h4>

        @foreach($paymentMethods as $key => $label)
            <div class="form-check border rounded p-3 mb-2">
                <input class="form-check-input"
                    type="radio"
                    name="payment_method"
                    value="{{ $key }}"
                    required>

                <label class="form-check-label">
                    {{ $label }}
                </label>
            </div>
        @endforeach

        {{-- TỔNG TIỀN --}}
        <div class="text-end mt-4">
            <h4>Tổng thanh toán:
                <strong>{{ number_format($subtotal) }} đ</strong>
            </h4>
        </div>

        {{-- SUBMIT --}}
        <div class="text-end mt-3">
            <button class="btn btn-primary btn-lg">
                Xác nhận đặt hàng
            </button>
        </div>

    </form>

</div>
@endsection
