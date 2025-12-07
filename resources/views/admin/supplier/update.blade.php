@extends('admin.index')
@section('adminContent')
    <form action="{{ route('admin.supplier.updatePUT', $data->id) }}" 
    method="POST" 
    class="card p-4">
    @csrf
    @method('PUT')

    <h3 class="mb-4">Sửa NCC</h3>
    {{-- ContactName --}}
    <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input
            type="text"
            id="contact"
            name="contact"
            class="form-control @error('contact') is-invalid @enderror"
            value=""
            placeholder="{{ $data->contact_name }}"
        >
        @error('contact')
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
            value=""
            placeholder="{{ $data->name }}"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Phone --}}
    <div class="mb-3">
        <label for="phone" class="form-label">SĐT</label>
        <input
            type="text"
            id="phone"
            name="phone"
            class="form-control @error('phone') is-invalid @enderror"
            value=""
            placeholder="{{ $data->phone }}"
        >
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Email --}}
    </div>
        <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value=""
            placeholder="{{ $data->email }}"
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    {{-- Address --}}
    <div class="mb-3">
        <label for="address" class="form-label">Địa chỉ</label>
        <input
            type="text"
            id="address"
            name="address"
            class="form-control @error('address') is-invalid @enderror"
            value=""
            placeholder="{{ $data->address }}"
        >
        @error('Address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            Hủy
        </a>
        <button type="submit" class="btn btn-primary">
            Lưu NCC
        </button>
    </div>
</form>

@endsection
    