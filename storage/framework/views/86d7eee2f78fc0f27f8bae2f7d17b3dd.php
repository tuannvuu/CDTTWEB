<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Giỏ hàng - TechStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/cartshow.css')); ?>">
    <style>
        /* Thêm style này để nút xóa (button) trông giống link (a) */
        .remove-btn-form {
            display: inline;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #dc3545;
            /* Màu đỏ bootstrap */
            cursor: pointer;
            padding: 0;
            font-size: 1.2rem;
            /* Kích thước icon */
        }

        .remove-btn:hover {
            color: #a71d2a;
            /* Màu đỏ sậm hơn khi hover */
        }
    </style>
</head>

<body>
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

    <section class="cart-section">
        <div class="container">
            <h1 class="cart-title">
                <i class="fas fa-shopping-cart"></i>
                Giỏ hàng của bạn
            </h1>

            <div class="cart-container">
                <?php if(count($cart) > 0): ?>
                    <div class="promo-section">
                        <div class="promo-input-group">
                            <input type="text" class="promo-input" placeholder="Nhập mã giảm giá...">
                            <button class="apply-promo-btn">Áp dụng</button>
                        </div>
                    </div>

                    <div class="cart-header">
                        <div>Sản phẩm</div>
                        <div>Đơn giá</div>
                        <div>Số lượng</div>
                        <div>Thành tiền</div>
                        <div></div>
                    </div>

                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $subtotal = $item['price'] * $item['quantity'];
                        ?>

                        <div class="cart-item" data-productid="<?php echo e($item['productid']); ?>">
                            <div class="product-info">
                                <div class="product-image">
                                    <img src="<?php echo e(asset('storage/products/' . $item['fileName'])); ?>"
                                        alt="<?php echo e($item['proname']); ?>">

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

                            <div class="subtotal" id="subtotal-<?php echo e($item['productid']); ?>"><?php echo e(number_format($subtotal)); ?>

                                ₫</div>

                            <div>
                                <form action="<?php echo e(route('cartdel', ['id' => $item['productid']])); ?>" method="POST"
                                    class="remove-btn-form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="remove-btn" title="Xóa sản phẩm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="cart-summary">
                        <div class="summary-row">
                            <span>Tạm tính:</span>
                            <span id="summary-subtotal"><?php echo e(number_format($total)); ?> ₫</span>
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
                            <span class="total-amount" id="summary-total"><?php echo e(number_format($total)); ?> ₫</span>
                        </div>
                        <a href="<?php echo e(route('checkout')); ?>" class="checkout-btn">
                            <i class="fas fa-credit-card"></i>
                            Tiến hành thanh toán
                        </a>
                    </div>
                <?php else: ?>
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
        // Lấy CSRF token từ thẻ meta
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                const productId = cartItem.dataset.productid; // Lấy ID sản phẩm
                const input = cartItem.querySelector('.quantity-input');

                let newQuantity = parseInt(input.value);

                // Tính toán số lượng mới
                if (this.textContent.trim() === '+') {
                    newQuantity++;
                } else if (this.textContent.trim() === '-' && newQuantity > 1) {
                    newQuantity--;
                } else if (newQuantity <= 1) {
                    return; // Không cho giảm dưới 1
                }

                // Cập nhật số lượng trên input ngay lập tức
                input.value = newQuantity;

                // Gọi hàm để cập nhật trên server
                updateCartOnServer(productId, newQuantity);
            });
        });

        function updateCartOnServer(productId, quantity) {
            fetch("<?php echo e(route('cart.update')); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json', // Báo cho Laravel biết ta muốn nhận JSON
                        'X-CSRF-TOKEN': csrfToken // Gửi kèm CSRF token
                    },
                    body: JSON.stringify({
                        productid: productId, // Phải khớp với $request->productid
                        quantity: quantity
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        // Cập nhật thành tiền của item
                        document.getElementById(`subtotal-${productId}`).textContent = data.subtotal_formatted;

                        // Cập nhật tổng tiền ở summary
                        document.getElementById('summary-subtotal').textContent = data.total_formatted;
                        document.getElementById('summary-total').textContent = data.total_formatted;

                        console.log(data.message); // Log: 'Cập nhật giỏ hàng thành công!'
                    } else {
                        console.error('Lỗi:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Lỗi Fetch:', error);
                    alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                });
        }

        // Hiệu ứng khi trang load (giữ nguyên)
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
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/client/cart/cartshow.blade.php ENDPATH**/ ?>