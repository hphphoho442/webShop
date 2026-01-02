@extends('layouts.main')

@section('title', 'Giỏ hàng')

@section('js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite('resources/js/shop/cart/change_quantity_item.js')
@endsection

@section('content')
<div class="container mt-4" style="max-width: 900px">

    <h3 class="fw-bold mb-4">🛒 Giỏ hàng của bạn</h3>

    @if(!$cart || $cart->items->isEmpty())
        <div class="alert alert-info">
            Giỏ hàng của bạn đang trống
        </div>
    @else

        @php $total = 0; @endphp

        <div class="d-flex flex-column gap-3">

            @foreach($cart->items as $item)
                @php
                    $product = $item->product;
                    $subtotal = $product->price * $item->quantity;
                    $total += $subtotal;
                @endphp

                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex gap-3 position-relative">

                        {{-- IMAGE --}}
                        <div style="width: 90px">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->url) }}"
                                     class="img-fluid rounded"
                                     style="width: 90px; height: 90px; object-fit: cover">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                     style="width: 90px; height: 90px">
                                    <span class="text-muted small">No image</span>
                                </div>
                            @endif
                        </div>

                        {{-- INFO --}}
                        <div class="flex-grow-1">

                            <div class="fw-semibold mb-1">
                                <a class="nav-link" href="{{ route('shop.show', $product) }}">{{ $product->name }}</a>
                            </div>

                            <div class="text-muted small">
                                Giá: <strong>{{ number_format($product->price) }} đ</strong>
                            </div>

                            <div class="mt-1 small">
                                Tạm tính:
                                <strong class="item-subtotal"
                                        data-id="{{ $item->id }}">
                                    {{ number_format($subtotal) }} đ
                                </strong>
                            </div>
                        </div>

                        {{-- QUANTITY --}}
                        <div class="d-flex flex-column align-items-end gap-2">

                            <form method="POST"
                                  action="{{ route('cart.update', $item->id) }}">
                                @csrf
                                <input type="number"
                                       name="quantity"
                                       data-id="{{ $item->id }}"
                                       data-price="{{ $product->price }}"
                                       value="{{ $item->quantity }}"
                                       min="1"
                                       class="form-control form-control-sm quantity-input text-center"
                                       style="width: 70px">
                            </form>

                            {{-- REMOVE --}}
                            <form action="{{ route('cart.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Bạn muốn xóa sản phẩm?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    ❌
                                </button>
                            </form>

                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        {{-- TOTAL --}}
        <div class="d-flex justify-content-end mt-4">
            <div class="text-end">
                <div class="text-muted">Tổng tiền</div>
                <h4 class="fw-bold text-danger" id="cart-total">
                    {{ number_format($total) }} đ
                </h4>
            </div>
        </div>

        {{-- ACTION --}}
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('checkout.home') }}"
               class="btn btn-success btn-lg px-4">
                Thanh toán →
            </a>
        </div>

    @endif
</div>
@endsection
