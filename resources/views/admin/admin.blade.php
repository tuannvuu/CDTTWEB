<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang Quản Trị')</title>
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
    {{-- Sidebar --}}
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
        <a href="{{ route('admin.products.index') }}">📦 Sản phẩm</a>
        <a href="{{ route('admin.categories.index') }}">📂 Danh mục</a>
        <a href="{{ route('admin.orders.index') }}">🛒 Đơn hàng</a>
        <a href="{{ route('admin.users.index') }}">👤 Người dùng</a>
        <a href="{{ route('logout') }}">🚪 Đăng xuất</a>
    </div>

    {{-- Nội dung chính --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
