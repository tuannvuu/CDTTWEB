<?php $__env->startSection('title', 'Sản phẩm'); ?>

<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/ad.index.pro.css')); ?>" rel="stylesheet" />

    <div class="container-fluid py-4">
        <div class="header-actions">
            <h3><i class="fas fa-boxes me-2"></i>Quản lý Sản phẩm</h3>
        </div>

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

        <!-- Thống kê -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-1 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number"><?php echo e($list->total()); ?></div>
                                <div class="stat-label">TỔNG SỐ SẢN PHẨM</div>
                            </div>
                            <i class="fas fa-box stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-2 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number"><?php echo e($list->count()); ?></div>
                                <div class="stat-label">HIỂN THỊ TRANG NÀY</div>
                            </div>
                            <i class="fas fa-eye stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number"><?php echo e($list->where('price', '>', 1000000)->count()); ?></div>
                                <div class="stat-label">SẢN PHẨM CAO CẤP</div>
                            </div>
                            <i class="fas fa-crown stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-4 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number">8</div>
                                <div class="stat-label">MỚI THÁNG NÀY</div>
                            </div>
                            <i class="fas fa-calendar-alt stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút thêm sản phẩm -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="h4 mb-0">Danh sách Sản phẩm</h4>
            <a href="<?php echo e(route('ad.pro.create')); ?>" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Thêm sản phẩm
            </a>
        </div>

        <!-- Bảng danh sách -->
        <?php if($list->count() > 0): ?>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Loại</th>
                                <th width="15%">Thương hiệu</th>
                                <th width="20%">Tên sản phẩm</th>
                                <th width="15%">Giá</th>
                                <th width="10%">Ảnh</th>
                                <th width="20%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark"><?php echo e($loop->iteration); ?></span>
                                    </td>
                                    <td>
                                        <span class="category-badge"><?php echo e($item->category->catename ?? 'Chưa có danh mục'); ?></span>

                                    </td>
                                    <td>
                                        <span class="brand-badge"><?php echo e($item->brand->brandname ?? 'Chưa có thương hiệu'); ?></span>

                                    </td>
                                    <td>
                                        <div class="product-name" title="<?php echo e($item->productname); ?>">
                                            <?php echo e($item->productname); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <span class="price"><?php echo e(number_format($item->price, 0, ',', '.')); ?> ₫</span>
                                    </td>
       <td>
   <?php
    $imagePath = $item->fileName;
    if ($imagePath && !Str::startsWith($imagePath, 'products/')) {
        $imagePath = 'products/' . $imagePath;
    }
?>

<img src="<?php echo e(asset('storage/' . $imagePath)); ?>"
     alt="<?php echo e($item->proname); ?>"
     style="max-height:100px; object-fit:contain;">

</td>




                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?php echo e(route('ad.pro.edit', $item->id)); ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i>Sửa
                                            </a>
                                          <form action="<?php echo e(route('ad.pro.delete', $item->id)); ?>" method="POST"
    onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-sm btn-danger">
        <i class="fas fa-trash me-1"></i>Xóa
    </button>
</form>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <?php echo e($list->links('pagination::bootstrap-4')); ?>

                </nav>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>Chưa có sản phẩm nào</h3>
                    <p class="mb-4">Hãy thêm sản phẩm đầu tiên để bắt đầu quản lý</p>
                    <a href="<?php echo e(route('ad.pro.create')); ?>" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/admin/products/index.blade.php ENDPATH**/ ?>