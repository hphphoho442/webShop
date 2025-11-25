@extends('layouts.main')
@section('title', 'trang quan ly')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="">Đơn hàng</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('admin.Account')}}">Người dùng</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('adminContent')
    </div>
@endsection