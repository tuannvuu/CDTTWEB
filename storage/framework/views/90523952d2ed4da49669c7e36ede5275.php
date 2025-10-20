

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary mb-3">🏢 Thương Hiệu Nổi Bật</h1>
            <p class="lead text-muted">Khám phá các thương hiệu công nghệ hàng đầu với chất lượng và uy tín được đảm bảo</p>
        </div>

        <!-- Brands Grid -->
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card brand-card h-100 border-0 shadow-sm">
                        <!-- Brand Logo/Image -->
                        <div class="brand-image-container position-relative">
                            <div class="brand-image-placeholder">
                             <img src="<?php echo e(asset('storage/brands/' . $brand->image)); ?>" 
     alt="<?php echo e($brand->brandname); ?>" class="img-fluid" style="max-height:80px;">

                            </div>
                            <div class="brand-overlay">
                                <a href="<?php echo e(route('client.brands.show', $brand->id)); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i> Khám phá
                                </a>
                            </div>
                        </div>

                        <!-- Brand Info -->
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-dark mb-2"><?php echo e($brand->brandname); ?></h5>

                            <?php if($brand->description): ?>
                                <p class="card-text text-muted small line-clamp-2 mb-3">
                                    <?php echo e(Str::limit($brand->description, 120)); ?>

                                </p>
                            <?php endif; ?>

                            <!-- Brand Stats -->
                            <div class="brand-stats d-flex justify-content-center gap-3 text-center mb-3">
                                <div>
                                    <div class="fw-bold text-primary"><?php echo e(rand(1, 7)); ?></div>
                                    <small class="text-muted">Sản phẩm</small>
                                </div>

                                <div>
                                    <div class="fw-bold text-success">4.8</div>
                                    <small class="text-muted">Đánh giá</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <!-- Empty State -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="empty-state-icon mb-4">
                            <i class="bi bi-building display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">Chưa có thương hiệu nào</h4>
                        <p class="text-muted mb-4">Các thương hiệu sẽ được cập nhật sớm nhất</p>
                        <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại trang sản phẩm
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($brands->hasPages()): ?>
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Brands pagination">
                    <?php echo e($brands->links('pagination::bootstrap-5')); ?>

                </nav>
            </div>
        <?php endif; ?>
    </div>

    <style>
        .brand-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }

        .brand-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .brand-image-container {
            height: 160px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .brand-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo {
            max-height: 80px;
            max-width: 80%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .brand-card:hover .brand-logo {
            transform: scale(1.1);
        }

        .brand-initials {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border-radius: 50%;
            font-size: 1.5rem;
            font-weight: bold;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .brand-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(37, 99, 235, 0.9), rgba(29, 78, 216, 0.8));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .brand-card:hover .brand-overlay {
            opacity: 1;
        }

        .brand-overlay .btn {
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .brand-card:hover .brand-overlay .btn {
            transform: translateY(0);
        }

        .brand-stats {
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .empty-state-icon {
            opacity: 0.6;
        }

        .pagination .page-link {
            border-radius: 10px;
            margin: 0 3px;
            border: 1px solid #dee2e6;
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-color: #2563eb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-image-container {
                height: 140px;
            }

            .brand-initials {
                width: 60px;
                height: 60px;
                font-size: 1.2rem;
            }
        }
    </style>

    <script>
        // Add smooth hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const brandCards = document.querySelectorAll('.brand-card');

            brandCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '10';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = '1';
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.productdetails', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\brands\index.blade.php ENDPATH**/ ?>