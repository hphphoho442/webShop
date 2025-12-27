@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header fw-bold">
                Thông tin cá nhân
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" 
                action="{{ route('profile.update') }} " 
                autocomplete="off">
                    @csrf

                    {{-- Email (readonly) --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>

                    {{-- Name --}}
                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', Auth::user()->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', Auth::user()->phone) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="fw-bold">Đổi mật khẩu (không bắt buộc)</h6>

                    <div class="mb-3">
                        <input type="password" name="new_password" class="form-control" placeholder="Mật khẩu mới" autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>

                    <button class="btn btn-primary">
                        Lưu thay đổi
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
