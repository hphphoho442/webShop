@extends('layouts.main')

@section('title', 'Trang quản lý')

@section('content')

    {{-- ADMIN NAVBAR – FULL WIDTH --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom w-100">
        <div class="container-fluid px-3">

            <a class="navbar-brand fw-bold d-lg-none" href="#">
                Admin
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#adminNavbar"
                    aria-controls="adminNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    {{-- PRODUCTS --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('admin/categories*','admin/products*','admin/suppliers*') ? 'active' : '' }}"
                           href="#"
                           data-bs-toggle="dropdown">
                            Products
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                    Quản lý danh mục
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.product.index') }}">
                                    Quản lý sản phẩm
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.supplier.index') }}">
                                    Quản lý NCC
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}"
                           href="{{ route('admin.order.index') }}">
                            Đơn hàng
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.Account.*') ? 'active' : '' }}"
                           href="{{ route('admin.Account.index') }}">
                            Người dùng
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    {{-- ADMIN CONTENT --}}
    <main class="container mt-4">
        @yield('adminContent')
    </main>

@endsection
