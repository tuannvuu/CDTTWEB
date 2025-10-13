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
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --accent-color: #f59e0b;
            --accent-hover: #d97706;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --gray-light: #e2e8f0;
            --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            padding: 0;
            margin: 0;
            line-height: 1.6;
        }

        /* ===================== NAVBAR ENHANCEMENTS ===================== */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-light);
            padding: 0.7rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-1px);
        }

        .logo-img {
            height: 48px;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.15));
            transition: all 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 12px rgba(59, 130, 246, 0.3));
        }

        .brand-text {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(59, 130, 246, 0.1);
        }

        .nav-link {
            color: var(--dark-color) !important;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0.7rem 1.2rem !important;
            border-radius: 12px;
            margin: 0 3px;
            position: relative;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(59, 130, 246, 0.04));
            transform: translateY(-2px);
            border-color: rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(59, 130, 246, 0.06));
            border-color: rgba(59, 130, 246, 0.2);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        }

        .nav-link i {
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.1);
        }

        /* ===================== CATEGORY MENU FIX - POSITION BELOW BUTTON ===================== */
        .btn-menu-cate {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            color: white !important;
            font-weight: 600;
            padding: 0.6rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
        }

        .btn-menu-cate:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.4);
            color: white !important;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
        }

        .btn-menu-cate i {
            font-size: 1.5rem;
            margin: 0;
            color: white !important;
        }

        .custom-category-dropdown {
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            border: none;
            padding: 1rem;
            margin-top: 0.5rem !important;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.8);
            min-width: 300px;
            animation: dropdownFadeIn 0.3s ease;
            position: absolute;
            top: 100%;
            left: 0;
            transform: translateX(0) !important;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .category-icon {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 12px;
            background: #f8fafc;
            padding: 8px;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover .category-icon {
            border-color: var(--primary-color);
            transform: scale(1.05);
            background: white;
        }

        .category-name {
            font-weight: 600;
            color: var(--dark-color);
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .dropdown-item {
            padding: 1rem 1.2rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            border: 1px solid transparent;
            gap: 1rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
            transform: translateX(8px) translateY(-1px);
            color: var(--primary-color);
            border-color: rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .dropdown-item:hover .category-name {
            color: var(--primary-color);
            font-weight: 700;
        }

        /* ===================== NAVBAR ABOUT LINK FIX ===================== */
        .navbar-about-link {
            list-style: none;
            margin: 0;
        }

        .navbar-about-link .nav-link {
            color: var(--dark-color) !important;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0.7rem 1.2rem !important;
            border-radius: 12px;
            margin: 0 3px;
            border: 1px solid transparent;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-about-link .nav-link:hover {
            color: var(--primary-color) !important;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(59, 130, 246, 0.04));
            transform: translateY(-2px);
            border-color: rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        /* ===================== USER DROPDOWN ENHANCEMENTS ===================== */
        .dropdown-menu {
            border-radius: 16px;
            box-shadow: var(--shadow-medium);
            border: none;
            padding: 0.8rem;
            margin-top: 0.5rem;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            min-width: 220px;
        }

        .dropdown-item {
            padding: 0.8rem 1rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
            transform: translateX(5px);
            color: var(--primary-color);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* ===================== BUTTON ENHANCEMENTS ===================== */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.85rem 2rem;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.5);
            color: white;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        }

        .btn-primary-custom:active {
            transform: translateY(-1px) scale(0.98);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.75rem 1.75rem;
            border-radius: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }

        .btn-accent:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.5);
            color: white;
        }

        .btn-light-custom {
            background: rgba(255, 255, 255, 0.9);
            border: 1.5px solid rgba(226, 232, 240, 0.8);
            color: var(--dark-color);
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0.6rem;
            backdrop-filter: blur(10px);
        }

        .btn-light-custom:hover {
            background: white;
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow-light);
            border-color: rgba(59, 130, 246, 0.3);
        }

        .cart-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.5rem;
            font-weight: 700;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* ===================== SEARCH FORM ENHANCEMENTS ===================== */
        .search-container {
            position: relative;
            max-width: 650px;
            margin: 0 auto;
        }

        .search-form {
            background: #ffffff;
            border-radius: 20px;
            padding: 0.6rem;
            box-shadow: var(--shadow-medium);
            border: 1.5px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .search-form:focus-within {
            box-shadow: 0 12px 40px rgba(59, 130, 246, 0.15);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .search-input-group {
            position: relative;
            flex-grow: 1;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            z-index: 5;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .search-form:focus-within .search-icon {
            transform: translateY(-50%) scale(1.1);
            color: var(--primary-light);
        }

        .search-input {
            border: 2px solid #e5e7eb;
            padding: 0.9rem 1.2rem 0.9rem 3.2rem;
            border-radius: 14px;
            background: #f9fafb;
            font-weight: 600;
            color: #111827;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            font-size: 1rem;
        }

        .search-input:focus {
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        .search-category {
            min-width: 170px;
            border: 2px solid #d1d5db;
            background: #f9fafb;
            border-radius: 14px;
            padding: 0.9rem 1.2rem;
            font-weight: 600;
            margin-right: 0.6rem;
            color: #1f2937;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .search-category:focus {
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
            border-color: var(--primary-color);
        }

        .search-btn {
            border-radius: 14px;
            padding: 0.9rem 2rem;
            font-weight: 700;
            white-space: nowrap;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            color: #ffffff;
            border: none;
            box-shadow: 0 6px 20px rgba(96, 165, 250, 0.4);
            font-size: 1rem;
        }

        .search-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 30px rgba(96, 165, 250, 0.5);
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }

        .search-btn:active {
            transform: translateY(-1px) scale(0.98);
        }

        /* ===================== HERO SECTION ENHANCEMENTS ===================== */
        .hero-section {
            padding: 5rem 0;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            color: #1f2937;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(59, 130, 246, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(245, 158, 11, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
            letter-spacing: -1px;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            color: #4b5563;
            font-weight: 500;
            line-height: 1.6;
        }

        /* ===================== RESPONSIVE ENHANCEMENTS ===================== */
        @media (max-width: 991.98px) {
            .navbar-nav {
                padding: 1.2rem 0;
            }

            .nav-link {
                padding: 0.8rem 1.2rem !important;
                margin: 0.2rem 0;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-section {
                padding: 4rem 0;
            }

            .custom-category-dropdown {
                min-width: 280px;
            }
        }

        @media (max-width: 767.98px) {
            .search-category {
                min-width: 150px;
                margin-bottom: 0.5rem;
                margin-right: 0;
            }

            .search-form {
                flex-direction: column;
                gap: 0.5rem;
            }

            .search-input-group {
                margin-right: 0 !important;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                padding: 0 1rem;
            }

            .btn-light-custom {
                padding: 0.5rem;
            }

            .btn-menu-cate {
                width: 45px;
                height: 45px;
                padding: 0.5rem;
            }

            .custom-category-dropdown {
                min-width: 260px;
                left: 0;
                transform: translateX(0) !important;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-brand {
                margin-right: 0.5rem;
            }

            .logo-img {
                height: 40px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-section {
                padding: 3rem 0;
            }

            .category-icon {
                width: 50px;
                height: 50px;
            }

            .dropdown-item {
                padding: 0.8rem 1rem;
                gap: 0.8rem;
            }

            .btn-menu-cate {
                width: 42px;
                height: 42px;
            }

            .btn-menu-cate i {
                font-size: 1.3rem;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>

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
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\partials\header.blade.php ENDPATH**/ ?>