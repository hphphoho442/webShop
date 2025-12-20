@extends('layouts.main')
@section('css')
    @vite('resources\css\home\style.css')
@endsection
@section('content')
    <div class="hero text-center">
    <!-- LOGO -->
    <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" height="80" class="mb-3">
    <h2>ĐẠI HỌC HẢI PHÒNG</h2>
    <h4>KHOA CÔNG NGHỆ THÔNG TIN</h4>
    <p class="mt-3">Môn học: <strong>Quản trị dự án phần mềm</strong></p>
</div>

<div class="container my-5">

    <!-- THÔNG TIN ĐỀ TÀI -->
    <div class="mb-5">
        <h4 class="section-title">Thông tin đề tài</h4>
        <p><strong>Tên đề tài:</strong> Phát triển website bán hàng bằng framework Laravel</p>
        <p>
            Website được xây dựng nhằm mô phỏng một hệ thống bán hàng trực tuyến, 
            hỗ trợ các chức năng cơ bản như quản lý sản phẩm, giỏ hàng, đơn hàng và người dùng.
        </p>
    </div>

    <!-- THÔNG TIN SINH VIÊN -->
    <div class="mb-5">
        <h4 class="section-title">Thông tin sinh viên</h4>
        <ul>
            <li><strong>Người thực hiện:</strong> Trần Đức Mạnh</li>
            <li><strong>Mã sinh viên:</strong> 213148201185</li>
            <li><strong>Giảng viên hướng dẫn:</strong> Th.s Đào Thị Hường</li>
        </ul>
    </div>

    <!-- QUÁ TRÌNH THỰC HIỆN -->
    <div class="mb-5">
        <h4 class="section-title">Quá trình phát triển website</h4>
        <p>
            Quá trình thực hiện dự án được chia thành nhiều giai đoạn nhằm đảm bảo 
            tiến độ và chất lượng sản phẩm:
        </p>
        <ol>
            <li>Phân tích yêu cầu và xác định chức năng hệ thống</li>
            <li>Thiết kế cơ sở dữ liệu và giao diện người dùng</li>
            <li>Triển khai hệ thống bằng framework Laravel</li>
            <li>Kiểm thử, sửa lỗi và hoàn thiện chức năng</li>
            <li>Đánh giá kết quả và viết báo cáo</li>
        </ol>

        <!-- ẢNH MINH HỌA -->
    </div>

    <!-- CÔNG NGHỆ -->
    <div class="mb-5">
        <h4 class="section-title">Công nghệ sử dụng</h4>
        <ul>
            <li>Ngôn ngữ: PHP</li>
            <li>Framework: Laravel</li>
            <li>Cơ sở dữ liệu: MySQL</li>
            <li>Frontend: HTML, CSS, Bootstrap</li>
        </ul>
    </div>

</div>
@endsection