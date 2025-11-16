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
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
                    <a href="{{ route('homepage') }}" class="btn btn-home">
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
            <h1 class="user-name">{{ $user->fullname ?? $user->username }}</h1>
            <p class="user-bio">Thành viên TechStore từ 2024</p>

            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-number">{{ $user->orders->count() ?? 0 }}</div>
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
        <!-- Thêm vào đầu content container trong file profile -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
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
                                    <span class="detail-value">{{ $user->fullname ?? $user->username }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email</span>
                                    <span class="detail-value">{{ $user->email }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Username</span>
                                    <span class="detail-value">{{ $user->username }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Số Điện Thoại</span>
                                    <span class="detail-value">{{ $user->phone ?? 'Chưa cập nhật' }}</span>
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
                        @forelse($user->orders as $order)
                            <div class="glass-card order-card">
                                <div class="order-header">
                                    <div class="order-id">Đơn Hàng #{{ $order->id }}</div>
                                    <span class="order-status status-{{ $order->status ?? 'processing' }}">
                                        {{ $order->status ?? 'Đang xử lý' }}
                                    </span>
                                </div>
                                <div class="order-details">
                                    <div class="order-meta">
                                        <i class="fas fa-calendar"></i>
                                        <span>{{ $order->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="order-meta">
                                        <i class="fas fa-dollar-sign"></i>
                                        <span>{{ number_format($order->items->sum(function ($i) {return $i->price * $i->quantity;})) }}₫</span>
                                    </div>
                                    <div class="order-meta">
                                        <i class="fas fa-box"></i>
                                        <span>{{ $order->items->count() }} sản phẩm</span>
                                    </div>
                                </div>
                                <div class="order-actions">
                                    <a href="{{ route('client.orders.show', $order->id) }}"
                                        class="btn-action btn-primary">
                                        <i class="fas fa-eye me-2"></i>Chi Tiết
                                    </a>
                                    <button class="btn-action btn-outline">
                                        <i class="fas fa-redo me-2"></i>Mua Lại
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-shopping-bag"></i>
                                <h4>Chưa Có Đơn Hàng</h4>
                                <p>Bạn chưa thực hiện giao dịch nào với chúng tôi</p>
                                <a href="{{ route('homepage') }}" class="btn-action btn-primary mt-3">
                                    <i class="fas fa-shopping-cart me-2"></i>Khám Phá Sản Phẩm
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>


            <!-- Address Section -->
            <!-- Address Section trong file profile -->
            <!-- Address Section -->
            <div id="address" class="content-section">
                <div class="glass-card p-4">
                    <h2 class="section-title">
                        <i class="fas fa-map-marked-alt"></i>
                        Địa Chỉ Giao Hàng
                    </h2>

                    <div class="address-grid">
                        @forelse($user->shippingAddresses as $address)
                            <div class="glass-card address-card {{ $address->is_default ? 'primary' : '' }}">
                                @if ($address->is_default)
                                    <span class="address-badge">Mặc Định</span>
                                @endif
                                <div class="address-content">
                                    <h4>{{ $address->fullname }}</h4>
                                    <div class="address-details">
                                        <p><i
                                                class="fas fa-phone me-2 text-muted"></i><strong>{{ $address->phone }}</strong>
                                        </p>
                                        <p><i
                                                class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $address->address }}
                                        </p>
                                    </div>
                                </div>
                                <div class="address-actions">
                                    @if (!$address->is_default)
                                        <form action="{{ route('client.shipping-addresses.set-default', $address) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-outline"
                                                title="Đặt làm mặc định">
                                                <i class="fas fa-star me-2"></i>Mặc định
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('client.shipping-addresses.edit', $address) }}"
                                        class="btn-action btn-primary" title="Chỉnh sửa">
                                        <i class="fas fa-edit me-2"></i>Sửa
                                    </a>
                                    <form action="{{ route('client.shipping-addresses.destroy', $address) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')"
                                            title="Xóa địa chỉ">
                                            <i class="fas fa-trash me-2"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                                <h4>Chưa Có Địa Chỉ</h4>
                                <p>Thêm địa chỉ để thuận tiện cho việc mua sắm</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('client.shipping-addresses.create') }}" class="btn-action btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm Địa Chỉ Mới
                        </a>
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
                            <a href="{{ route('ad.reset.form', $user->id) }}" class="btn-action btn-warning">
                                <i class="fas fa-sync-alt me-2"></i>Reset Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <form action="{{ route('ad.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn-lg btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Đăng Xuất
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Kiểm tra nếu URL có hash là #address
            if (window.location.hash === '#address') {
                // Hiển thị section address
                showSection('address');

                // Cuộn đến section address
                setTimeout(() => {
                    document.getElementById('address').scrollIntoView({
                        behavior: 'smooth'
                    });
                }, 100);
            }

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

            // Gán hàm showSection ra global để sử dụng trong onclick
            window.showSection = showSection;
        });
    </script>
</body>

</html>
