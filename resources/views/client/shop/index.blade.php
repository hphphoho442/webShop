@extends('layouts.main')

@section('css')
@vite('resources/css/shop/style.css')
@vite('resources/js/shop/shop/protect_button.js')
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
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">

                <div class="mb-2 fw-bold">Khoảng giá</div>

                <div class="row g-2">
                    <div class="col-6">
                        <input type="number" name="price_min"
                               value="{{ request('price_min') }}"
                               class="form-control" placeholder="Từ">
                    </div>
                    <div class="col-6">
                        <input type="number" name="price_max"
                               value="{{ request('price_max') }}"
                               class="form-control" placeholder="Đến">
                    </div>
                </div>

                <button class="btn btn-sm btn-primary w-100 mt-2">Lọc</button>
            </form>
            {{-- CATEGORY MOBILE --}}
            @php
                $currentCategory = $categories
                    ->pluck('children')
                    ->flatten()
                    ->merge($categories)
                    ->firstWhere('id', request('category'));

                $activeParent = $currentCategory?->parent_id
                    ? $categories->firstWhere('id', $currentCategory->parent_id)
                    : $currentCategory;
            @endphp


            <div class="d-md-none mb-2">

                {{-- PARENT CATEGORY --}}
                <div class="d-md-none mb-2">
                    <div class="category-scroll">

                        <a href="{{ route('shop.index') }}"
                        class="category-pill {{ request('category') ? '' : 'active' }}">
                            Tất cả
                        </a>

                        @foreach($categories as $parent)
                        <a href="{{ route('shop.index', [
                            'parent' => $parent->id,
                            'category' => $parent->id
                        ]) }}"
                        class="category-pill {{ request('parent') == $parent->id ? 'active' : '' }}">
                            {{ $parent->name }}
                        </a>
                        @endforeach

                    </div>
                </div>

                @if(request('parent'))
                @php
                    $activeParent = $categories->firstWhere('id', request('parent'));
                @endphp

                <div class="category-scroll category-child-scroll">
                @foreach($activeParent->children as $child)
                    <a href="{{ route('shop.index', [
                        'parent' => request('parent'),
                        'category' => $child->id
                    ]) }}"
                    class="category-pill category-pill-child
                    {{ request('category') == $child->id ? 'active' : '' }}">
                        {{ $child->name }}
                    </a>
                @endforeach
                </div>
                @endif
            </div>



            {{-- CATEGORY --}}
            @php
                $currentCategory = $categories
                    ->pluck('children')
                    ->flatten()
                    ->merge($categories)
                    ->firstWhere('id', request('category'));

                $activeParent = $currentCategory?->parent_id
                    ? $categories->firstWhere('id', $currentCategory->parent_id)
                    : $currentCategory;
            @endphp

            <div class="card d-none d-md-block">
                <div class="card-header fw-bold">Danh mục</div>
                <div class="card-body p-2">
                    <ul class="list-unstyled mb-0">

                        {{-- ALL --}}
                        <li>
                            <a href="{{ route('shop.index') }}"
                            class="nav-link {{ request('category') ? '' : 'fw-bold text-primary' }}">
                                Tất cả
                            </a>
                        </li>

                        @foreach($categories as $parent)
                            {{-- PARENT --}}
                            <li class="mt-2">
                                <a href="{{ route('shop.index', [
                                    'category' => $parent->id
                                ]) }}"
                                class="nav-link fw-semibold
                                {{ optional($activeParent)->id == $parent->id ? 'text-primary' : '' }}">
                                    {{ $parent->name }}
                                </a>
                            </li>

                            {{-- CHILD (CHỈ HIỆN KHI CHA ACTIVE) --}}
                            @if(optional($activeParent)->id === $parent->id)
                                @foreach($parent->children as $child)
                                    <li class="ms-3">
                                        <a href="{{ route('shop.index', [
                                            'category' => $child->id
                                        ]) }}"
                                        class="nav-link small
                                        {{ request('category') == $child->id
                                            ? 'fw-bold text-success'
                                            : 'text-muted' }}">
                                            ▸ {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        {{-- PRODUCTS --}}
        <div class="col-md-9">
            <div class="row g-2">

                @forelse($products as $product)
                @php
                    $primary = $product->images->where('is_primary',1)->first()
                             ?? $product->images->first();
                @endphp

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm product-card"
                         data-id="{{ $product->id }}"
                         data-url="{{ route('shop.show',$product->id) }}">

                        <div class="product-thumb">
                            @if($primary)
                                <img src="{{ Storage::url($primary->url) }}">
                            @else
                                <div class="text-center py-5 text-muted">No image</div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h6 class="mb-1">{{ $product->name }}</h6>
                            <div class="fw-bold text-danger">
                                {{ number_format($product->price,0,',','.') }} ₫
                            </div>
                        </div>

                        {{-- OVERLAY --}}
                        <div class="product-overlay">
                            <button class="btn btn-light btn-sm view-detail">
                                👁 Xem chi tiết
                            </button>
                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                                <button class="btn btn-primary btn-sm add-to-cart"
                                type="submit"
                                data-url="{{ route('cart.add', $product->id) }}">
                                    🛒 Thêm giỏ
                                </button>
                            </form>
                        </div>
                    </div>
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
