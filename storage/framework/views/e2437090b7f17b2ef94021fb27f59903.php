<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $__env->yieldContent('title', 'TechShop Vietnam'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* Tùy chỉnh style cho footer */
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .nav-link.active {
            font-weight: 600;
            color: #0d6efd !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <i class="bi bi-shop"></i> ModernShop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Chuyển đổi điều hướng">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="<?php echo e(url('/')); ?>" class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>">Trang
                            Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('about')); ?>"
                            class="nav-link <?php echo e(request()->is('about') ? 'active' : ''); ?>">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('about.contact')); ?>"
                            class="nav-link <?php echo e(request()->is('about/contact') ? 'active' : ''); ?>">Liên Hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('message')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle-fill"></i> <?php echo e(session('message')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-1">&copy; <?php echo e(date('Y')); ?> ModernShop Vietnam. Bản quyền thuộc về Tuấn Vũ.</p>
            <small class="text-muted">Địa chỉ: 123 Nguyễn Văn Linh, Quận 7, TP. Hồ Chí Minh</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/layout/app.blade.php ENDPATH**/ ?>