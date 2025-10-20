<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán qua ngân hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/bank.css')); ?>">
</head>

<body>
    <div class="container py-5">
        <div class="payment-card">
            <!-- Header -->
            <div class="bank-header">
                <div class="header-content">
                    <div class="bank-icon">
                        <i class="bi bi-bank"></i>
                    </div>
                    <h1 class="h3 fw-bold mb-2">Thanh toán qua ngân hàng</h1>
                    <p class="mb-0 opacity-90">Chuyển khoản an toàn & bảo mật</p>
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

                <!-- Bank Information -->
                <div class="bank-info-card">
                    <h5 class="text-gradient mb-4">🏦 Thông tin tài khoản ngân hàng</h5>

                    <div class="info-item">
                        <span class="info-label">Ngân hàng:</span>
                        <span class="info-value"><?php echo e($bankData['bank_name']); ?></span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Số tài khoản:</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="info-value"><?php echo e($bankData['account_no']); ?></span>
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo e($bankData['account_no']); ?>')">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Chủ tài khoản:</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="info-value"><?php echo e($bankData['account_name']); ?></span>
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo e($bankData['account_name']); ?>')">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Số tiền:</span>
                        <span class="info-value amount-highlight"><?php echo e(number_format($totalAmount, 0, ',', '.')); ?>

                            VNĐ</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Nội dung CK:</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="info-value">THANHTOAN<?php echo e($order_id); ?></span>
                            <button class="copy-btn" onclick="copyToClipboard('THANHTOAN<?php echo e($order_id); ?>')">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="qr-container">
                    <h6 class="fw-bold mb-3">📱 Quét mã QR để thanh toán nhanh</h6>
                    <img src="<?php echo e(asset('storage/payments/bank.jpg')); ?>" alt="QR Code" class="qr-image">
                    <p class="text-muted mt-3 mb-0">
                        <small>Quét mã QR bằng app ngân hàng để chuyển khoản nhanh chóng</small>
                    </p>
                </div>

                <!-- Steps Guide -->
                <div class="steps-guide">
                    <h6 class="fw-bold mb-3">📋 Hướng dẫn thanh toán</h6>
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <small class="fw-bold">Mở app ngân hàng</small>
                            <small class="text-muted d-block">Khởi động ứng dụng ngân hàng trên điện thoại</small>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <small class="fw-bold">Chọn chuyển khoản</small>
                            <small class="text-muted d-block">Chọn tính năng chuyển khoản/QR Pay</small>
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
                            <small class="fw-bold">Nhập nội dung</small>
                            <small class="text-muted d-block">Nhập nội dung: THANHTOAN<?php echo e($order_id); ?></small>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="<?php echo e(route('order.success', ['order_id' => $order_id])); ?>" class="btn-bank">
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
                    • Nhập chính xác nội dung chuyển khoản: <strong>THANHTOAN<?php echo e($order_id); ?></strong><br>
                    • Đơn hàng sẽ được tự động xác nhận sau 5-10 phút kể từ khi chuyển khoản thành công
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

        // Start 15-minute countdown
        document.addEventListener('DOMContentLoaded', function() {
            startCountdown(15);
        });
    </script>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\payment\bank.blade.php ENDPATH**/ ?>