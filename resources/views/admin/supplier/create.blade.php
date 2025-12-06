@extends('admin.index')
@section('adminContent')
    <form action="{{ route('admin.supplier.createPOST') }}" 
    method="POST" 
    class="card p-4">
    @csrf

    <h3 class="mb-4">Thêm nhà cung cấp</h3>

    {{-- contactName --}}
    <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input
            type="text"
            id="contact"
            name="contact"
            class="form-control @error('contact') is-invalid @enderror"
            value="{{ old('contact') }}"
            placeholder="contact"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    {{-- Name --}}
    <div class="mb-3">
        <label for="name" class="form-label">Tên NCC</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}"
            placeholder="Tên NCC"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Number --}}
    <div class="mb-3">
        <label for="phone" class="form-label">SĐT</label>
        <input
            type="text"
            id="phone"
            name="phone"
            class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone') }}"
            placeholder="SĐT"
        >
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
            type="text"
            id="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}"
            placeholder="Email"
        >
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- address --}}
    <div class="mb-3">
        <label for="address" class="form-label">Địa chỉ</label>
        <input
            type="text"
            id="address"
            name="address"
            class="form-control @error('address') is-invalid @enderror"
            value="{{ old('address') }}"
            placeholder="Địa chỉ"
        >
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">
            Hủy
        </a>
        <button type="submit" class="btn btn-primary">
            Lưu NCC
        </button>
    </div>
</form>
@endsection