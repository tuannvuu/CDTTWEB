<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Chuyên Nghiệp - TechZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>
    <!-- Footer -->
    <footer class="professional-footer">
        <div class="py-5">
            <div class="container">
                <!-- Slogan -->
                <div class="text-center mb-5">
                    <p class="footer-slogan px-4 py-3 rounded">
                        Công nghệ mới - Giá trị thật
                    </p>
                </div>

                <!-- Các phần thông tin -->
                <div class="row gy-4">
                    <!-- Hỗ trợ khách hàng -->
                    <div class="col-12 col-md-3 footer-section">
                        <h5>Hỗ trợ khách hàng</h5>
                        <ul class="footer-links">
                            <li><a href="#">Trung tâm trợ giúp</a></li>
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Chính sách bảo hành</a></li>
                            <li><a href="#">Chính sách đổi trả</a></li>
                            <li><a href="#">Vận chuyển & Giao nhận</a></li>
                            <li><a href="#">Thanh toán an toàn</a></li>
                        </ul>
                    </div>

                    <!-- Danh mục sản phẩm -->
                    <div class="col-12 col-md-3 footer-section">
                        <h5>Danh mục sản phẩm</h5>
                        <ul class="footer-links">
                            <li><a href="#">Điện thoại & Phụ kiện</a></li>
                            <li><a href="#">Laptop & Máy tính</a></li>
                            <li><a href="#">Thiết bị gia dụng</a></li>
                            <li><a href="#">Thiết bị âm thanh</a></li>
                            <li><a href="#">Camera & An ninh</a></li>
                            <li><a href="#">Phụ kiện công nghệ</a></li>
                        </ul>
                    </div>

                    <!-- Về TechZone -->
                    <div class="col-12 col-md-3 footer-section">
                        <h5>Về TechZone</h5>
                        <ul class="footer-links">
                            <li><a href="#">Giới thiệu</a></li>
                            <li><a href="#">Tin tức công nghệ</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                            <li><a href="#">Hệ thống cửa hàng</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Đánh giá từ khách hàng</a></li>
                        </ul>
                    </div>

                    <!-- Liên kết -->
                    <div class="col-12 col-md-3 footer-section">
                        <h5>Kết nối với chúng tôi</h5>
                        <div class="social-links mb-3">
                            <a href="#" title="Facebook"><i class="bi bi-facebook fs-5"></i></a>
                            <a href="#" title="YouTube"><i class="bi bi-youtube fs-5"></i></a>
                            <a href="#" title="Instagram"><i class="bi bi-instagram fs-5"></i></a>
                            <a href="#" title="Twitter"><i class="bi bi-twitter fs-5"></i></a>
                            <a href="#" title="Zalo"><i class="bi bi-chat-dots fs-5"></i></a>
                        </div>
                        <div class="contact-info">
                            <div>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Email: support@techzone.vn</span>
                            </div>
                            <div>
                                <i class="bi bi-telephone-fill"></i>
                                <span>Hotline: 1900 1234 (Miễn phí)</span>
                            </div>
                            <div>
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Tòa nhà TechHub, 123 Đường Công Nghệ, Quận 1, TP.HCM</span>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="mt-4">
                            <h6>Đăng ký nhận tin khuyến mãi</h6>
                            <form class="newsletter-form">
                                <input type="email" class="newsletter-input" placeholder="Email của bạn" required>
                                <button type="submit" class="newsletter-btn">
                                    <i class="bi bi-send"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Đường phân cách -->
                <div class="footer-divider"></div>

                <!-- Bottom footer -->
                <div class="footer-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-start">
                            © 2023 TechZone. Tất cả các quyền được bảo lưu.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <a href="#">Điều khoản sử dụng</a> |
                            <a href="#">Chính sách bảo mật</a> |
                            <a href="#">Sơ đồ trang web</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hiệu ứng xuất hiện khi scroll đến footer
        document.addEventListener('DOMContentLoaded', function() {
            const footerSections = document.querySelectorAll('.footer-section');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            footerSections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>

</html>
