@extends('admin.index')

@section('content')
<div class="container my-4">

    <h2 class="mb-4">🛒 Shop sản phẩm</h2>

    <div class="row g-4">
        @forelse($products as $product)

            @php
                $primary = $product->images->where('is_primary', 1)->first()
                         ?? $product->images->first();
            @endphp

            <div class="col-md-3 col-sm-6">
                <div class="card h-100 shadow-sm">

                    {{-- Image --}}
                    <div style="height:200px; background:#f2f2f2;
                        display:flex; align-items:center; justify-content:center;">
                        @if($primary)
                            <img src="{{ Storage::url($primary->path) }}"
                                 alt="{{ $product->name }}"
                                 style="max-width:100%; max-height:100%; object-fit:contain;">
                        @else
                            <span class="text-muted">none</span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>

                        <div class="mb-2 fw-bold text-danger">
                            {{ number_format($product->price, 0, ',', '.') }} ₫
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
            <div class="col-12 text-center text-muted">
                Không có sản phẩm nào
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{-- {{ $products->links() }} --}}
    </div>

</div>
@endsection
