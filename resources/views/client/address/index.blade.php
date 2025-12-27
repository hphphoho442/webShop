@extends('layouts.main')

@section('content')
<h4 class="mb-3">Địa chỉ nhận hàng</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- LIST --}}
@forelse($addresses as $address)
<div class="card mb-3">
    <div class="card-body d-flex justify-content-between">
        <div>
            <strong>{{ $address->recipient }}</strong> | {{ $address->phone }}
            @if($address->label)
                <span class="badge bg-secondary ms-2">{{ $address->label }}</span>
            @endif

            <p class="mb-1">
                {{ $address->line }},
                {{ $address->ward }},
                {{ $address->district }},
                {{ $address->province }},
                {{ $address->country }}
            </p>
        </div>

        <form method="POST" action="{{ route('address.delete', $address->id) }}">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Xoá</button>
        </form>
    </div>
</div>
@empty
<p>Chưa có địa chỉ nào.</p>
@endforelse

<hr>

{{-- ADD --}}
<h5>Thêm địa chỉ mới</h5>

<form method="POST" action="{{ route('address.store') }}">
    @csrf

    <div class="row mb-2">
        <div class="col-md-6">
            <input class="form-control" name="recipient" placeholder="Tên người nhận" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="phone" placeholder="Số điện thoại" required>
        </div>
    </div>

    <input class="form-control mb-2" name="label" placeholder="Nhãn (Nhà riêng, Công ty...)">
    <input class="form-control mb-2" name="line" placeholder="Số nhà, tên đường" required>
    <input class="form-control mb-2" name="ward" placeholder="Phường / Xã" required>
    <input class="form-control mb-2" name="district" placeholder="Quận / Huyện" required>
    <input class="form-control mb-2" name="province" placeholder="Tỉnh / Thành phố" required>
    <input class="form-control mb-3" name="country" value="Việt Nam" required>

    <button class="btn btn-primary">Thêm địa chỉ</button>
</form>
@endsection
