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
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">



</head>

<body>
    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- Logo & Danh mục -->
            <div class="d-flex align-items-center">
                <x-category-menu></x-category-menu>
                <a class="navbar-brand d-flex align-items-center ms-2" href="{{ route('homepage') }}">
                    <span class="brand-text ms-2 fw-bold text-primary">TechStore</span>
                </a>
            </div>

            <!-- Nút mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nội dung menu -->
            <div class="collapse navbar-collapse" id="navbarContent">

                <!-- Menu chính -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('promotions.index') }}">
                            <i class="bi bi-percent me-1"></i> Khuyến mãi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.new') }}">
                            <i class="bi bi-star me-1"></i> Sản phẩm mới
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.brands.index') }}">
                            <i class="bi bi-tags me-1"></i> Thương hiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            <i class="bi bi-info-circle me-1"></i> Về chúng tôi
                        </a>
                    </li>
                </ul>

                <!-- Form tìm kiếm ngay trong navbar -->
                <form action="{{ route('client.products.search') }}" method="GET"
                    class="d-flex align-items-center me-3" style="max-width: 350px; width: 100%;">
                    <input type="search" name="keyword" class="form-control form-control-sm me-2"
                        placeholder="Tìm kiếm sản phẩm..." required>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- Giỏ hàng & User -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Giỏ hàng -->
                    <a class="btn btn-light-custom position-relative" href="{{ route('cartshow') }}" title="Giỏ hàng">
                        <i class="bi bi-cart-fill"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                            {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                        </span>
                    </a>

                    <!-- User -->
                    <div class="dropdown">
                        <a class="btn btn-light rounded-circle dropdown-toggle" href="#" id="userMenu"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if (Auth::check())
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        <i class="bi bi-person-circle"></i>
                                        {{ Auth::user()->fullname ?? Auth::user()->username }}
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('ad.logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('ad.login') }}">
                                        <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('ad.create') }}">
                                        <i class="bi bi-person-plus"></i> Đăng ký
                                    </a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>






    </div>
</body>

</html>
