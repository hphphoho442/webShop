@extends('admin.index')
@section('adminContent')
    <form action="{{ route('admin.Account.UpdatePUT', $data->id) }}" method="POST" class="card p-4">
    @csrf
    @method('PUT')
    <h3 class="mb-4">Cập nhật tài khoản người dùng</h3>
    {{-- id --}}
    <div class="mb-3">
        <label for="id" class="form-label"></label>
        <p
        name="id">
        {{$data->id}}
        </p>
    </div>
    {{-- Username --}}
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            class="form-control @error('username') is-invalid @enderror"
            value="{{ $data->username}}"
            placeholder="Nhập username..."
        >
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{$data->email}}"
            placeholder="name@example.com"
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Phone --}}
    <div class="mb-3">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input
            type="text"
            id="phone"
            name="phone"
            class="form-control @error('phone') is-invalid @enderror"
            value="{{$data->phone}}"
            placeholder="Nhập số điện thoại..."
        >
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Nhập mật khẩu..."
        >
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Role --}}
    <div class="mb-3">
        <label for="role" class="form-label">Quyền</label>
        <select
            id="role"
            name="role"
            class="form-select @error('role') is-invalid @enderror"
        >
            <option value="">{{$data->role}}</option>
            <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
            <option value="staff"  {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
            <option value="admin"  {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.Account.index') }}" class="btn btn-secondary">
            Hủy
        </a>
        <button type="submit" class="btn btn-primary">
            Lưu tài khoản
        </button>
    </div>
</form>
@endsection