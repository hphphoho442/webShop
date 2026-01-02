@extends('admin.index')

@section('js')
    @vite('resources/js/admin/Product/toggle_Active.js')
@endsection

@section('adminContent')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 fw-bold">
            🛒 Danh sách sản phẩm
        </h4>

        <a class="btn btn-sm btn-primary"
           href="{{ route('admin.product.create') }}">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
        </a>
    </div>

    {{-- Search + Filter --}}
<form class="row g-2 mb-20" method="GET">

    {{-- Keyword --}}
    <div class="col-md-3">
        <input type="text"
               name="keyword"
               value="{{ request('keyword') }}"
               class="form-control form-control-sm"
               placeholder="🔍 Tên hoặc mã">
    </div>

    {{-- Category --}}
    <div class="col-md-3">
        <select name="category_id" class="form-select form-select-sm">
            <option value="">-- Danh mục --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Supplier --}}
    <div class="col-md-3">
        <select name="supplier_id" class="form-select form-select-sm">
            <option value="">-- Nhà cung cấp --</option>
            @foreach($suppliers as $sup)
                <option value="{{ $sup->id }}"
                    {{ request('supplier_id') == $sup->id ? 'selected' : '' }}>
                    {{ $sup->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Status --}}
    <div class="col-md-2">
        <select name="is_active" class="form-select form-select-sm">
            <option value="">-- Trạng thái --</option>
            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>
                Đang bán
            </option>
            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>
                Ngừng bán
            </option>
        </select>
    </div>

    {{-- Submit --}}
    <div class="col-md-1">
        <button class="btn btn-sm btn-outline-secondary w-100">
            Lọc
        </button>
    </div>

</form>



    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 15%">Mã</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-end" style="width: 15%">Giá</th>
                        <th class="text-center" style="width: 12%">Tồn kho</th>
                        <th class="text-center" style="width: 10%">Kích hoạt</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $dataload)
                        <tr>
                            <td class="text-muted">
                                {{ $dataload->barcode ?? '—' }}
                            </td>

                            <td>
                                <a class="fw-semibold text-decoration-none"
                                   href="{{ route('admin.product.LoadImage', $dataload->id) }}">
                                    {{ $dataload->name }}
                                </a>
                            </td>

                            <td class="text-end fw-semibold">
                                {{ number_format($dataload->price, 0, ',', '.') }} ₫
                            </td>

                            <td class="text-center">
                                @if($dataload->stock_quantity > 0)
                                    <span class="badge bg-success">
                                        {{ $dataload->stock_quantity }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Hết hàng
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="form-check form-switch d-inline-flex align-items-center">
                                    <input
                                        class="form-check-input toggle-active"
                                        type="checkbox"
                                        data-id="{{ $dataload->id }}"
                                        {{ $dataload->is_active ? 'checked' : '' }}
                                    >
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Không có sản phẩm nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-end">
        {{ $data->links() }}
    </div>

</div>
@endsection
