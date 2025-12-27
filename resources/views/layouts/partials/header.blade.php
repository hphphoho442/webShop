<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold" href="/">
            ShopWeb
        </a>

        {{-- Nút toggle trên mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">
                        Trang chủ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('shop*') ? 'active' : '' }}" href="{{route('shop.index')}}">
                        Sản phẩm 
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('order') ? 'active' : '' }}" href="/order">
                        Đơn hàng
                    </a>
                </li>

                {{-- Nếu bạn có trang admin, thêm ở đây --}}
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white"
                            href="#"
                            id="userDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                                Xin chào: {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="/profile">
                                        <i class="bi bi-person"></i> Thông tin cá nhân
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/address">
                                        <i class="bi bi-geo-alt"></i> Địa chỉ nhận hàng
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                        @if(Auth::user()->role === "admin")
                            <li class="nav-item">
                                <a href="{{route('admin.index')}}" class="btn text-white bg-transparent {{ request()->is('login') ? 'active' : '' }}"> 
                                    Quản lý
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a id="beeze-login-btn" class="btn text-white bg-transparent {{ request()->is('login') ? 'active' : '' }}" href="{{route('login')}}">
                                Đăng nhập
                            </a>
                            <a id="beeze-register-btn" class="btn text-white bg-transparent {{ request()->is('login') ? 'active' : '' }}" href="{{route('register')}}">
                                Đăng ký
                            </a>
                        </li>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="nav-wrapper position-relative">
    {{-- CART --}}
    @if(Auth::check())
        <a href="/cart" class="cart-under-nav">
            <i class="bi bi-cart"></i>

            <span id="cart-count" class="cart-badge">
                {{ $cartItemCount ?? 0 }}
            </span>
        </a>
    @endif
</div>




