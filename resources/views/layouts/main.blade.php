<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <title>@yield('title', 'ShopWeb')</title>
</head>
<body>

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
