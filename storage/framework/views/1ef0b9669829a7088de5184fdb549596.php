<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - TechStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/cartshow.css')); ?>">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="/" class="logo">
                    <span class="brand-text ms-2">TechStore</span>
                </a>
                <div class="nav-links">
                    <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
                    <a href="/"><i class="fas fa-mobile-alt"></i> Sản phẩm</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <h1 class="cart-title">
                <i class="fas fa-shopping-cart"></i>
                Giỏ hàng của bạn
            </h1>

            <div class="cart-container">
                <?php if(count($cart) > 0): ?>
                    <!-- Promo Code Section -->
                    <div class="promo-section">
                        <div class="promo-input-group">
                            <input type="text" class="promo-input" placeholder="Nhập mã giảm giá...">
                            <button class="apply-promo-btn">Áp dụng</button>
                        </div>
                    </div>

                    <!-- Cart Header -->
                    <div class="cart-header">
                        <div>Sản phẩm</div>
                        <div>Đơn giá</div>
                        <div>Số lượng</div>
                        <div>Thành tiền</div>
                        <div></div>
                    </div>

                    <!-- Cart Items -->
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $subtotal = $item['price'] * $item['quantity'];
                        ?>
                        <div class="cart-item">
                            <div class="product-info">
                                <div class="product-image">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                <div class="product-details">
                                    <div class="product-name"><?php echo e($item['proname']); ?></div>
                                    <div class="product-category">Điện tử</div>
                                </div>
                            </div>
                            <div class="price price-highlight"><?php echo e(number_format($item['price'])); ?> ₫</div>
                            <div class="quantity-controls">
                                <button class="quantity-btn">-</button>
                                <input type="text" class="quantity-input" value="<?php echo e($item['quantity']); ?>" readonly>
                                <button class="quantity-btn">+</button>
                            </div>
                            <div class="subtotal"><?php echo e(number_format($subtotal)); ?> ₫</div>
                            <div>
                                <a href="<?php echo e(route('cartdel', ['id' => $item['productid']])); ?>" class="remove-btn"
                                    title="Xóa sản phẩm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Cart Summary -->
                    <div class="cart-summary">
                        <div class="summary-row">
                            <span>Tạm tính:</span>
                            <span><?php echo e(number_format($total)); ?> ₫</span>
                        </div>
                        <div class="summary-row">
                            <span>Giảm giá:</span>
                            <span>0 ₫</span>
                        </div>
                        <div class="summary-row">
                            <span>Phí vận chuyển:</span>
                            <span>Miễn phí</span>
                        </div>
                        <div class="summary-row total-row">
                            <span>Tổng cộng:</span>
                            <span class="total-amount"><?php echo e(number_format($total)); ?> ₫</span>
                        </div>
                        <a href="<?php echo e(route('checkout')); ?>" class="checkout-btn">
                            <i class="fas fa-credit-card"></i>
                            Tiến hành thanh toán
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Empty Cart -->
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Giỏ hàng của bạn đang trống</p>
                        <a href="/" class="continue-shopping">
                            <i class="fas fa-arrow-left"></i>
                            Tiếp tục mua sắm
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
        // Xử lý tăng/giảm số lượng sản phẩm
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                const input = cartItem.querySelector('.quantity-input');
                const priceEl = cartItem.querySelector('.price');
                const subtotalEl = cartItem.querySelector('.subtotal');

                let value = parseInt(input.value);
                const price = parseInt(priceEl.textContent.replace(/\D/g, ''));

                if (this.textContent.trim() === '+') {
                    value++;
                } else if (this.textContent.trim() === '-' && value > 1) {
                    value--;
                }

                input.value = value;

                // Cập nhật thành tiền
                const newSubtotal = price * value;
                subtotalEl.textContent = newSubtotal.toLocaleString() + ' ₫';

                // Cập nhật lại tổng cộng
                updateCartTotal();
            });
        });

        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const subtotalEl = item.querySelector('.subtotal');
                const subtotal = parseInt(subtotalEl.textContent.replace(/\D/g, '')) || 0;
                total += subtotal;
            });

            document.querySelectorAll('.cart-summary .summary-row span:last-child').forEach((el, index) => {
                if (index === 0) { // Tạm tính
                    el.textContent = total.toLocaleString() + ' ₫';
                }
            });

            document.querySelector('.total-amount').textContent = total.toLocaleString() + ' ₫';
        }

        // Hiệu ứng khi trang load
        document.addEventListener('DOMContentLoaded', function() {
            const cartItems = document.querySelectorAll('.cart-item');
            cartItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>

</body>

</html>
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\cart\cartshow.blade.php ENDPATH**/ ?>