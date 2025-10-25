<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ TechShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --secondary: #64748b;
            --accent: #f59e0b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #3b82f6, #8b5cf6);
            --gradient-dark: linear-gradient(135deg, #2563eb, #7c3aed);
            --shadow-sm: 0 2px 12px rgba(99, 102, 241, 0.08);
            --shadow-md: 0 8px 30px rgba(99, 102, 241, 0.12);
            --shadow-lg: 0 20px 50px rgba(99, 102, 241, 0.15);
            --radius: 20px;
            --radius-sm: 12px;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 50%, #e0e7ff 100%);
            min-height: 100vh;
            color: var(--dark);
            line-height: 1.6;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
        }

        .hero-section {
            background: var(--gradient);
            color: white;
            padding: 3rem 0;
            border-radius: 0 0 var(--radius) var(--radius);
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><path d="M0,0 L1000,0 L1000,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .contact-info-card {
            padding: 2rem;
            height: 100%;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon:hover {
            background: var(--gradient);
            color: white;
            transform: translateY(-3px);
        }

        .map-container {
            height: 400px;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        #mainMap {
            height: 100%;
            width: 100%;
            border-radius: var(--radius);
        }

        .office-card {
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
        }

        .office-card:hover {
            transform: translateY(-5px);
        }

        .office-badge {
            background: var(--gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .section-title {
            position: relative;
            margin-bottom: 2rem;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .working-hours {
            background: rgba(59, 130, 246, 0.05);
            padding: 1.5rem;
            border-radius: var(--radius-sm);
            margin-top: 1rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-tech {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-tech:hover {
            background: var(--gradient-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-outline-tech {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.75rem 2rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-outline-tech:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }

            .map-container {
                height: 300px;
                margin-top: 2rem;
            }

            .office-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .action-buttons .btn {
                width: 100%;
                max-width: 300px;
            }
        }

        /* Leaflet Map Customization */
        .leaflet-popup-content-wrapper {
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-lg);
        }

        .leaflet-popup-content {
            margin: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .map-popup-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .map-popup-address {
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .map-popup-phone {
            color: var(--success);
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="display-5 fw-bold mb-3">Liên hệ TechShop</h1>
                <p class="lead mb-0 opacity-90">Kết nối với chúng tôi - Đối tác công nghệ đáng tin cậy của bạn</p>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <!-- Main Contact Section -->
        <div class="row mb-5">
            <!-- Contact Information -->
            <div class="col-lg-6 mb-4">
                <div class="glass-card contact-info-card">
                    <h3 class="text-gradient mb-4">Thông tin liên hệ</h3>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="info-content">
                            <h6 class="fw-bold mb-1">Địa chỉ</h6>
                            <p class="mb-0 text-secondary">Tòa nhà TechHub, 123 Đường Công Nghệ, Quận 1, TP.HCM</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="info-content">
                            <h6 class="fw-bold mb-1">Điện thoại</h6>
                            <p class="mb-0 text-secondary">(+84) 28 1234 5678</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h6 class="fw-bold mb-1">Email</h6>
                            <a href="mailto:contact@techshop.vn"
                                class="text-primary text-decoration-none">contact@techshop.vn</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div class="info-content">
                            <h6 class="fw-bold mb-1">Website</h6>
                            <a href="https://techshop.vn" target="_blank"
                                class="text-primary text-decoration-none">https://techshop.vn</a>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="working-hours mt-4">
                        <h6 class="fw-bold mb-3">🕒 Giờ làm việc</h6>
                        <div class="row">
                            <div class="col-6">
                                <small><strong>Thứ 2 - Thứ 6:</strong></small><br>
                                <small class="text-secondary">8:00 - 18:00</small>
                            </div>
                            <div class="col-6">
                                <small><strong>Thứ 7:</strong></small><br>
                                <small class="text-secondary">8:00 - 12:00</small>
                            </div>
                            <div class="col-12 mt-2">
                                <small><strong>Chủ nhật:</strong></small><br>
                                <small class="text-secondary">Nghỉ</small>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-4">
                        <h6 class="fw-bold mb-3">📱 Mạng xã hội</h6>
                        <div class="social-icons">
                            <a href="#" class="social-icon">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-youtube"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Map -->
            <div class="col-lg-6">
                <div class="glass-card p-4 h-100">
                    <h3 class="text-gradient mb-4">📍 Vị trí của chúng tôi</h3>
                    <div class="map-container">
                        <div id="mainMap"></div>
                    </div>
                    <div class="mt-3">
                        <p class="text-secondary mb-2"><i class="bi bi-info-circle me-2"></i>Nhấp vào các marker trên
                            bản đồ để xem thông tin chi nhánh</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offices Section -->
        <h2 class="section-title text-gradient">🏢 Văn phòng chi nhánh</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="glass-card office-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="fw-bold mb-0">Trụ sở chính</h5>
                        <span class="office-badge">Chính</span>
                    </div>
                    <p class="text-secondary mb-2"><i class="bi bi-geo-alt me-2"></i>Tòa nhà TechHub, 123 Đường Công
                        Nghệ, Quận 1, TP.HCM</p>
                    <p class="text-secondary mb-2"><i class="bi bi-telephone me-2"></i>(+84) 28 1234 5678</p>
                    <p class="text-success mb-0"><i class="bi bi-clock me-2"></i>8:00 - 18:00 (T2-T6)</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="glass-card office-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="fw-bold mb-0">Chi nhánh Hà Nội</h5>
                        <span class="office-badge" style="background: var(--success);">Chi nhánh</span>
                    </div>
                    <p class="text-secondary mb-2"><i class="bi bi-geo-alt me-2"></i>Tòa nhà Innovation, 456 Đường
                        Sáng Tạo, Quận Cầu Giấy, Hà Nội</p>
                    <p class="text-secondary mb-2"><i class="bi bi-telephone me-2"></i>(+84) 24 9876 5432</p>
                    <p class="text-success mb-0"><i class="bi bi-clock me-2"></i>8:00 - 18:00 (T2-T6)</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="glass-card office-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="fw-bold mb-0">Chi nhánh Đà Nẵng</h5>
                        <span class="office-badge" style="background: var(--warning);">Chi nhánh</span>
                    </div>
                    <p class="text-secondary mb-2"><i class="bi bi-geo-alt me-2"></i>Tòa nhà Digital, 789 Đường Số
                        Hóa, Quận Hải Châu, Đà Nẵng</p>
                    <p class="text-secondary mb-2"><i class="bi bi-telephone me-2"></i>(+84) 236 1122 3344</p>
                    <p class="text-success mb-0"><i class="bi bi-clock me-2"></i>8:00 - 17:30 (T2-T6)</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="text-center mt-5">
            <div class="glass-card p-5">
                <h3 class="text-gradient mb-3">Khám phá thêm về TechShop</h3>
                <p class="text-secondary mb-4">Trải nghiệm dịch vụ và sản phẩm công nghệ hàng đầu của chúng tôi</p>
                <div class="action-buttons">
                    <a href="<?php echo e(route('homepage')); ?>" class="btn-tech">
                        <i class="bi bi-house"></i>Trang chủ
                    </a>
                    <a href="/" class="btn-tech">
                        <i class="bi bi-cart"></i>Mua sắm ngay
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('mainMap').setView([10.7769, 106.7009], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Office locations data
        const offices = [{
                name: "Trụ sở chính",
                lat: 10.7769,
                lng: 106.7009,
                address: "Tòa nhà TechHub, 123 Đường Công Nghệ, Quận 1, TP.HCM",
                phone: "(+84) 28 1234 5678",
                type: "main"
            },
            {
                name: "Chi nhánh Hà Nội",
                lat: 21.0278,
                lng: 105.8342,
                address: "Tòa nhà Innovation, 456 Đường Sáng Tạo, Quận Cầu Giấy, Hà Nội",
                phone: "(+84) 24 9876 5432",
                type: "branch"
            },
            {
                name: "Chi nhánh Đà Nẵng",
                lat: 16.0544,
                lng: 108.2022,
                address: "Tòa nhà Digital, 789 Đường Số Hóa, Quận Hải Châu, Đà Nẵng",
                phone: "(+84) 236 1122 3344",
                type: "branch"
            }
        ];

        // Custom icons
        const mainIcon = L.divIcon({
            html: '<i class="bi bi-building" style="color: #3b82f6; font-size: 24px;"></i>',
            className: 'custom-div-icon',
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });

        const branchIcon = L.divIcon({
            html: '<i class="bi bi-shop" style="color: #10b981; font-size: 20px;"></i>',
            className: 'custom-div-icon',
            iconSize: [25, 25],
            iconAnchor: [12, 25]
        });

        // Add markers to map
        offices.forEach(office => {
            const icon = office.type === 'main' ? mainIcon : branchIcon;

            const marker = L.marker([office.lat, office.lng], {
                icon: icon
            }).addTo(map);

            marker.bindPopup(`
                <div class="map-popup-content">
                    <div class="map-popup-title">${office.name}</div>
                    <div class="map-popup-address">${office.address}</div>
                    <div class="map-popup-phone">📞 ${office.phone}</div>
                </div>
            `);
        });

        // Fit map to show all markers
        const group = new L.featureGroup(offices.map(office => L.marker([office.lat, office.lng])));
        map.fitBounds(group.getBounds().pad(0.1));
    </script>
</body>

</html>
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views/about/index.blade.php ENDPATH**/ ?>