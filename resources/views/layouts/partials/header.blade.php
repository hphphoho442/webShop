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
                    <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">
                        Sản phẩm
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cart') ? 'active' : '' }}" href="/cart">
                        Giỏ hàng
                    </a>
                </li>

                {{-- Nếu bạn có trang admin, thêm ở đây --}}
                <li class="nav-item">
                    @if(Auth::check())
                        <li class="nav-item">
                            <a href="/profile" class="btn text-white bg-transparent {{ request()->is('login') ? 'active' : '' }}">
                                Xin chào: {{ Auth::user()->name }}
                            </a>
                        </li>
                        @if(Auth::user()->role === "admin")
                            <li class="nav-item">
                                <a href="{{route('admin.Dashboard')}}" class="btn text-white bg-transparent {{ request()->is('login') ? 'active' : '' }}"> 
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
