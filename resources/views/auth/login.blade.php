@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card shadow-sm mt-5">
                <div class="card-body p-4">

                    <h4 class="text-center fw-bold mb-4">
                        Đăng nhập
                    </h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- REMEMBER --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember">
                            <label class="form-check-label">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        {{-- BUTTON --}}
                        <button class="btn btn-primary w-100 fw-bold">
                            Đăng nhập
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}">
                            Chưa có tài khoản? Đăng ký
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
