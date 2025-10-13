<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>

<body>
    <div class="container-fluid py-4">
        <div class="checkout-container">
            <div class="checkout-card">
                <!-- Header -->
                <div class="checkout-header">
                    <a href="/" class="nav-back">
                        <i class="fas fa-arrow-left"></i>
                        Quay lại trang chủ
                    </a>
                    <h1><i class="fas fa-lock"></i> Thanh Toán An Toàn</h1>
                    <p>Hoàn tất đơn hàng công nghệ của bạn</p>
                </div>

                <div class="row g-0">
                    <!-- Form Section -->
                    <div class="col-lg-7">
                        <div class="form-section">
                            <!-- Alert Component -->
                            <x-alert></x-alert>

                            <form action="{{ route('cart.save') }}" method="POST">
                                @csrf

                                <h3 class="section-title">
                                    <i class="fas fa-user-circle"></i>
                                    Thông tin giao hàng
                                </h3>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="f-fullname" name="fullname"
                                                value="{{ old('fullname') }}" placeholder="Họ và tên" required>
                                            <label for="f-fullname">Họ và tên *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="f-tel" name="tel"
                                                value="{{ old('tel') }}" placeholder="Số điện thoại" required>
                                            <label for="f-tel">Số điện thoại *</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="f-address" name="address"
                                        value="{{ old('address') }}" placeholder="Địa chỉ giao hàng" required>
                                    <label for="f-address">Địa chỉ giao hàng *</label>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="f-description" name="description"
                                        value="{{ old('description') }}" placeholder="Ghi chú đơn hàng">
                                    <label for="f-description">Ghi chú đơn hàng (tùy chọn)</label>
                                </div>

                                <!-- Payment Methods -->
                                <div class="payment-methods">
                                    <h3 class="section-title">
                                        <i class="fas fa-credit-card"></i>
                                        Phương thức thanh toán
                                    </h3>

                                    <div class="payment-grid">
                                        <label class="payment-card selected">
                                            <input type="radio" name="payment_method" value="cod"
                                                class="payment-radio" checked>
                                            <div class="payment-icon">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="payment-name">COD</div>
                                            <div class="payment-desc">Thanh toán khi nhận hàng</div>
                                        </label>

                                        <label class="payment-card">
                                            <input type="radio" name="payment_method" value="bank"
                                                class="payment-radio">
                                            <div class="payment-icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="payment-name">Chuyển khoản</div>
                                            <div class="payment-desc">Internet Banking</div>
                                        </label>

                                        <label class="payment-card">
                                            <input type="radio" name="payment_method" value="momo"
                                                class="payment-radio">
                                            <div class="payment-icon">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <div class="payment-name">MoMo</div>
                                            <div class="payment-desc">Ví điện tử</div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Security Badge -->
                                <div class="security-badge">
                                    <i class="fas fa-shield-alt"></i>
                                    <div>
                                        <strong>Giao dịch được bảo mật</strong>
                                        <div class="small">Thông tin của bạn được mã hóa an toàn</div>
                                    </div>
                                </div>

                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-lock me-2"></i>
                                    Hoàn tất đặt hàng
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-5">
                        <div class="cart-summary">
                            <h3 class="section-title">
                                <i class="fas fa-shopping-bag"></i>
                                Đơn hàng của bạn
                            </h3>

                            <div class="cart-items">
                                @foreach ($cart as $item)
                                    @php
                                        $subtotal = $item['price'] * $item['quantity'];
                                    @endphp
                                    <div class="cart-item">
                                        <div class="item-image">
                                            <i class="fas fa-laptop"></i>
                                        </div>
                                        <div class="item-details">
                                            <div class="item-name">{{ $item['proname'] }}</div>
                                            <div class="item-price">{{ number_format($item['price']) }} ₫</div>
                                        </div>
                                        <div class="item-quantity">x{{ $item['quantity'] }}</div>
                                        <a href="{{ route('cartdel', ['id' => $item['productid']]) }}"
                                            class="btn btn-sm btn-outline-danger ms-2">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="total-section">
                                <div class="total-row">
                                    <span>Số lượng sản phẩm:</span>
                                    <span class="fw-semibold">{{ $totalQuantity }}</span>
                                </div>
                                <div class="total-row">
                                    <span>Tạm tính:</span>
                                    <span class="fw-semibold">{{ number_format($total) }} ₫</span>
                                </div>
                                <div class="total-row">
                                    <span>Phí vận chuyển:</span>
                                    <span class="text-success fw-semibold">Miễn phí</span>
                                </div>
                                <div class="total-row">
                                    <span>Bảo hành:</span>
                                    <span class="text-primary fw-semibold">12 tháng</span>
                                </div>
                                <div class="total-row grand-total">
                                    <span>Tổng cộng:</span>
                                    <span class="total-amount">{{ number_format($total) }} ₫</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment method selection
        document.querySelectorAll('.payment-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.payment-card').forEach(card => {
                    card.classList.remove('selected');
                });
                this.closest('.payment-card').classList.add('selected');
            });
        });

        // Form animations
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.form-floating, .payment-card, .cart-item');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>

</html>
