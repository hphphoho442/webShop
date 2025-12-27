@extends('layouts.main')
@section('css')
    @vite ('resources/css/shop/style.css')
@endsection
@section('content')
<div class="container my-5">
    <a href="{{ route('shop.index') }}" class="btn btn-secondary"> <- quay lại trang mua sắm</a>
    <div class="row">

        {{-- IMAGE --}}
        <div class="col-md-5">
            <div class="product-detail-thumb">
                @if($primary)
                    <img src="{{ Storage::url($primary->url) }}">
                @else
                    <div class="no-image">No image</div>
                @endif
            </div>
        </div>

        {{-- INFO --}}
        <div class="col-md-7">
            <h3 class="mb-3">{{ $product->name }}</h3>

            <div class="fs-4 fw-bold text-danger mb-3">
                {{ number_format($product->price,0,',','.') }} ₫
            </div>

            <div class="mb-3 text-muted">
                Danh mục:
                <strong>{{ $product->category?->name }}</strong>
            </div>

            <p class="mb-4">
                {{ $product->description ?? 'Chưa có mô tả sản phẩm' }}
            </p>

            {{-- ADD TO CART --}}
            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf

                <div class="row g-2 align-items-center mb-3">
                    <div class="col-auto">
                        <input type="number"
                               name="quantity"
                               value="1"
                               min="1"
                               class="form-control"
                               style="width:100px;">
                    </div>

                    <div class="col">
                        <button class="btn btn-primary px-4 add-to-cart"
                        type="submit"
                        data-url="{{ route('cart.add', $product->id) }}">
                            🛒 Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>
@endsection
