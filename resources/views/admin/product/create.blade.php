@extends('admin.index')
@section('js')
     @vite('resources/js/admin/a.js')
@endsection
@section('css')
     @vite('resources/css/admin/a.css')
@endsection
@section('adminContent')
    <form action="{{ route('admin.categories.CreatePOST') }}" 
    method="POST" 
    class="card p-4">
    @csrf
    {{-- Name --}}
    <div class="mb-3" style="position:relative;">
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