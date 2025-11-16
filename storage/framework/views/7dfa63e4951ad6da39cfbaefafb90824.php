

<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(asset('css/inventory.css')); ?>" rel="stylesheet" />
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title mb-2">
                        <i class="bi bi-box-seam me-2"></i>Quản lý tồn kho
                    </h1>
                    <p class="page-subtitle text-muted mb-0">Theo dõi và quản lý số lượng sản phẩm trong kho</p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end gap-2">
                        <div class="search-box flex-grow-1">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary d-flex align-items-center">
                            <i class="bi bi-plus-circle me-1"></i> Thêm sản phẩm
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <?php
                $totalProducts = $products->total();
                $highStock = $products->where('stock_quantity', '>', 50)->count();
                $mediumStock = $products->whereBetween('stock_quantity', [10, 50])->count();
                $lowStock = $products->where('stock_quantity', '<', 10)->count();
            ?>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Tổng sản phẩm</h5>
                                <h2 class="text-primary mb-0"><?php echo e($totalProducts); ?></h2>
                            </div>
                            <div class="stat-icon bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-box text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Tồn kho cao</h5>
                                <h2 class="text-success mb-0"><?php echo e($highStock); ?></h2>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Tồn kho trung bình</h5>
                                <h2 class="text-warning mb-0"><?php echo e($mediumStock); ?></h2>
                            </div>
                            <div class="stat-icon bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-exclamation-circle text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Sắp hết hàng</h5>
                                <h2 class="text-danger mb-0"><?php echo e($lowStock); ?></h2>
                            </div>
                            <div class="stat-icon bg-danger bg-opacity-10 p-3 rounded">
                                <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Products Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="80" class="ps-4">ID</th>
                                <th>Tên sản phẩm</th>
                                <th width="150" class="text-end">Giá</th>
                                <th width="180">Số lượng tồn</th>
                                <th width="120" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">#<?php echo e($product->id); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="product-icon bg-light rounded p-2 me-3">
                                                    <i class="bi bi-box text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-medium"><?php echo e($product->proname); ?></div>
                                                <div class="text-muted small">SKU:
                                                    PROD<?php echo e(str_pad($product->id, 4, '0', STR_PAD_LEFT)); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end fw-semibold"><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-semibold"><?php echo e($product->stock_quantity); ?></span>
                                            <?php if($product->stock_quantity > 50): ?>
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Tồn kho cao
                                                </span>
                                            <?php elseif($product->stock_quantity >= 10): ?>
                                                <span
                                                    class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                    <i class="bi bi-exclamation-circle me-1"></i>
                                                    Tồn kho trung bình
                                                </span>
                                            <?php elseif($product->stock_quantity > 0): ?>
                                                <span
                                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                                    Sắp hết hàng
                                                </span>
                                            <?php else: ?>
                                                <span
                                                    class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Hết hàng
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                title="Xem chi tiết">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                title="Chỉnh sửa">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-muted">
                                Hiển thị <?php echo e($products->firstItem() ?? 0); ?> - <?php echo e($products->lastItem() ?? 0); ?> của
                                <?php echo e($products->total()); ?> sản phẩm
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Pagination Links -->
                            <?php if($products->hasPages()): ?>
                                <nav aria-label="Page navigation" class="d-flex justify-content-end">
                                    <ul class="pagination mb-0">
                                        <!-- Previous Page Link -->
                                        <?php if($products->onFirstPage()): ?>
                                            <li class="page-item disabled">
                                                <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                                            </li>
                                        <?php else: ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo e($products->previousPageUrl()); ?>"
                                                    aria-label="Previous">
                                                    <i class="bi bi-chevron-left"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <!-- Pagination Elements -->
                                        <?php $__currentLoopData = range(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($i == $products->currentPage()): ?>
                                                <li class="page-item active"><span
                                                        class="page-link"><?php echo e($i); ?></span></li>
                                            <?php else: ?>
                                                <li class="page-item"><a class="page-link"
                                                        href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Next Page Link -->
                                        <?php if($products->hasMorePages()): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo e($products->nextPageUrl()); ?>"
                                                    aria-label="Next">
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                        <?php else: ?>
                                            <li class="page-item disabled">
                                                <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/admin/inventory/index.blade.php ENDPATH**/ ?>