<?php $__env->startSection('title', 'Chi tiết đơn hàng'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header bg-gradient-primary rounded-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title text-white mb-2">
                        <i class="fas fa-shopping-cart me-3"></i>Chi tiết Đơn hàng #<?php echo e($order->id); ?>

                    </h1>
                    <p class="page-subtitle text-white-50 mb-0">Xem thông tin chi tiết đơn hàng</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="<?php echo e(route('ad.orders.index')); ?>" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Thông tin chung -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e($order->items->count()); ?></div>
                    <div class="stats-label">Số sản phẩm</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e($order->items->sum('quantity')); ?></div>
                    <div class="stats-label">Tổng số lượng</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?php echo e(number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.')); ?> đ
                    </div>
                    <div class="stats-label">Tổng tiền</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <?php
                        $statusConfig = [
                            'pending' => ['bg-warning', 'Chờ xử lý'],
                            'confirmed' => ['bg-info', 'Đã xác nhận'],
                            'shipping' => ['bg-primary', 'Đang giao'],
                            'completed' => ['bg-success', 'Hoàn thành'],
                            'cancelled' => ['bg-danger', 'Đã hủy'],
                        ];
                        $status = $statusConfig[$order->status] ?? $statusConfig['pending'];
                    ?>
                    <div class="stats-number">
                        <span class="badge <?php echo e($status[0]); ?>"><?php echo e($status[1]); ?></span>
                    </div>
                    <div class="stats-label">Trạng thái</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Thông tin khách hàng -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>Thông tin khách hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-semibold">Họ tên:</div>
                            <div class="col-sm-8"><?php echo e($order->customer->fullname ?? 'Khách vãng lai'); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-semibold">Số điện thoại:</div>
                            <div class="col-sm-8"><?php echo e($order->customer->tel ?? 'N/A'); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-semibold">Email:</div>
                            <div class="col-sm-8"><?php echo e($order->customer->email ?? 'N/A'); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 fw-semibold">Địa chỉ:</div>
                            <div class="col-sm-8"><?php echo e($order->customer->address ?? 'Chưa cập nhật'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-receipt me-2"></i>Thông tin đơn hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-semibold">Mã đơn:</div>
                            <div class="col-sm-8">#<?php echo e($order->id); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-semibold">Ngày tạo:</div>
                            <div class="col-sm-8"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-semibold">Cập nhật:</div>
                            <div class="col-sm-8"><?php echo e($order->updated_at->format('d/m/Y H:i')); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 fw-semibold">Ghi chú:</div>
                            <div class="col-sm-8"><?php echo e($order->note ?? 'Không có ghi chú'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-boxes me-2"></i>Sản phẩm trong đơn hàng
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $lineTotal = $item->price * $item->quantity;
                                    $total += $lineTotal;
                                ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($item->product && $item->product->image): ?>
                                                <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>"
                                                    alt="<?php echo e($item->product->proname); ?>" class="rounded me-3"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-box text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-semibold">
                                                    <?php echo e(optional($item->product)->proname ?? 'Sản phẩm không tồn tại'); ?>

                                                </div>
                                                <small class="text-muted">SKU:
                                                    <?php echo e(optional($item->product)->sku ?? 'N/A'); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo e($item->quantity); ?></td>
                                    <td class="text-end"><?php echo e(number_format($item->price, 0, ',', '.')); ?> đ</td>
                                    <td class="text-end fw-semibold"><?php echo e(number_format($lineTotal, 0, ',', '.')); ?> đ</td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-end fw-bold text-primary fs-5"><?php echo e(number_format($total, 0, ',', '.')); ?> đ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="<?php echo e(route('ad.orders.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
            <button class="btn btn-warning" onclick="editOrder(<?php echo e($order->id); ?>)">
                <i class="fas fa-edit me-2"></i>Cập nhật trạng thái
            </button>
            <button class="btn btn-danger"
                onclick="confirmDelete(<?php echo e($order->id); ?>, 'Đơn hàng #<?php echo e($order->id); ?>')">
                <i class="fas fa-trash me-2"></i>Hủy đơn hàng
            </button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function editOrder(id) {
            alert('Chức năng cập nhật đơn hàng #' + id);
        }

        function confirmDelete(id, name) {
            if (confirm(`Bạn có chắc muốn hủy ${name}?`)) {
                alert('Đã hủy: ' + name);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\orders\show.blade.php ENDPATH**/ ?>