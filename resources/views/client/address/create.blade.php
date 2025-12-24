@extends('layouts.main')

@section('title', 'Thêm địa chỉ')

@section('content')
<div class="container mt-4">
    <h2>➕ Thêm địa chỉ giao hàng</h2>

    <form method="POST" action="{{ route('address.store') }}" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên địa chỉ (VD: Nhà riêng, Công ty)</label>
            <input type="text" name="label" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Người nhận</label>
            <input type="text" name="recipient" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ chi tiết</label>
            <input type="text" name="line" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Phường / Xã</label>
                <input type="text" name="ward" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Quận / Huyện</label>
                <input type="text" name="district" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Tỉnh / Thành phố</label>
                <input type="text" name="province" class="form-control" required>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('checkout.home') }}" class="btn btn-secondary">
                Quay lại
            </a>
            <button class="btn btn-primary">
                Lưu địa chỉ
            </button>
        </div>
    </form>
</div>
@endsection
