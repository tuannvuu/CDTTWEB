<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Đồ điện tử chính hãng</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <link href="<?php echo e(asset('css/header.css')); ?>" rel="stylesheet">


</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo & Category -->
            <div class="d-flex align-items-center">
                <?php if (isset($component)) { $__componentOriginalc627613da392b6661ba1022ec8b8c5f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc627613da392b6661ba1022ec8b8c5f3 = $attributes; } ?>
<?php $component = App\View\Components\CategoryMenu::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('category-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CategoryMenu::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc627613da392b6661ba1022ec8b8c5f3)): ?>
<?php $attributes = $__attributesOriginalc627613da392b6661ba1022ec8b8c5f3; ?>
<?php unset($__attributesOriginalc627613da392b6661ba1022ec8b8c5f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc627613da392b6661ba1022ec8b8c5f3)): ?>
<?php $component = $__componentOriginalc627613da392b6661ba1022ec8b8c5f3; ?>
<?php unset($__componentOriginalc627613da392b6661ba1022ec8b8c5f3); ?>
<?php endif; ?>
                <a class="navbar-brand d-flex align-items-center ms-2" href="<?php echo e(route('homepage')); ?>">
                    <span class="brand-text ms-2">TechStore</span>
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                <ul class="navbar-nav fw-semibold d-flex flex-row gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('promotions.index')); ?>">
                            <i class="bi bi-percent me-1"></i> Khuyến mãi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('products.new')); ?>">
                            <i class="bi bi-star me-1"></i> Sản phẩm mới
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('client.brands.index')); ?>">
                            <i class="bi bi-tags me-1"></i> Thương hiệu
                        </a>
                    </li>
                    <li class="navbar-about-link">
                        <a class="nav-link" href="/about">
                            <i class="bi bi-info-circle me-1"></i> Về chúng tôi
                        </a>
                    </li>
                </ul>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-2 ms-lg-3">
                    <a class="btn btn-light-custom position-relative" href="<?php echo e(route('cartshow')); ?>" title="Giỏ hàng">
                        <i class="bi bi-cart-fill"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                            <?php echo e(session('cart') ? collect(session('cart'))->sum('quantity') : 0); ?>

                        </span>
                    </a>

                    <!-- User Menu -->
                    <div class="dropdown">
                        <a class="btn btn-light rounded-circle dropdown-toggle" href="#" id="userMenu"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if(Auth::check()): ?>
                                
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>">
                                        <i class="bi bi-person-circle"></i>
                                        <?php echo e(Auth::user()->fullname ?? Auth::user()->username); ?>

                                    </a>
                                </li>
                                <li>
                                    <form action="<?php echo e(route('ad.logout')); ?>" method="POST" class="m-0">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            <?php else: ?>
                                
                                <li><a class="dropdown-item" href="<?php echo e(route('ad.login')); ?>">
                                        <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                                    </a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('ad.create')); ?>">
                                        <i class="bi bi-person-plus"></i> Đăng ký
                                    </a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section với Search Form -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">Công Nghệ Mới - Giá Tốt Nhất</h1>
            <p class="hero-subtitle">Khám phá hàng ngàn sản phẩm công nghệ chính hãng với mức giá ưu đãi và chính sách
                bảo hành tốt nhất</p>

            <!-- Search Form -->
            <div class="search-container mt-4">
                <form action="<?php echo e(route('client.products.search')); ?>" method="GET"
                    class="search-form d-flex align-items-center p-2">

                    
                    <div class="search-input-group me-2 flex-grow-1">
                        <input type="search" name="keyword" class="form-control search-input"
                            placeholder="Tìm kiếm sản phẩm, thương hiệu..." required>
                    </div>

                    
                    <button type="submit" class="btn btn-primary-custom search-btn">
                        <i class="bi bi-search me-1"></i> Tìm kiếm
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/partials/header.blade.php ENDPATH**/ ?>