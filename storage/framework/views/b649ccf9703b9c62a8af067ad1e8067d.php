<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Chuyên Nghiệp - TechZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #1a1a2e;
            --secondary-color: #16213e;
            --accent-color: #0fccce;
            --text-light: #ecf0f1;
            --text-muted: #bdc3c7;
            --border-color: #2d4059;
        }

        .professional-footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .footer-slogan {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-left: 4px solid var(--accent-color);
            font-weight: 600;
            letter-spacing: 0.5px;
            display: inline-block;
            margin: 0;
            font-size: 1.5rem;
        }

        .footer-section h5 {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-section h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background: var(--accent-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.6rem;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .footer-links a:hover {
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .footer-links a::before {
            content: '▸';
            margin-right: 8px;
            font-size: 0.8rem;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .footer-links a:hover::before {
            opacity: 1;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .social-links a:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(15, 204, 206, 0.4);
        }

        .contact-info {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .contact-info div {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: flex-start;
        }

        .contact-info i {
            margin-right: 10px;
            color: var(--accent-color);
            margin-top: 3px;
        }

        .footer-divider {
            border-top: 1px solid var(--border-color);
            margin: 2rem 0;
        }

        .footer-bottom {
            padding: 1.5rem 0;
            background: rgba(0, 0, 0, 0.2);
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .footer-bottom a {
            color: var(--accent-color);
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        /* Nút đăng nhập/đăng ký */
        .auth-buttons {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--accent-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-register {
            background: var(--accent-color);
            border: 2px solid var(--accent-color);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: transparent;
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .footer-section {
                margin-bottom: 2rem;
            }

            .footer-slogan {
                font-size: 1.2rem;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Hiệu ứng xuất hiện khi scroll */
        .footer-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s, transform 0.5s;
        }

        .footer-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Newsletter */
        .newsletter-form {
            display: flex;
            margin-top: 1rem;
        }

        .newsletter-input {
            flex: 1;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px 0 0 4px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .newsletter-input::placeholder {
            color: var(--text-muted);
        }

        .newsletter-btn {
            background: var(--accent-color);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background: #0db9bb;
        }
    </style>
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
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\partials\footer.blade.php ENDPATH**/ ?>