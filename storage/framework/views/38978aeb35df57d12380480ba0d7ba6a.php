<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Trang Quản Trị'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: #fff;
            padding: 15px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 8px;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="<?php echo e(route('admin.dashboard')); ?>">🏠 Dashboard</a>
        <a href="<?php echo e(route('admin.products.index')); ?>">📦 Sản phẩm</a>
        <a href="<?php echo e(route('admin.categories.index')); ?>">📂 Danh mục</a>
        <a href="<?php echo e(route('admin.orders.index')); ?>">🛒 Đơn hàng</a>
        <a href="<?php echo e(route('admin.users.index')); ?>">👤 Người dùng</a>
        <a href="<?php echo e(route('logout')); ?>">🚪 Đăng xuất</a>
    </div>

    
    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\admin.blade.php ENDPATH**/ ?>