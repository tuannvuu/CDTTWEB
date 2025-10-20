<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Khoản Cá Nhân | TechStore</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #8b5cf6;
            --secondary: #64748b;
            --accent: #f59e0b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #6366f1, #8b5cf6);
            --gradient-dark: linear-gradient(135deg, #4f46e5, #7c3aed);
            --shadow-sm: 0 2px 12px rgba(99, 102, 241, 0.08);
            --shadow-md: 0 8px 30px rgba(99, 102, 241, 0.12);
            --shadow-lg: 0 20px 50px rgba(99, 102, 241, 0.15);
            --radius: 20px;
            --radius-sm: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 50%, #e0e7ff 100%);
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
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
        }

        .glass-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Header */
        .profile-header {
            position: relative;
            overflow: hidden;
            padding: 3rem 0;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: var(--gradient);
            border-radius: 0 0 var(--radius) var(--radius);
            z-index: -1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .btn-home {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        /* Profile Hero */
        .profile-hero {
            text-align: center;
            padding: 2rem 0;
        }

        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid white;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .profile-avatar i {
            font-size: 3rem;
            color: white;
        }

        .avatar-status {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 20px;
            height: 20px;
            background: var(--success);
            border: 2px solid white;
            border-radius: 50%;
        }

        .user-name {
            font-size: 2rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .user-bio {
            color: var(--secondary);
            font-size: 1.1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--secondary);
            font-weight: 500;
        }

        /* Navigation */
        .profile-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .nav-btn {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(99, 102, 241, 0.1);
            padding: 1rem 2rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            color: var(--dark);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 200px;
            justify-content: center;
        }

        .nav-btn:hover,
        .nav-btn.active {
            background: var(--gradient);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .nav-btn i {
            font-size: 1.25rem;
        }

        /* Content Sections */
        .content-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .content-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title i {
            color: var(--primary);
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            gap: 1.5rem;
        }

        .info-card {
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient);
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .info-content h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }

        .info-content p {
            color: var(--secondary);
            margin: 0;
        }

        .info-details {
            display: grid;
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: var(--secondary);
        }

        .detail-value {
            font-weight: 600;
            color: var(--dark);
        }

        /* Orders */
        .orders-grid {
            display: grid;
            gap: 1.5rem;
        }

        .order-card {
            padding: 2rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateX(10px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .order-id {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .order-status {
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-processing {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .order-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--secondary);
        }

        .order-meta i {
            color: var(--primary);
        }

        .order-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
        }

        .btn-primary:hover {
            background: var(--gradient-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Address */
        .address-grid {
            display: grid;
            gap: 1.5rem;
        }

        .address-card {
            padding: 2rem;
            position: relative;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .address-card.primary {
            border-color: var(--primary);
        }

        .address-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .address-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .address-content h4 {
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .address-details p {
            margin-bottom: 0.5rem;
            color: var(--secondary);
        }

        .address-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--secondary);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--secondary);
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h4 {
            margin-bottom: 1rem;
            color: var(--dark);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .btn-lg {
            padding: 1rem 2rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 200px;
            justify-content: center;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 2px solid rgba(239, 68, 68, 0.2);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-nav {
                flex-direction: column;
                align-items: center;
            }

            .nav-btn {
                min-width: 100%;
            }

            .order-details {
                grid-template-columns: 1fr;
            }

            .order-actions {
                justify-content: center;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-lg {
                min-width: 100%;
            }
        }

        /* Utilities */
        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="profile-header">
        <div class="container">
            <div class="header-content">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h2 text-white mb-2">Tài Khoản Cá Nhân</h1>
                        <p class="text-white-50 mb-0">Quản lý thông tin và trải nghiệm mua sắm</p>
                    </div>
                    <a href="<?php echo e(route('homepage')); ?>" class="btn btn-home">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- Profile Hero -->
        <div class="glass-card profile-hero mb-5">
            <div class="avatar-container">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                    <div class="avatar-status"></div>
                </div>
            </div>
            <h1 class="user-name"><?php echo e($user->fullname ?? $user->username); ?></h1>
            <p class="user-bio">Thành viên TechStore từ 2024</p>

            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-number"><?php echo e($user->orders->count() ?? 0); ?></div>
                    <div class="stat-label">Đơn Hàng</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">4.8</div>
                    <div class="stat-label">Đánh Giá</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <div class="stat-number">Gold</div>
                    <div class="stat-label">Hạng Thành Viên</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="profile-nav">
            <button class="nav-btn active" onclick="showSection('profile')">
                <i class="fas fa-user-circle"></i>
                Hồ Sơ Cá Nhân
            </button>
            <button class="nav-btn" onclick="showSection('orders')">
                <i class="fas fa-receipt"></i>
                Đơn Hàng
            </button>
            <button class="nav-btn" onclick="showSection('address')">
                <i class="fas fa-map-marker-alt"></i>
                Địa Chỉ
            </button>
            <button class="nav-btn" onclick="showSection('security')">
                <i class="fas fa-shield-alt"></i>
                Bảo Mật
            </button>
        </div>

        <!-- Content Sections -->
        <div class="content-container">
            <!-- Profile Section -->
            <div id="profile" class="content-section active">
                <div class="glass-card p-4 mb-4">
                    <h2 class="section-title">
                        <i class="fas fa-id-card"></i>
                        Thông Tin Cá Nhân
                    </h2>
                    <div class="info-grid">
                        <div class="glass-card info-card">
                            <div class="info-header">
                                <div class="info-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Thông Tin Cơ Bản</h4>
                                    <p>Chi tiết tài khoản của bạn</p>
                                </div>
                            </div>
                            <div class="info-details">
                                <div class="detail-item">
                                    <span class="detail-label">Họ và Tên</span>
                                    <span class="detail-value"><?php echo e($user->fullname ?? $user->username); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email</span>
                                    <span class="detail-value"><?php echo e($user->email); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Username</span>
                                    <span class="detail-value"><?php echo e($user->username); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Số Điện Thoại</span>
                                    <span class="detail-value"><?php echo e($user->phone ?? 'Chưa cập nhật'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div id="orders" class="content-section">
                <div class="glass-card p-4">
                    <h2 class="section-title">
                        <i class="fas fa-history"></i>
                        Lịch Sử Đơn Hàng
                    </h2>
                    <div class="orders-grid">
                        <?php $__empty_1 = true; $__currentLoopData = $user->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="glass-card order-card">
                                <div class="order-header">
                                    <div class="order-id">Đơn Hàng #<?php echo e($order->id); ?></div>
                                    <span class="order-status status-<?php echo e($order->status ?? 'processing'); ?>">
                                        <?php echo e($order->status ?? 'Đang xử lý'); ?>

                                    </span>
                                </div>
                                <div class="order-details">
                                    <div class="order-meta">
                                        <i class="fas fa-calendar"></i>
                                        <span><?php echo e($order->created_at->format('d/m/Y')); ?></span>
                                    </div>
                                    <div class="order-meta">
                                        <i class="fas fa-dollar-sign"></i>
                                        <span><?php echo e(number_format($order->items->sum(function ($i) {return $i->price * $i->quantity;}))); ?>₫</span>
                                    </div>
                                    <div class="order-meta">
                                        <i class="fas fa-box"></i>
                                        <span><?php echo e($order->items->count()); ?> sản phẩm</span>
                                    </div>
                                </div>
                                <div class="order-actions">
                                    <a href="<?php echo e(route('client.orders.show', $order->id)); ?>" class="btn-action btn-primary">
                                        <i class="fas fa-eye me-2"></i>Chi Tiết
                                    </a>
                                    <button class="btn-action btn-outline">
                                        <i class="fas fa-redo me-2"></i>Mua Lại
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="empty-state">
                                <i class="fas fa-shopping-bag"></i>
                                <h4>Chưa Có Đơn Hàng</h4>
                                <p>Bạn chưa thực hiện giao dịch nào với chúng tôi</p>
                                <a href="<?php echo e(route('homepage')); ?>" class="btn-action btn-primary mt-3">
                                    <i class="fas fa-shopping-cart me-2"></i>Khám Phá Sản Phẩm
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div id="address" class="content-section">
                <div class="glass-card p-4">
                    <h2 class="section-title">
                        <i class="fas fa-map-marked-alt"></i>
                        Địa Chỉ Giao Hàng
                    </h2>
                    <div class="address-grid">
                        <div class="glass-card address-card primary">
                            <span class="address-badge">Mặc Định</span>
                            <div class="address-content">
                                <h4>Địa Chỉ Chính</h4>
                                <div class="address-details">
                                    <p><strong><?php echo e($user->fullname ?? $user->username); ?></strong></p>
                                    <p><?php echo e($user->phone ?? 'Chưa cập nhật'); ?></p>
                                    <p><?php echo e($user->address ?? 'Chưa cập nhật địa chỉ'); ?></p>
                                </div>
                            </div>
                            <div class="address-actions">
                                <button class="btn-action btn-primary">
                                    <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                                </button>
                                <button class="btn-action btn-outline">
                                    <i class="fas fa-trash me-2"></i>Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn-action btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm Địa Chỉ Mới
                        </button>
                    </div>
                </div>
            </div>

            <!-- Security Section -->
            <div id="security" class="content-section">
                <div class="glass-card p-4">
                    <h2 class="section-title">
                        <i class="fas fa-shield-alt"></i>
                        Bảo Mật Tài Khoản
                    </h2>
                    <div class="info-grid">
                        <div class="glass-card info-card">
                            <div class="info-header">
                                <div class="info-icon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Mật Khẩu</h4>
                                    <p>Cập nhật mật khẩu định kỳ để bảo vệ tài khoản</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="<?php echo e(route('ad.changepass.form')); ?>" class="btn-action btn-warning">
                                    <i class="fas fa-sync-alt me-2"></i>Đổi Mật Khẩu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="<?php echo e(route('ad.changepass.form')); ?>" class="btn-lg btn-warning">
                <i class="fas fa-key"></i>
                Đổi Mật Khẩu
            </a>
            <form action="<?php echo e(route('ad.logout')); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-lg btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Đăng Xuất
                </button>
            </form>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });

            // Remove active class from all nav buttons
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionId).classList.add('active');

            // Add active class to clicked button
            event.target.classList.add('active');
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\users\profile.blade.php ENDPATH**/ ?>