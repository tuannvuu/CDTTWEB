<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH DEAL - Khuyến mãi đồ công nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 hero-content">
                    <div class="hero-badge">🔥 DEAL SỐC TUẦN NÀY</div>
                    <h1 class="hero-title display-4 fw-bold">KHÁM PHÁ DEAL CÔNG NGHỆ HẤP DẪN</h1>
                    <p class="hero-subtitle">Hàng ngàn ưu đãi đặc biệt dành riêng cho tín đồ công nghệ! Laptop,
                        smartphone, tablet và phụ kiện giảm giá cực sốc.</p>

                    <div class="hero-features">
                        <div class="hero-feature">🖥️ Laptop giảm đến 50%</div>
                        <div class="hero-feature">📱 Điện thoại flagship</div>
                        <div class="hero-feature">⌚ Smartwatch cao cấp</div>
                        <div class="hero-feature">🎮 Gaming gear</div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-white me-2"></i>
                            <span>Bảo hành chính hãng</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-white me-2"></i>
                            <span>Giao hàng toàn quốc</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-white me-2"></i>
                            <span>Trả góp 0%</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-deal-box">
                        <h4 class="hero-deal-title">DEAL ĐẶC BIỆT</h4>
                        <h2 class="hero-deal-amount">GIẢM 1 TRIỆU</h2>
                        <p>MacBook & Laptop cao cấp</p>
                        <div class="hero-deal-code">MACBOOK1M</div>
                        <button class="btn btn-primary copy-btn">Sao chép mã</button>
                        <div class="mt-3">
                            <small class="text-muted">Áp dụng đến hết 30/11/2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 stat-item">
                    <div class="stat-number">1,250+</div>
                    <div class="stat-text">Deal đang hoạt động</div>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <div class="stat-number">45,000+</div>
                    <div class="stat-text">Khách hàng hài lòng</div>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-text">Tỷ lệ phản hồi tích cực</div>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-text">Hỗ trợ khách hàng</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Deals Section -->
    <section class="deals-section mb-5">
        <div class="container">
            <h2 class="text-center section-title">DEAL CÔNG NGHỆ NỔI BẬT</h2>

            <div class="row g-4">
                <!-- Deal 1 - Laptop -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-laptop featured-deal">
                        <span class="deal-badge deal-hot">HOT</span>
                        <div class="deal-header text-center">
                            <div class="product-icon">💻</div>
                            <h4 class="fw-bold">Giảm 2.5 Triệu</h4>
                            <p class="mb-0">Laptop Gaming & Đồ họa</p>
                            <div class="deal-code">GAMING2M5</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Giảm ngay 2.5 triệu cho laptop gaming và đồ họa từ 20 triệu. Áp dụng
                                với RTX 3060 trở lên.</p>
                            <div class="deal-timer">
                                <div class="timer-box">
                                    <div>05</div>
                                    <small>Ngày</small>
                                </div>
                                <div class="timer-box">
                                    <div>18</div>
                                    <small>Giờ</small>
                                </div>
                                <div class="timer-box">
                                    <div>30</div>
                                    <small>Phút</small>
                                </div>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Áp dụng: ASUS ROG, MSI, Acer Predator
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn btn-primary copy-btn w-100">Sao chép mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 2 - Smartphone -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-smartphone">
                        <span class="deal-badge deal-new">MỚI</span>
                        <div class="deal-header text-center">
                            <div class="product-icon">📱</div>
                            <h4 class="fw-bold">Giảm 35%</h4>
                            <p class="mb-0">iPhone & Samsung Flagship</p>
                            <div class="deal-code">PHONE35OFF</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Giảm 35% cho iPhone 14 series và Samsung Galaxy S23 series. Bảo hành
                                chính hãng 12 tháng.</p>
                            <div class="text-center text-muted">
                                <small>Còn 58 sản phẩm</small>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Áp dụng: iPhone 14, 14 Pro, S23, S23 Ultra
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn copy-btn w-100" style="background: #6633cc; color: white;">Sao chép
                                mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 3 - Tablet -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-tablet">
                        <span class="deal-badge deal-limited">GIỚI HẠN</span>
                        <div class="deal-header text-center">
                            <div class="product-icon">📟</div>
                            <h4 class="fw-bold">Trả góp 0%</h4>
                            <p class="mb-0">iPad & Tablet cao cấp</p>
                            <div class="deal-code">TABLET0LAI</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Trả góp 0% lãi suất cho iPad Pro, Galaxy Tab S8. Kèm bàn phím và Apple
                                Pencil tặng kèm.</p>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%"
                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="text-center text-muted">
                                <small>Đã bán 65% lượt</small>
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn copy-btn w-100" style="background: #00cc99; color: white;">Sao chép
                                mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 4 - Accessory -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-accessory">
                        <div class="deal-header text-center">
                            <div class="product-icon">🔌</div>
                            <h4 class="fw-bold">Mua 2 Tặng 1</h4>
                            <p class="mb-0">Phụ kiện chính hãng</p>
                            <div class="deal-code">ACC2TANG1</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Mua 2 phụ kiện bất kỳ tặng 1 cable USB-C hoặc adapter. Sạc nhanh,
                                cable, ốp lưng.</p>
                            <div class="text-center text-muted">
                                <small>Áp dụng cho 35 phụ kiện</small>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Áp dụng: Sạc, cáp, ốp lưng, tai nghe
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn copy-btn w-100" style="background: #ff6600; color: white;">Sao chép
                                mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 5 - Gaming -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-gaming">
                        <span class="deal-badge deal-hot">HOT</span>
                        <div class="deal-header text-center">
                            <div class="product-icon">🎮</div>
                            <h4 class="fw-bold">Giảm 40%</h4>
                            <p class="mb-0">Gear Gaming & Stream</p>
                            <div class="deal-code">GAMING40</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Giảm 40% cho bàn phím cơ, chuột gaming, tai nghe và webcam stream.
                                Tặng voucher 200K.</p>
                            <div class="deal-timer">
                                <div class="timer-box">
                                    <div>07</div>
                                    <small>Ngày</small>
                                </div>
                                <div class="timer-box">
                                    <div>06</div>
                                    <small>Giờ</small>
                                </div>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Áp dụng: Razer, Logitech, Corsair, HyperX
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn copy-btn w-100" style="background: #cc0066; color: white;">Sao chép
                                mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 6 - Audio -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-audio">
                        <div class="deal-header text-center">
                            <div class="product-icon">🎧</div>
                            <h4 class="fw-bold">Freeship + Quà 500K</h4>
                            <p class="mb-0">Tai nghe & Loa cao cấp</p>
                            <div class="deal-code">AUDIO500K</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Mua tai nghe, loa từ 2 triệu được freeship + voucher 500K. Sony, Bose,
                                JBL, Marshall.</p>
                            <div class="text-center text-muted">
                                <small>Chỉ 100 lượt đầu tiên</small>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Áp dụng: Tai nghe chụp tai, loa bluetooth
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn btn-primary copy-btn w-100">Sao chép mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 7 - Smartwatch -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-smartwatch">
                        <span class="deal-badge deal-limited">GIỚI HẠN</span>
                        <div class="deal-header text-center">
                            <div class="product-icon">⌚</div>
                            <h4 class="fw-bold">Giảm 1.2 Triệu</h4>
                            <p class="mb-0">Apple Watch & Samsung Watch</p>
                            <div class="deal-code">WATCH1M2</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Giảm 1.2 triệu cho đồng hồ thông minh Apple Watch Series 8, 9 và
                                Galaxy Watch 5, 6.</p>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 45%"
                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="text-center text-muted">
                                <small>Đã bán 45% lượt</small>
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn copy-btn w-100" style="background: #33cc33; color: white;">Sao chép
                                mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 8 - Camera -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-camera">
                        <div class="deal-header text-center">
                            <div class="product-icon">📸</div>
                            <h4 class="fw-bold">Giảm 25% + Phụ kiện</h4>
                            <p class="mb-0">Máy ảnh & Ống kính</p>
                            <div class="deal-code">CAMERA25</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Giảm 25% máy ảnh mirrorless + tặng kèm ống kit và túi chống sốc.
                                Canon, Sony, Fujifilm.</p>
                            <div class="deal-timer">
                                <div class="timer-box">
                                    <div>04</div>
                                    <small>Ngày</small>
                                </div>
                                <div class="timer-box">
                                    <div>12</div>
                                    <small>Giờ</small>
                                </div>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Áp dụng: Mirrorless, DSLR cơ bản
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn copy-btn w-100" style="background: #ff3333; color: white;">Sao chép
                                mã</button>
                        </div>
                    </div>
                </div>

                <!-- Deal 9 - PC -->
                <div class="col-md-6 col-lg-4">
                    <div class="card deal-card deal-laptop">
                        <span class="deal-badge deal-exclusive">ĐỘC QUYỀN</span>
                        <div class="deal-header text-center">
                            <div class="product-icon">🖥️</div>
                            <h4 class="fw-bold">PC Gaming 15 Triệu</h4>
                            <p class="mb-0">RTX 4060 + Intel i5</p>
                            <div class="deal-code">PC15TR</div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">PC Gaming chỉ 15 triệu với RTX 4060, Intel i5, 16GB RAM. Build theo
                                yêu cầu, bảo hành 3 năm.</p>
                            <div class="text-center text-muted">
                                <small>Chỉ 10 bộ còn lại</small>
                            </div>
                            <div class="deal-conditions">
                                <i class="bi bi-info-circle"></i> Bao gồm: Case, màn hình 24", bàn phím, chuột
                            </div>
                        </div>
                        <div class="deal-footer text-center">
                            <button class="btn btn-primary copy-btn w-100">Sao chép mã</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button class="btn btn-primary btn-lg">
                    Xem thêm deal khác
                </button>
            </div>
        </div>
    </section>

    <!-- Floating Notification -->
    <div class="floating-notification" id="floatingNotification">
        <div class="notification-icon">
            <i class="bi bi-bell-fill"></i>
        </div>
        <div class="notification-content">
            <div class="notification-title">Đừng bỏ lỡ!</div>
            <div class="notification-text">Deal giảm 50% chỉ còn 2 giờ</div>
        </div>
        <button class="notification-close" id="closeNotification">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Copy mã khuyến mãi
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const dealCode = this.closest('.deal-card').querySelector('.deal-code').textContent;
                navigator.clipboard.writeText(dealCode).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Đã sao chép!';
                    this.classList.add('btn-success');

                    setTimeout(() => {
                        this.textContent = originalText;
                        this.classList.remove('btn-success');
                    }, 2000);
                });
            });
        });

        // Filter category
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Floating notification
        const floatingNotification = document.getElementById('floatingNotification');
        const closeNotification = document.getElementById('closeNotification');

        setTimeout(() => {
            floatingNotification.classList.add('show');
        }, 3000);

        closeNotification.addEventListener('click', () => {
            floatingNotification.classList.remove('show');
        });

        // Auto update timers (demo)
        function updateTimers() {
            document.querySelectorAll('.deal-timer').forEach(timer => {
                const daysBox = timer.querySelector('.timer-box:first-child div');
                const hoursBox = timer.querySelector('.timer-box:nth-child(2) div');
                const minutesBox = timer.querySelector('.timer-box:nth-child(3) div');

                if (daysBox && hoursBox && minutesBox) {
                    let days = parseInt(daysBox.textContent);
                    let hours = parseInt(hoursBox.textContent);
                    let minutes = parseInt(minutesBox.textContent);

                    minutes--;
                    if (minutes < 0) {
                        minutes = 59;
                        hours--;
                        if (hours < 0) {
                            hours = 23;
                            days--;
                            if (days < 0) {
                                days = 0;
                                hours = 0;
                                minutes = 0;
                            }
                        }
                    }

                    daysBox.textContent = days.toString().padStart(2, '0');
                    hoursBox.textContent = hours.toString().padStart(2, '0');
                    minutesBox.textContent = minutes.toString().padStart(2, '0');
                }
            });
        }

        setInterval(updateTimers, 60000);
    </script>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\promotions\index.blade.php ENDPATH**/ ?>