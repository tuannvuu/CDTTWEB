<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán qua MoMo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/momo.css')); ?>">
</head>

<body>
    <div class="container py-5">
        <div class="payment-card">
            <!-- Header -->
            <div class="momo-header">
                <div class="header-content">
                    <div class="momo-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h1 class="h3 fw-bold mb-2">Thanh toán qua MoMo</h1>
                    <p class="mb-0 opacity-90">Ví điện tử an toàn & tiện lợi</p>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="payment-details">
                <!-- Countdown Timer -->
                <div class="countdown-timer">
                    <p class="mb-1"><small>Thời gian còn lại để hoàn tất thanh toán</small></p>
                    <div class="timer-text">15:00</div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <h6 class="fw-bold mb-3">📦 Chi tiết đơn hàng</h6>

                    <!-- Dynamic Product Items -->
                    <?php
                        $totalAmount = 0;
                    ?>

                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $itemTotal = $item->price * $item->quantity;
                            $totalAmount += $itemTotal;
                        ?>
                        <div class="product-item">
                            <div class="product-name">
                                <?php echo e($item->product_name); ?>

                                <small class="text-muted">x<?php echo e($item->quantity); ?></small>
                            </div>
                            <div class="product-price">
                                <?php echo e(number_format($itemTotal, 0, ',', '.')); ?> VNĐ
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Additional Charges -->
                    <div class="product-item">
                        <div class="product-name">Phí vận chuyển</div>
                        <div class="product-price">
                            <?php
                                $shippingFee = 30000;
                                $totalAmount += $shippingFee;
                            ?>
                            <?php echo e(number_format($shippingFee, 0, ',', '.')); ?> VNĐ
                        </div>
                    </div>

                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="fw-bold">Tổng thanh toán</div>
                        <div class="h4 mb-0"><?php echo e(number_format($totalAmount, 0, ',', '.')); ?> VNĐ</div>
                    </div>
                </div>

                <!-- MoMo Information -->
                <div class="momo-info-card">
                    <h5 class="text-gradient mb-4">📱 Thông tin thanh toán MoMo</h5>

                    <div class="info-item">
                        <span class="info-label">Số điện thoại MoMo:</span>
                        <span class="info-value"><?php echo e($momoData['phone']); ?></span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Chủ tài khoản:</span>
                        <span class="info-value"><?php echo e($momoData['wallet_name']); ?></span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Số tiền:</span>
                        <span class="info-value amount-highlight"><?php echo e(number_format($totalAmount, 0, ',', '.')); ?>

                            VNĐ</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Nội dung:</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="info-value">MOMO<?php echo e($order_id); ?></span>
                            <button class="copy-btn" onclick="copyToClipboard('MOMO<?php echo e($order_id); ?>')">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Phone Input for MoMo -->
                    <div class="phone-input">
                        <input type="text" placeholder="Nhập số điện thoại MoMo của bạn" id="customer-phone">
                        <button onclick="validatePhoneNumber()">Xác nhận</button>
                    </div>

                    <!-- Alert for phone validation -->
                    <div class="alert-info d-none" id="phone-alert">
                        <small>
                            <i class="bi bi-info-circle"></i>
                            Số điện thoại đã được xác nhận. Vui lòng quét mã QR hoặc chuyển khoản đến số điện thoại MoMo
                            bên trên.
                        </small>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="qr-container">
                    <h6 class="fw-bold mb-3">📱 Quét mã QR để thanh toán nhanh</h6>
                    <img src="<?php echo e(asset('storage/payments/momo.jpg')); ?>" alt="QR Code" class="qr-image">
                    <p class="text-muted mt-3 mb-0">
                        <small>Quét mã QR bằng app MoMo để thanh toán nhanh chóng</small>
                    </p>
                </div>

                <!-- Steps Guide -->
                <div class="steps-guide">
                    <h6 class="fw-bold mb-3">📋 Hướng dẫn thanh toán</h6>
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <small class="fw-bold">Mở app MoMo</small>
                            <small class="text-muted d-block">Khởi động ứng dụng MoMo trên điện thoại</small>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <small class="fw-bold">Chọn quét mã</small>
                            <small class="text-muted d-block">Chọn tính năng quét mã QR hoặc thanh toán</small>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <small class="fw-bold">Quét mã & Xác nhận</small>
                            <small class="text-muted d-block">Quét mã QR và xác nhận thanh toán</small>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <small class="fw-bold">Kiểm tra thông tin</small>
                            <small class="text-muted d-block">Kiểm tra số tiền và nội dung:
                                MOMO<?php echo e($order_id); ?></small>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="<?php echo e(route('order.success', ['order_id' => $order_id])); ?>" class="btn-momo">
                    <i class="bi bi-check-circle"></i>
                    Tôi đã thanh toán thành công
                </a>

                <!-- Security Badge -->
                <div class="security-badge">
                    <i class="bi bi-shield-check"></i>
                    <span>Giao dịch được bảo mật SSL 256-bit</span>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-4">
            <p class="text-muted">
                <small>
                    💡 <strong>Lưu ý quan trọng:</strong><br>
                    • Vui lòng không đóng trang này cho đến khi hoàn tất thanh toán<br>
                    • Kiểm tra chính xác nội dung chuyển khoản: <strong>MOMO<?php echo e($order_id); ?></strong><br>
                    • Đơn hàng sẽ được tự động xác nhận sau 2-5 phút kể từ khi thanh toán thành công<br>
                    • Hỗ trợ 24/7 qua hotline: 1900 5454 26
                </small>
            </p>
        </div>
    </div>

    <script>
        // Countdown Timer
        function startCountdown(minutes) {
            let seconds = minutes * 60;
            const timerElement = document.querySelector('.timer-text');

            const countdown = setInterval(() => {
                seconds--;
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;

                timerElement.textContent =
                    `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

                if (seconds <= 0) {
                    clearInterval(countdown);
                    timerElement.textContent = 'Hết hạn';
                    timerElement.style.color = 'var(--danger)';
                }
            }, 1000);
        }

        // Copy to Clipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show success feedback
                const btn = event.target.closest('.copy-btn');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i>';
                btn.style.background = 'var(--success)';
                btn.style.color = 'white';

                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.style.background = '';
                    btn.style.color = '';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }

        // Phone number validation
        function validatePhoneNumber() {
            const phoneInput = document.getElementById('customer-phone');
            const phoneAlert = document.getElementById('phone-alert');
            const phone = phoneInput.value.trim();

            // Simple phone validation (Vietnamese phone number format)
            const phoneRegex = /^(0|\+84)(3[2-9]|5[2689]|7[06-9]|8[1-9]|9[0-9])[0-9]{7}$/;

            if (phone === '') {
                alert('Vui lòng nhập số điện thoại MoMo của bạn');
                return;
            }

            if (!phoneRegex.test(phone)) {
                alert('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại Việt Nam hợp lệ.');
                return;
            }

            // If validation passes, show success message
            phoneAlert.classList.remove('d-none');
            phoneInput.disabled = true;
            event.target.disabled = true;
            event.target.textContent = 'Đã xác nhận';
        }

        // Start 15-minute countdown
        document.addEventListener('DOMContentLoaded', function() {
            startCountdown(15);
        });
    </script>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\payment\momo.blade.php ENDPATH**/ ?>