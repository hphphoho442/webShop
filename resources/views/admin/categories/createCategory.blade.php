@extends('admin.index')
@section('adminContent')
    <form action="{{ route('admin.categories.CreatePOST') }}" 
    method="POST" 
    class="card p-4">
    @csrf

    <h3 class="mb-4">Thêm tài thể loại</h3>

    {{-- perentID --}}
    <div class="mb-3">
        <label for="parentID" class="form-label">Thể loại cha</label>
        @php
        function renderOptions($categories, $parentId = null, $prefix = '') {
            $children = $categories->where('parent_id', $parentId);
            foreach($children as $category) {
                echo "<option value='{$category->id}'>{$prefix}{$category->name}</option>";
                // chỉ gọi đệ quy nếu có con
                if ($categories->where('parent_id', $category->id)->count() > 0) {
                    renderOptions($categories, $category->id, $prefix . '- ');
                }
            }
        }
        @endphp


        <select name="parent_id" class="form-select mb-3">
            <option value="">-- Không có cha --</option>
            @php renderOptions($categories); @endphp
        </select>


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