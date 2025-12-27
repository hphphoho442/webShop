<footer class="footer mt-5">
    <div class="container py-4">
        <div class="row gy-4">

            {{-- THÔNG TIN SHOP --}}
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">HỖ TRỢ KHÁCH HÀNG</h6>

                <p class="mb-1">
                    <i class="bi bi-telephone"></i>
                    Hotline:
                    <a href="tel:0123456789" class="footer-link">
                        0834283955
                    </a>
                </p>

                <p class="mb-1">
                    <i class="bi bi-envelope"></i>
                    Email:
                    <a href="mailto:support@shopweb.com" class="footer-link">
                        support@shopweb.com
                    </a>
                </p>

                <p class="mb-0">
                    <i class="bi bi-facebook"></i>
                    Facebook:
                    <a href="https://facebook.com/shopweb" target="_blank" class="footer-link">
                        fb.com/shopweb
                    </a>
                </p>
            </div>

            {{-- LIÊN KẾT HỖ TRỢ --}}
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">THÔNG TIN</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Giới thiệu</a></li>
                    <li><a href="#" class="footer-link">Chính sách bảo mật</a></li>
                    <li><a href="#" class="footer-link">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="footer-link">Hướng dẫn mua hàng</a></li>
                </ul>
            </div>

            {{-- CAM KẾT / HỖ TRỢ --}}
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">CAM KẾT</h6>
                <ul class="list-unstyled mb-0">
                    <li>✔ Sản phẩm chính hãng</li>
                    <li>✔ Thanh toán an toàn</li>
                </ul>
            </div>

        </div>
    </div>

    {{-- COPYRIGHT --}}
    <div class="footer-bottom text-center py-2">
        © {{ date('Y') }} ShopWeb. All rights reserved.
    </div>
</footer>
