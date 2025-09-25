<div class="bg-light pb-4">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container px-4 d-flex justify-content-between align-items-center">

            <!-- Logo + Category Menu -->
            <div class="d-flex align-items-center gap-3">
                <x-category-menu></x-category-menu>
                <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}">
                    <img src="{{ asset('storage/products/logo.jpg') }}" alt="Logo" class="logo-img"
                        style="height:60px;">
                </a>
            </div>

            <!-- Menu -->
            <ul class="navbar-nav d-none d-lg-flex flex-row gap-3 fw-bold">
                <li class="nav-item"><a class="nav-link" href="#">Dành cho người bán <i
                            class="bi bi-chevron-down"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Chợ Tốt</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Xe cộ</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Bất động sản</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Việc làm</a></li>
            </ul>

            <!-- Actions -->
            <div class="d-flex align-items-center gap-2">
                <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-heart"></i></a>
                <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-chat-dots"></i></a>
                <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-bell"></i></a>

                <a class="btn btn-warning fw-bold rounded-pill px-3" href="{{ route('posts.create') }}">Đăng tin</a>

                <a class="btn btn-light rounded-circle position-relative" href="{{ route('cartshow') }}">
                    <i class="bi bi-cart-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count(Session::get('cart', [])) }}
                    </span>
                </a>

                <div class="dropdown">
                    <a class="btn btn-light rounded-circle dropdown-toggle" href="#" id="userMenu"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('ad.login') }}">Đăng nhập</a></li>
                        <li><a class="dropdown-item" href="{{ route('ad.create') }}">Đăng ký</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <form action="{{ route('client.products.search') }}" method="GET"
            class="d-flex align-items-center bg-white shadow rounded-pill p-2" style="max-width: 900px; margin: auto;">

            <!-- Input từ khóa -->
            <div class="input-group flex-grow-1 rounded-pill overflow-hidden">
                <span class="input-group-text bg-white border-0">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="search" name="keyword" class="form-control border-0"
                    placeholder="Tìm sản phẩm, danh mục hoặc khu vực..." required>
            </div>

            <!-- Select khu vực -->
            <div class="ms-2">
                <select name="location" class="form-select border-0 rounded-pill shadow-sm" style="min-width: 160px;">
                    <option value="">Khu vực</option>
                    <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="Đà Nẵng">Đà Nẵng</option>
                </select>
            </div>

            <!-- Nút tìm kiếm cuối bên phải -->
            <button type="submit" class="btn btn-warning fw-bold rounded-pill px-3 ms-2"
                style="font-size: 0.85rem; white-space: nowrap;">
                <i class="bi bi-search me-1"></i> Tìm kiếm
            </button>

        </form>
    </div>



    <!-- Khám phá danh mục -->
    <div class="container my-5">
        <h3 class="fw-bold mb-4">Khám phá danh mục</h3>

        <!-- Khung lớn bao tất cả -->
        <div class="p-4 bg-white shadow rounded-4">
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
                @foreach ($categories as $item)
                    <div class="col d-flex">
                        <a href="{{ route('category', ['id' => $item->cateid]) }}"
                            class="text-decoration-none flex-fill d-flex flex-column align-items-center justify-content-between p-3 bg-light rounded-4 hover-shadow">
                            <div class="d-flex justify-content-center align-items-center mb-2" style="height:80px;">
                                <img src="{{ asset('storage/categories/' . $item->cateimage) }}"
                                    alt="{{ $item->catename }}" class="img-fluid"
                                    style="max-height:70px; object-fit:contain;">
                            </div>
                            <span class="fw-bold text-dark text-center small">{{ $item->catename }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
