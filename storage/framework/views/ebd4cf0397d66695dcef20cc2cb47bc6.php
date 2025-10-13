

<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center mb-3 fw-bold text-primary">🚀 Sản Phẩm Mới Nhất 🚀</h2>
                <p class="text-center text-muted">Khám phá những sản phẩm công nghệ mới nhất với thiết kế hiện đại và tính
                    năng vượt trội</p>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card product-card h-100 border-0 shadow-sm">
                        <!-- Product Image -->
                        <div class="position-relative overflow-hidden">
                        <img class="product-image" src="<?php echo e(asset('storage/products/' . $product->fileName)); ?>"
                        alt="<?php echo e($product->proname); ?>" />

                            <!-- Badge New -->
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-danger">MỚI</span>
                            </div>

                            <!-- Hover Overlay -->
                            <div class="card-img-overlay d-flex align-items-end justify-content-center product-overlay">
                                <a href="<?php echo e(route('client.products.detail', $product->id)); ?>"
                                    class="btn btn-primary btn-sm opacity-0 translate-y-100">
                                    <i class="bi bi-eye me-1"></i> Xem nhanh
                                </a>
                            </div>
                        </div>

                        <!-- Product Body -->
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold text-dark mb-2 line-clamp-2" style="min-height: 48px;">
                                <?php echo e($product->proname); ?>

                            </h6>

                            <!-- Price -->
                            <div class="mb-2">
                                <span class="h5 text-danger fw-bold">
                                    <?php echo e(number_format($product->price, 0, ',', '.')); ?> đ
                                </span>
                                <?php if($product->old_price): ?>
                                    <span class="text-muted text-decoration-line-through ms-2">
                                        <?php echo e(number_format($product->old_price, 0, ',', '.')); ?> đ
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Short Description -->
                            <?php if($product->short_description): ?>
                                <p class="card-text text-muted small mb-3 line-clamp-2">
                                    <?php echo e($product->short_description); ?>

                                </p>
                            <?php endif; ?>

                            <!-- Rating (if available) -->
                            <?php if($product->rating): ?>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="text-warning small">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi bi-star<?php echo e($i <= $product->rating ? '-fill' : ''); ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <small class="text-muted ms-2">(<?php echo e($product->review_count ?? 0); ?>)</small>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Action Buttons -->
                            <div class="mt-auto">
                                <div class="d-grid gap-2">
                                    <a href="<?php echo e(route('client.products.detail', $product->id)); ?>"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i> Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <!-- Empty State -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inboxes display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">Chưa có sản phẩm mới nào</h4>
                        <p class="text-muted mb-4">Các sản phẩm mới sẽ được cập nhật sớm nhất</p>
                        <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-primary">
                            <i class="bi bi-grid me-1"></i> Xem tất cả sản phẩm
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($products->hasPages()): ?>
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <?php echo e($products->links('pagination::bootstrap-5')); ?>

                </nav>
            </div>
        <?php endif; ?>
    </div>

    

    <script>
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const btn = this;

                // Hiệu ứng khi click
                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Đã thêm';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-secondary');

                // Gửi request AJAX để thêm vào giỏ hàng
                fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật số lượng trong giỏ hàng
                            updateCartCount(data.cart_count);
                        } else {
                            alert(data.message || "Có lỗi xảy ra");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Khôi phục trạng thái nút
                        btn.innerHTML = '<i class="bi bi-cart-plus me-1"></i> Thêm giỏ hàng';
                        btn.classList.remove('btn-secondary');
                        btn.classList.add('btn-success');
                    });
            });
        });

        function updateCartCount(count) {
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = count;
            }
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\c#+CĐTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/client/products/new.blade.php ENDPATH**/ ?>