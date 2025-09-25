<div class="container">
    <div class="text-center mb-3 pt-3">
        <h2 class="fw-bold text-black" style="font-size:2rem;">"Nhà" mới toanh. Khám phá nhanh!</h2>
    </div>
    <div class="search-bar-chotot mx-auto d-flex flex-wrap justify-content-center align-items-center gap-2 py-3 rounded-4 shadow"
        style="max-width:1200px;">
        <form action="{{ route('client.products.search') }}" method="GET" class="flex-grow-1 d-flex align-items-center"
            style="min-width:250px;">
            <span class="mx-2"><i class="bi bi-search"></i></span>
            <input class="form-control border-0" type="search" placeholder="Tìm sản phẩm..." name="keyword" required>
        </form>
        <div class="dropdown me-2">
            <button class="btn btn-light dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-geo-alt"></i> Chọn khu vực
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Hồ Chí Minh</a></li>
                <li><a class="dropdown-item" href="#">Hà Nội</a></li>
                <li><a class="dropdown-item" href="#">Đà Nẵng</a></li>
            </ul>
        </div>
        <button type="submit" class="btn btn-search fw-bold px-4 rounded-4">Tìm kiếm</button>
    </div>
</div>

<div class="container my-5">
    <h3 class="fw-bold mb-4">Khám phá danh mục</h3>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
        @foreach ($categories as $item)
            <div class="col">
                <a href="{{ route('category', ['id' => $item->cateid]) }}"
                    class="text-decoration-none d-flex flex-column align-items-center justify-content-between 
                  p-3 shadow-sm rounded-4 h-100">
                    <div class="d-flex justify-content-center align-items-center mb-2" style="height:80px;">
                        <img src="{{ asset('storage/categories/' . $item->cateimage) }}" alt="{{ $item->catename }}"
                            class="img-fluid rounded-3" style="max-height:70px; object-fit:contain;">
                    </div>
                    <span class="fw-bold text-dark text-center">{{ $item->catename }}</span>
                </a>
            </div>
        @endforeach

    </div>
</div>
