@extends('admin.index')
@section('js', '<script src="resources\js\admin\a.js"></script>')
@section('adminContent')
    <form action="{{ route('admin.categories.CreatePOST') }}" 
    method="POST" 
    class="card p-4">
    @csrf

    {{-- <h3 class="mb-4">Thêm tài thể loại</h3> --}}

    {{-- perentID --}}
    <div style="position:relative; max-width:600px;">
    <input id="supplier-search" name="supplier_name" autocomplete="off" placeholder="Nhập tên / phone / email nhà cung cấp">
    <input type="hidden" id="supplier_id" name="supplier_id">
    <div id="supplier-suggestions" class="suggestions" style="position:absolute; left:0; right:0; z-index:1000; background:#fff; border:1px solid #ddd; display:none;"></div>
    </div>


    {{-- Name --}}
    <div class="mb-3">
        <label for="name" class="form-label">Tên thể loại</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}"
            placeholder="tên thể loại"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
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
        <a href="{{ route('admin.Account.index') }}" class="btn btn-secondary">
            Hủy
        </a>
        <button type="submit" class="btn btn-primary">
            Lưu thể loại
        </button>
    </div>
</form>

@endsection