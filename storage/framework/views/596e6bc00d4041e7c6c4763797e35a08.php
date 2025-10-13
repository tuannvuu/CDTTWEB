<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công - TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/success.css')); ?>">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card success-card">
                    <div class="success-header text-center">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h1 class="display-5 fw-bold">Đặt Hàng Thành Công!</h1>
                        <p class="lead mb-0">Cảm ơn bạn đã mua hàng tại TechStore</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="order-details text-center">
                            <h3 class="mb-3">Mã đơn hàng của bạn</h3>
                            <p class="order-id">#ORD20230515001</p>
                            <p class="text-muted">Chúng tôi sẽ gửi email xác nhận đơn hàng trong vài phút tới.</p>
                        </div>

                        <div class="timeline">
                            <h4 class="mb-4">Tình trạng đơn hàng</h4>
                            <div class="timeline-item">
                                <h5 class="mb-1">Đơn hàng đã được xác nhận</h5>
                                <p class="text-muted mb-0">Đơn hàng của bạn đã được xác nhận và đang được xử lý.</p>
                                <small class="text-success">Hôm nay, 10:30 AM</small>
                            </div>
                            <div class="timeline-item">
                                <h5 class="mb-1">Đang chuẩn bị hàng</h5>
                                <p class="text-muted mb-0">Nhân viên đang chuẩn bị hàng để giao cho bạn.</p>
                                <small class="text-muted">Dự kiến: Hôm nay, 02:00 PM</small>
                            </div>
                            <div class="timeline-item">
                                <h5 class="mb-1">Giao hàng</h5>
                                <p class="text-muted mb-0">Đơn hàng sẽ được giao đến địa chỉ của bạn.</p>
                                <small class="text-muted">Dự kiến: Ngày mai, 09:00 AM - 12:00 PM</small>
                            </div>
                        </div>

                        <div class="whats-next">
                            <h4 class="mb-4">Những việc tiếp theo</h4>
                            <div class="d-flex align-items-start mb-3">
                                <div class="step-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Theo dõi đơn hàng</h5>
                                    <p class="text-muted mb-0">Bạn có thể theo dõi trạng thái đơn hàng trong tài khoản
                                        của mình.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <div class="step-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Kiểm tra email</h5>
                                    <p class="text-muted mb-0">Chúng tôi sẽ gửi thông tin cập nhật đơn hàng qua email.
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="step-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Liên hệ hỗ trợ</h5>
                                    <p class="text-muted mb-0">Nếu có bất kỳ câu hỏi nào, hãy liên hệ với chúng tôi qua
                                        hotline: 1900 1234</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="<?php echo e(route('homepage')); ?>" class="btn btn-primary me-3">
                                <i class="fas fa-home me-2"></i>Quay về trang chủ
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">Cảm ơn bạn đã tin tưởng và mua sắm tại TechStore</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\payment\success.blade.php ENDPATH**/ ?>