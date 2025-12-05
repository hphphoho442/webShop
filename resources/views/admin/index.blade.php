@extends('layouts.main')
@section('title', 'trang quan ly')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="">Dashboard</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Products
                    </a>
                    <ul class="dropdown-menu ">
                        <li><a class="dropdown-item" href="{{route('admin.categories.index')}}">Qly danh mục</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.product.index') }}">Qly sản phẩm</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.supplier.index') }}">Qly NCC</a></li>
                    </ul>
                </li>


                <li class="nav-item"><a class="nav-link" href="">Đơn hàng</a></li>
                <li class="nav-item">
                    <a class="nav-link" 
                    href="{{route('admin.Account.index')}}">
                    Người dùng
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('adminContent')
    </div>
@endsection