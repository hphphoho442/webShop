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
                        <div class="card h-100 shadow-sm">

                            {{-- <div style="height:180px;background:#f2f2f2;
                                display:flex;align-items:center;justify-content:center;"> --}}
                                <div class="product-thumb">
                                @if($primary)
                                    <img src="{{ Storage::url($primary->url) }}"
                                         style=";">
                                @else
                                    <span class="text-muted">none</span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h6>{{ $product->name }}</h6>

                                <div class="fw-bold text-danger mb-2">
                                    {{ number_format($product->price,0,',','.') }} ₫
                                </div>

                                {{-- <a href="{{ route('shop.show', $product->id) }}" --}}
                                <a href="#"
                                   class="btn btn-outline-primary btn-sm mt-auto">
                                    Xem chi tiết
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-muted text-center">
                        Không tìm thấy sản phẩm
                    </div>
                @endforelse

            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
