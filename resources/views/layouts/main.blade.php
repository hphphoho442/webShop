<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <title>@yield('title', 'ShopWeb')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @vite('resources/js/shop/cart/notification_add_item.js')
    @vite('resources/css/shop/notification_add_to_cart.css')
    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
    @yield('css')
</head>
<body>
    <div id="top-notification"></div>

    {{-- Header --}}
    @include('layouts.partials.header')

    {{-- Nội dung trang --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

</body>
</html>
