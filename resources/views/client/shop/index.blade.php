@extends('layouts.main')
@section('css')
    @vite ('resources/css/shop/style.css')
@endsection
@section('content')
<div class="container my-4">
    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-3">

            {{-- SEARCH --}}
            <form method="GET" action="{{ route('shop.index') }}" class="mb-4">
                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       class="form-control"
                       placeholder="🔍 Tìm sản phẩm...">
            </form>
            {{-- FILTER PRICE --}}
            <form method="GET" action="{{ route('shop.index') }}" class="mb-4">

                {{-- giữ lại filter cũ --}}
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">

                <div class="mb-2 fw-bold">Khoảng giá</div>

                <div class="row g-2">
                    <div class="col-6">
                        <input type="number"
                            name="price_min"
                            value="{{ request('price_min') }}"
                            class="form-control"
                            placeholder="Từ">
                    </div>

                    <div class="col-6">
                        <input type="number"
                            name="price_max"
                            value="{{ request('price_max') }}"
                            class="form-control"
                            placeholder="Đến">
                    </div>
                </div>

                <button class="btn btn-sm btn-primary w-100 mt-2">
                    Lọc
                </button>
            </form>


            {{-- CATEGORY --}}
            <div class="card">
                <div class="card-header fw-bold">
                    Danh mục
                </div>

                <div class="card-body p-2">
                    <ul class="list-unstyled mb-0">

                        {{-- ALL --}}
                        <li>
                            <a href="{{ route('shop.index') }}"
                               class="nav-link {{ request('category') ? '' : 'fw-bold' }}">
                                Tất cả
                            </a>
                        </li>

                        @foreach($categories as $parent)
                            <li class="mt-2">
                                <a href="{{ route('shop.index', ['category' => $parent->id]) }}"
                                   class="nav-link {{ request('category') == $parent->id ? 'fw-bold text-primary' : '' }}">
                                    {{ $parent->name }}
                                </a>
                            </li>

                            {{-- CATEGORY CON --}}
                            @foreach($parent->children as $child)
                                <li style="margin-left: 18px;">
                                    <a href="{{ route('shop.index', ['category' => $child->id]) }}"
                                       class="nav-link {{ request('category') == $child->id ? 'fw-bold text-primary' : 'text-muted' }}">
                                        -{{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        {{-- PRODUCTS --}}
<div class="col-md-9">
    <div class="row g-4">

        @forelse($products as $product)
            @php
                $primary = $product->images->where('is_primary',1)->first()
                         ?? $product->images->first();
            @endphp

            <div class="col-md-4 col-sm-6">
                <a href="{{ route('shop.show', $product->id) }}"
                {{-- <a href="#" --}}
                   class="text-decoration-none text-dark">

                    <div class="card h-100 shadow-sm product-card">

                        {{-- IMAGE --}}
                        <div class="product-thumb">
                            @if($primary)
                                <img src="{{ Storage::url($primary->url) }}">
                            @else
                                <div class="no-image">none</div>
                            @endif
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">
                            <h6 class="mb-1">{{ $product->name }}</h6>

                            <div class="fw-bold text-danger">
                                {{ number_format($product->price,0,',','.') }} ₫
                            </div>
                        </div>

                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Không có sản phẩm
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

    </div>
</div>
@endsection
