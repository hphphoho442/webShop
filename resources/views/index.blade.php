@extends('layouts.main')

@section('title', 'Trang chủ')

@section('content')

{{-- HERO SECTION --}}
<section class="bg-dark text-white py-5">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">Chào mừng đến với ShipDem</h1>
        <p class="lead mb-4">
            Nền tảng mua sắm trực tuyến hiện đại – nhanh chóng – an toàn
        </p>

        <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg me-2">
            🛍️ Mua sắm ngay
        </a>

        @guest
        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
            Đăng ký
        </a>
        @endguest
    </div>
</section>

{{-- GIỚI THIỆU --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Về ShopWeb</h2>
                <p>
                    ShopWeb là website bán hàng trực tuyến được xây dựng nhằm cung cấp
                    trải nghiệm mua sắm tiện lợi cho người dùng. Hệ thống cho phép
                    khách hàng tìm kiếm, đặt mua và quản lý đơn hàng một cách dễ dàng.
                </p>
                <p>
                    Website được phát triển bằng <strong>Laravel</strong> và
                    <strong>Bootstrap</strong>, đảm bảo hiệu năng và khả năng mở rộng.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <i class="bi bi-cart-check display-1 text-primary"></i>
            </div>
        </div>
    </div>
</section>

{{-- TÍNH NĂNG --}}
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Chức năng nổi bật</h2>

        <div class="row gy-4">
            <div class="col-md-4 text-center">
                <i class="bi bi-search display-6 text-primary"></i>
                <h5 class="mt-3">Tìm kiếm sản phẩm</h5>
                <p>Tìm kiếm và lọc sản phẩm theo danh mục và giá.</p>
            </div>

            <div class="col-md-4 text-center">
                <i class="bi bi-cart-plus display-6 text-primary"></i>
                <h5 class="mt-3">Giỏ hàng & Thanh toán</h5>
                <p>Quản lý giỏ hàng, cập nhật số lượng và thanh toán nhanh.</p>
            </div>

            <div class="col-md-4 text-center">
                <i class="bi bi-box-seam display-6 text-primary"></i>
                <h5 class="mt-3">Quản lý đơn hàng</h5>
                <p>Theo dõi trạng thái đơn hàng và lịch sử mua sắm.</p>
            </div>
        </div>
    </div>
</section>


@endsection
