

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h3 class="mb-3">Thanh toán qua VNPAY</h3>

        <p>Bạn sẽ được chuyển đến cổng thanh toán VNPAY để hoàn tất giao dịch.</p>

        <form action="https://sandbox.vnpayment.vn/paymentv2/vpcpay.html" method="POST">
            <!-- Demo: chỗ này bạn cần cấu hình thêm nếu tích hợp VNPAY thật -->
            <input type="hidden" name="order_id" value="<?php echo e($order_id); ?>">
            <button type="submit" class="btn btn-primary">Thanh toán với VNPAY</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\payment\vnpay.blade.php ENDPATH**/ ?>