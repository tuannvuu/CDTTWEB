<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center text-white py-4">
                        <h4><i class="fas fa-tachometer-alt me-2"></i>My Admin</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.dashboard') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.dashboard')); ?>">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.pro.*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.pro.index')); ?>">
                                <i class="fas fa-box me-2"></i>Sản phẩm
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.brand.*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.brand.index')); ?>">
                                <i class="fas fa-tags me-2"></i>Thương hiệu
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.cate.*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.cate.index')); ?>">
                                <i class="fas fa-list me-2"></i>Danh mục
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.customers.*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.customers.index')); ?>">
                                <i class="fas fa-users me-2"></i>Quản lý khách hàng
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.orders.*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.orders.index')); ?>">
                                <i class="fas fa-shopping-cart me-2"></i>Đơn hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.users.*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.users.index')); ?>">
                                <i class="fas fa-users me-2"></i>Quản lý user
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo e(request()->routeIs('ad.inventory*') ? 'active bg-primary' : ''); ?>"
                                href="<?php echo e(route('ad.inventory')); ?>">
                                <i class="fas fa-boxes me-2"></i> Quản lý tồn kho
                            </a>
                        </li>


                    </ul>

                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-light min-vh-100">
                <!-- Top navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>" target="_blank">
                                        <i class="fas fa-external-link-alt me-1"></i>Xem website
                                    </a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle me-1"></i>
                                        <?php echo e(Auth::user()->name ?? 'Admin'); ?>

                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(url('/admin/change-password')); ?>">
                                                <!-- Sửa thành URL tạm -->
                                                <i class="fas fa-key me-2"></i>Đổi mật khẩu
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form method="POST" action="<?php echo e(route('ad.logout')); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <div class="container-fluid">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\layout\admin.blade.php ENDPATH**/ ?>