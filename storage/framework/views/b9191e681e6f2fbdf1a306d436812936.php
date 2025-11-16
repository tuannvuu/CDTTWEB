<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($product->proname); ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">


</head>

<body>
    

    <?php $__env->startSection('content'); ?>
        <section class="product-section">
            <div class="container">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('homepage')); ?>">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->proname); ?></li>
                    </ol>
                </nav>

                <div class="row">
                    <!-- Cột trái: hình ảnh sản phẩm -->
                    <div class="col-lg-6 mb-4">
                        <div class="product-image-container">
                            <img class="product-image" src="<?php echo e(asset('storage/products/' . $product->fileName)); ?>"
                                alt="<?php echo e($product->proname); ?>" />
                        </div>
                    </div>

                    <!-- Cột phải: thông tin sản phẩm -->
                    <div class="col-lg-6">
                        <div class="product-info-card">
                            <span class="badge-category">Sản phẩm nổi bật</span>
                            <h1 class="product-title"><?php echo e($product->proname); ?></h1>

                            <div class="rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-count">(4.5 / 128 đánh giá)</span>
                            </div>

                            <div class="product-price"><?php echo e(number_format($product->price)); ?>đ</div>

                            <div class="product-meta">
                                <div class="meta-item">
                                    <div class="meta-icon">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <strong>Tình trạng:</strong>
                                        <span class="text-success">Còn hàng</span>
                                    </div>
                                </div>
                                <div class="meta-item">
                                    <div class="meta-icon">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div>
                                        <strong>Mã sản phẩm:</strong> SP<?php echo e(str_pad($product->id, 4, '0', STR_PAD_LEFT)); ?>

                                    </div>
                                </div>
                                <div class="meta-item">
                                    <div class="meta-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div>
                                        <strong>Giao hàng:</strong> Miễn phí cho đơn từ 500.000đ
                                    </div>
                                </div>
                            </div>

                            <div class="product-description">
                                <p><?php echo e($product->description); ?></p>
                            </div>

                            <div class="quantity-selector">
                                <label class="me-3"><strong>Số lượng:</strong></label>
                                <div class="d-flex">
                                    <button class="quantity-btn" type="button" id="decrease-qty">-</button>
                                    <input type="number" class="quantity-input" id="product-quantity" value="1"
                                        min="1" max="10">
                                    <button class="quantity-btn" type="button" id="increase-qty">+</button>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <form action="<?php echo e(route('cartadd', $product->id)); ?>" method="POST" class="d-inline-flex">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="quantity" id="form-quantity" value="1">
                                    <button type="submit" class="btn btn-danger">
    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
</button>

                                </form>

                                <button class="btn btn-wishlist">
                                    <i class="far fa-heart"></i> Yêu thích
                                </button>
                            </div>

                            <div class="social-share">
                                <div class="share-title">Chia sẻ sản phẩm:</div>
                                <div class="share-buttons">
                                    <a href="#" class="share-btn facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="share-btn twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="share-btn pinterest">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                    <a href="#" class="share-btn whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin bổ sung -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="product-info-card">
                            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab">Mô tả sản
                                        phẩm</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs"
                                        type="button" role="tab">Thông số kỹ thuật</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews" type="button" role="tab">Đánh giá</button>
                                </li>
                            </ul>

                            <div class="tab-content p-3" id="productTabsContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <p><?php echo e($product->description); ?></p>
                                    <div class="product-features">
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div>Chất liệu cao cấp, bền đẹp theo thời gian</div>
                                        </div>
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div>Thiết kế hiện đại, phù hợp với mọi không gian</div>
                                        </div>
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div>Dễ dàng vệ sinh và bảo quản</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="specs" role="tabpanel">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><strong>Thương hiệu</strong></td>
                                                <td>BrandX</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Xuất xứ</strong></td>
                                                <td>Việt Nam</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Chất liệu</strong></td>
                                                <td>Nhựa ABS cao cấp</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Kích thước</strong></td>
                                                <td>30 x 20 x 15 cm</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Trọng lượng</strong></td>
                                                <td>0.5 kg</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-4">
                                            <div class="h2 mb-0">4.5/5</div>
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <div class="text-muted small">128 đánh giá</div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="me-2">5 sao</span>
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                                </div>
                                                <span class="ms-2">70%</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="me-2">4 sao</span>
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    <div class="progress-bar bg-warning" style="width: 20%"></div>
                                                </div>
                                                <span class="ms-2">20%</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="me-2">3 sao</span>
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    <div class="progress-bar bg-warning" style="width: 7%"></div>
                                                </div>
                                                <span class="ms-2">7%</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">1-2 sao</span>
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    <div class="progress-bar bg-warning" style="width: 3%"></div>
                                                </div>
                                                <span class="ms-2">3%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary">
                                        <i class="fas fa-pen me-2"></i>Viết đánh giá
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php $__env->stopSection(); ?>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('product-quantity');
            const formQuantity = document.getElementById('form-quantity');
            const decreaseBtn = document.getElementById('decrease-qty');
            const increaseBtn = document.getElementById('increase-qty');

            // Cập nhật số lượng trong form khi thay đổi
            quantityInput.addEventListener('change', function() {
                formQuantity.value = this.value;
            });

            // Giảm số lượng
            decreaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    formQuantity.value = quantityInput.value;
                }
            });

            // Tăng số lượng
            increaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < 10) {
                    quantityInput.value = currentValue + 1;
                    formQuantity.value = quantityInput.value;
                }
            });
        });
    </script>
</body>

</html>

<?php echo $__env->make('layout.productdetails', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/client/products/detail.blade.php ENDPATH**/ ?>