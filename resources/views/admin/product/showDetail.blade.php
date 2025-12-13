@extends('admin.index')
@section('css')
     @vite('resources/css/admin/a.css')
@endsection
@section('adminContent')
<div class="container mt-4">

    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm mb-3">← Quay lại danh sách</a>

    <div class="card">
        <div class="card-header">
            <h4>Thông tin sản phẩm: {{ $product->name }}</h4>
        </div>

        <div class="card-body">

            {{-- Hình ảnh --}}
            <div class="mb-4">
                <h5>Hình ảnh</h5>

                @php
                    $primary = $product->images->where('is_primary', 1)->first() 
                             ?? $product->images->first();
                @endphp

                @if($primary)
                    <img src="{{ Storage::url($primary->url) }}" 
                         alt="{{ $product->name }}" 
                         class="showImage img-fluid mb-2">
                @else
                    <div class="showImageFail">
                        <span class="text-muted">Không có ảnh</span>
                    </div>
                @endif

                <div class="d-flex gap-2 mt-2 flex-wrap">
                    @foreach($product->images as $img)
                        <img src="{{ Storage::url($img->url) }}"
                             style="width:70px; height:70px; object-fit:cover; border:1px solid #ccc;">
                    @endforeach
                </div>
            </div>

            <hr>

            {{-- Thông tin cơ bản --}}
            <h5>Thông tin cơ bản</h5>
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <td>{{ $product->id }}</td>
                </tr>

                <tr>
                    <th>Tên</th>
                    <td>{{ $product->name }}</td>
                </tr>

                <tr>
                    <th>Danh mục</th>
                    <td>{{ $product->category->name ?? '—' }}</td>
                </tr>

                <tr>
                    <th>Nhà cung cấp</th>
                    <td>{{ $product->supplier->name ?? '—' }}</td>
                </tr>

                <tr>
                    <th>SKU</th>
                    <td>{{ $product->sku ?? '—' }}</td>
                </tr>

                <tr>
                    <th>Giá</th>
                    <td>{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                </tr>

                <tr>
                    <th>Giá vốn</th>
                    <td>{{ $product->cost_price ? number_format($product->cost_price, 0, ',', '.') . ' ₫' : '—' }}</td>
                </tr>

                <tr>
                    <th>Số lượng tồn</th>
                    <td>{{ $product->stock_quantity }}</td>
                </tr>

                <tr>
                    <th>Trạng thái</th>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Ngày tạo</th>
                    <td>{{ $product->created_at }}</td>
                </tr>

                <tr>
                    <th>Ngày cập nhật</th>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            </table>

            <hr>

            {{-- Mô tả --}}
            <h5>Mô tả</h5>
            <div class="p-3 border rounded" style="background:#fafafa;">
                {!! $product->description ?? '<span class="text-muted">Không có mô tả</span>' !!}
            </div>

        </div>
    </div>
</div>
@endsection
