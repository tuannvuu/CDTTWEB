

<?php $__env->startSection('content'); ?>
   
<link href="<?php echo e(asset('css/inventory.css')); ?>" rel="stylesheet" />
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-box-seam me-2"></i>Quản lý tồn kho
                    </h1>
                    <p class="page-subtitle">Theo dõi và quản lý số lượng sản phẩm trong kho</p>
                </div>
                <div class="search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <?php
                $totalProducts = $products->total();
                $highStock = $products->where('stock_quantity', '>', 50)->count();
                $mediumStock = $products->whereBetween('stock_quantity', [10, 50])->count();
                $lowStock = $products->where('stock_quantity', '<', 10)->count();
            ?>

            <div class="stat-card">
                <div class="stat-number"><?php echo e($totalProducts); ?></div>
                <div class="stat-label">Tổng sản phẩm</div>
            </div>
            <div class="stat-card success">
                <div class="stat-number"><?php echo e($highStock); ?></div>
                <div class="stat-label">Sản phẩm tồn kho cao</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-number"><?php echo e($mediumStock); ?></div>
                <div class="stat-label">Sản phẩm tồn kho trung bình</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-number"><?php echo e($lowStock); ?></div>
                <div class="stat-label">Sản phẩm sắp hết hàng</div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="inventory-table">
            <div class="table-header">
                <h2 class="table-title">Danh sách sản phẩm</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th>Tên sản phẩm</th>
                            <th width="150">Giá</th>
                            <th width="180">Số lượng tồn</th>
                            <th width="120">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="fw-bold text-primary">#<?php echo e($product->id); ?></td>
                                <td>
                                    <div class="product-info">
                                        <div class="product-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                        <div class="product-details">
                                            <div class="name"><?php echo e($product->proname); ?></div>
                                            <div class="sku">SKU: PROD<?php echo e(str_pad($product->id, 4, '0', STR_PAD_LEFT)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="price-column"><?php echo e(number_format($product->price, 0, ',', '.')); ?>₫</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-semibold"><?php echo e($product->stock_quantity); ?></span>
                                        <?php if($product->stock_quantity > 50): ?>
                                            <span class="stock-status stock-high">
                                                <i class="bi bi-check-circle"></i>
                                                Tồn kho cao
                                            </span>
                                        <?php elseif($product->stock_quantity >= 10): ?>
                                            <span class="stock-status stock-medium">
                                                <i class="bi bi-exclamation-circle"></i>
                                                Tồn kho trung bình
                                            </span>
                                        <?php elseif($product->stock_quantity > 0): ?>
                                            <span class="stock-status stock-low">
                                                <i class="bi bi-exclamation-triangle"></i>
                                                Sắp hết hàng
                                            </span>
                                        <?php else: ?>
                                            <span class="stock-status stock-out">
                                                <i class="bi bi-x-circle"></i>
                                                Hết hàng
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="#" class="btn-action" title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="#" class="btn-action" title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" class="btn-action" title="Nhập hàng">
                                            <i class="bi bi-plus-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="page-info">
                    Hiển thị <?php echo e($products->firstItem() ?? 0); ?> - <?php echo e($products->lastItem() ?? 0); ?> của
                    <?php echo e($products->total()); ?> sản phẩm
                </div>

                <!-- Pagination Links -->
                <?php if($products->hasPages()): ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <!-- Previous Page Link -->
                            <?php if($products->onFirstPage()): ?>
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo e($products->previousPageUrl()); ?>" aria-label="Previous">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <!-- Pagination Elements -->
                            <?php $__currentLoopData = range(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($i == $products->currentPage()): ?>
                                    <li class="page-item active"><span class="page-link"><?php echo e($i); ?></span></li>
                                <?php else: ?>
                                    <li class="page-item"><a class="page-link"
                                            href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- Next Page Link -->
                            <?php if($products->hasMorePages()): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo e($products->nextPageUrl()); ?>" aria-label="Next">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\inventory\index.blade.php ENDPATH**/ ?>