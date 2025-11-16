

<?php $__env->startSection('title', 'Quản lý Danh mục'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header bg-gradient-primary rounded-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title text-white mb-2">
                        <i class="fas fa-folder-tree me-3"></i>Quản lý Danh mục
                    </h1>
                    <p class="page-subtitle text-white-50 mb-0">Quản lý danh mục sản phẩm và sản phẩm trong hệ thống</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="<?php echo e(route('ad.cate.create')); ?>" class="btn btn-light btn-lg shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Thêm Danh mục
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert -->
        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e($list->total()); ?></div>
                    <div class="stats-label">Tổng số danh mục</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e($list->total()); ?></div>
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
                    <div class="stats-number"><?php echo e($list->total()); ?></div>
                    <div class="stats-label">Mới tháng này</div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-list me-2"></i>Danh sách Danh mục</h3>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">STT</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th width="200" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($list) > 0): ?>
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="position-relative">
                                    <td class="text-center fw-bold text-primary"><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-warning me-2 fs-5"></i>
                                            <div>
                                                <div class="fw-semibold text-dark"><?php echo e($item->catename); ?></div>
                                                <small class="text-muted"><?php echo e($item->products->count()); ?> sản phẩm</small>
                                            </div>
                                            <button class="btn btn-sm btn-outline-secondary ms-auto"
                                                data-bs-toggle="collapse" data-bs-target="#r<?php echo e($loop->index); ?>"
                                                aria-expanded="false" aria-controls="r<?php echo e($loop->index); ?>">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 300px;"
                                            title="<?php echo e($item->description); ?>">
                                            <?php echo e($item->description ?: 'Chưa có mô tả'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?php echo e(route('ad.cate.edit', $item->cateid)); ?>"
                                                class="btn btn-warning btn-sm px-3 py-2 rounded-pill" title="Sửa danh mục">
                                                <i class="fas fa-edit me-1"></i>Sửa
                                            </a>
                                         <form action="<?php echo e(route('ad.cate.delete', $item->cateid)); ?>" method="POST" class="d-inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger btn-sm px-3 py-2 rounded-pill"
        onclick="return confirm('Bạn có chắc muốn xóa danh mục <?php echo e($item->catename); ?>?')">
        <i class="fas fa-trash me-1"></i>Xóa
    </button>
</form>


                                        </div>
                                    </td>
                                </tr>
                                <tr id="r<?php echo e($loop->index); ?>" class="collapse">
                                    <td colspan="4" class="bg-light">
                                        <div class="p-3">
                                            <h6 class="fw-semibold mb-3 text-primary">
                                                <i class="fas fa-boxes me-2"></i>Danh sách sản phẩm trong
                                                "<?php echo e($item->catename); ?>"
                                            </h6>
                                            <?php if($item->products->count() > 0): ?>
                                                <div class="row g-2">
                                                    <?php $__currentLoopData = $item->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-6 col-lg-4">
                                                            <div
                                                                class="bg-white rounded p-2 border d-flex align-items-center">
                                                                <i class="fas fa-cube text-success me-2"></i>
                                                                <span class="text-truncate"><?php echo e($pro->proname); ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-center py-4 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                                    <p class="mb-0">Không có sản phẩm nào trong danh mục này</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-folder-open"></i>
                                        <h5>Chưa có danh mục nào</h5>
                                        <p class="mb-3">Hãy thêm danh mục đầu tiên để bắt đầu quản lý</p>
                                        <a href="<?php echo e(route('cate.create')); ?>" class="btn btn-primary-custom">
                                            <i class="fas fa-plus me-2"></i>Thêm danh mục đầu tiên
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
        <?php if($list->hasPages()): ?>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị <?php echo e($list->firstItem()); ?> - <?php echo e($list->lastItem()); ?> của <?php echo e($list->total()); ?> kết quả
                </div>
                <nav>
                    <?php echo e($list->links('pagination::bootstrap-5')); ?>

                </nav>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/category.css')); ?>">


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hiệu ứng toggle button
            const toggleButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (this.getAttribute('aria-expanded') === 'true') {
                        icon.className = 'fas fa-chevron-down';
                    } else {
                        icon.className = 'fas fa-chevron-up';
                    }
                });
            });

            // Hiệu ứng loading khi xóa
            const deleteForms = document.querySelectorAll('form[action*="delete"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang xóa...';
                    button.disabled = true;
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>