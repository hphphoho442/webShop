@extends('admin.index')
@section('js')
     @vite('resources/js/admin/seachSupplier.js')
     @vite('resources/js/admin/seachCategory.js')
@endsection
@section('css')
     @vite('resources/css/admin/a.css')
@endsection
@section('adminContent')
    <form action="{{ route('admin.product.CreatePOST') }}" 
    method="POST" 
    enctype="multipart/form-data"
    class="card p-4">
    @csrf
    {{-- Images --}}
    <div class="mb-3">
        <label for="images">Ảnh sản phẩm</label>
        <input type="file" id="images" name="images[]" multiple accept="image/*" class="form-control" />
        @error('images') <div class="text-danger">{{ $message }}</div> @enderror
        @error('images.*') <div class="text-danger">{{ $message }}</div> @enderror
  </div>
    {{-- barcode --}}
    <div class="mb-3">
        <label for="barcode" class="form-label">Mã vạch</label>
        <input
            type="text"
            id="barcode"
            name="barcode"
            class="form-control @error('barcode') is-invalid @enderror"
            value="{{ old('barcode') }}"
            placeholder="Barcode"
        >
        @error('barcode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Name --}}
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}"
            placeholder="Tên sản phẩm"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    {{-- Cost price --}}
    <div class="mb-3">
        <label for="price" class="form-label">Giá sản phẩm</label>
        <input
            type="text"
            id="price"
            name="price"
            class="form-control @error('price') is-invalid @enderror"
            value="{{ old('price') }}"
            placeholder="Giá sản phẩm"
        >
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>



    {{-- Supplier --}}
    <div id="d_supplier" class="mb-3" style="position:relative;">
    <label for="supplier" class="form-label">Nhà cung cấp</label>

    <input
        type="text"
        id="supplier"
        name="supplier_text"
        class="form-control"
        value="{{ old('supplier_text') }}"
        placeholder="Nhập tên / SDT / email NCC"
        autocomplete="off"
        aria-autocomplete="list"
        aria-controls="supplier_results"
        aria-expanded="false"
    >

    <input type="hidden" id="supplier_id" name="supplier_id" value="{{ old('supplier_id') }}">

    <div id="supplier_results" role="listbox" aria-label="Gợi ý nhà cung cấp" style="display:none;"></div>
    </div>
    {{-- kiểu loại --}}
    <div id="d_category" class="mb-3" style="position:relative;">
    <label for="category" class="form-label">Nhà cung cấp</label>

    <input
        type="text"
        id="category"
        name="category_text"
        class="form-control"
        value="{{ old('category_text') }}"
        placeholder="Nhập tên / id kiểu loại"
        autocomplete="off"
        aria-autocomplete="list"
        aria-controls="category_results"
        aria-expanded="false"
    >
    <input type="hidden" id="category_id" name="category_id" value="{{ old('category_id') }}">


    <div id="category_results" role="listbox" aria-label="Gợi ý kiểu loại" style="display:none;"></div>
    </div>


    {{-- Slug --}}
    <div class="mb-3">
        <label for="slug" class="form-label">Đường dẫn</label>
        <input
            type="text"
            id="slug"
            name="slug"
            class="form-control @error('slug') is-invalid @enderror"
            value="{{ old('slug') }}"
            placeholder="Nhập miêu tả..."
        >
        @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    {{-- miêu tả --}}
    <div class="mb-3">
        <label for="description" class="form-label">miêu tả</label>
        <input
            type="text"
            id="description"
            name="description"
            class="form-control @error('description') is-invalid @enderror"
            value="{{ old('description') }}"
            placeholder="Nhập miêu tả..."
        >
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
            Hủy
        </a>
        <button type="submit" class="btn btn-primary">
            Lưu thể loại
        </button>
    </div>
</form>

@endsection