<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thương hiệu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/list.brands.css')); ?>">
</head>

<body>
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title">
                        <i class="fas fa-tags me-3"></i>Quản lý Thương hiệu
                    </h1>
                    <p class="page-subtitle">Quản lý danh sách thương hiệu sản phẩm trong hệ thống</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?php echo e(route('ad.brand.create')); ?>" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Thêm Thương hiệu
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e(count($list)); ?></div>
                    <div class="stats-label">Tổng số thương hiệu</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e(count($list)); ?></div>
                    <div class="stats-label">Đang hoạt động</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">0</div>
                    <div class="stats-label">Đã ẩn</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e(count($list)); ?></div>
                    <div class="stats-label">Mới tháng này</div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-list me-2"></i>Danh sách Thương hiệu</h3>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Mô tả</th>
                            <th width="180" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($list) > 0): ?>
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center text-muted fw-bold"><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <span class="brand-name">
                                            <i class="fas fa-tag text-primary me-2"></i><?php echo e($item->brandname); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="description-cell" title="<?php echo e($item->description); ?>">
                                            <?php echo e($item->description ?: 'Chưa có mô tả'); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?php echo e(route('ad.brand.edit', $item->id)); ?>"
                                                class="btn btn-action btn-edit" title="Sửa thương hiệu">
                                                <i class="fas fa-edit me-1"></i>Sửa
                                            </a>
                                            <form action="<?php echo e(route('ad.brand.delete', $item->id)); ?>" method="POST"
                                                class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-action btn-delete"
                                                    onclick="return confirm('Bạn có chắc muốn xóa <?php echo e($item->brandname); ?>?')"
                                                    title="Xóa thương hiệu">
                                                    <i class="fas fa-trash me-1"></i>Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open"></i>
                                        <h5>Chưa có thương hiệu nào</h5>
                                        <p class="mb-3">Hãy thêm thương hiệu đầu tiên để bắt đầu quản lý</p>
                                        <a href="<?php echo e(route('brand.create')); ?>" class="btn btn-primary-custom">
                                            <i class="fas fa-plus me-2"></i>Thêm thương hiệu đầu tiên
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php if(count($list) > 0): ?>
            <div class="pagination-container">
                <?php echo e($list->links('pagination::bootstrap-5')); ?>

            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Thêm hiệu ứng loading khi click các nút
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-action, .btn-primary-custom');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.type !== 'submit') {
                        this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang xử lý...';
                        this.disabled = true;
                    }
                });
            });

            // Hiệu ứng hover cho các hàng trong bảng
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.transition = 'transform 0.3s ease';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>

</html>
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\brands\list.blade.php ENDPATH**/ ?>