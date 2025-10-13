@extends('layout.admin')

@section('content')
    <link href="{{ asset('css/inventory.css') }}" rel="stylesheet" />
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title mb-2">
                        <i class="bi bi-box-seam me-2"></i>Quản lý tồn kho
                    </h1>
                    <p class="page-subtitle text-muted mb-0">Theo dõi và quản lý số lượng sản phẩm trong kho</p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end gap-2">
                        <div class="search-box flex-grow-1">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary d-flex align-items-center">
                            <i class="bi bi-plus-circle me-1"></i> Thêm sản phẩm
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            @php
                $totalProducts = $products->total();
                $highStock = $products->where('stock_quantity', '>', 50)->count();
                $mediumStock = $products->whereBetween('stock_quantity', [10, 50])->count();
                $lowStock = $products->where('stock_quantity', '<', 10)->count();
            @endphp

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Tổng sản phẩm</h5>
                                <h2 class="text-primary mb-0">{{ $totalProducts }}</h2>
                            </div>
                            <div class="stat-icon bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-box text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Tồn kho cao</h5>
                                <h2 class="text-success mb-0">{{ $highStock }}</h2>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Tồn kho trung bình</h5>
                                <h2 class="text-warning mb-0">{{ $mediumStock }}</h2>
                            </div>
                            <div class="stat-icon bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-exclamation-circle text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title text-muted mb-2">Sắp hết hàng</h5>
                                <h2 class="text-danger mb-0">{{ $lowStock }}</h2>
                            </div>
                            <div class="stat-icon bg-danger bg-opacity-10 p-3 rounded">
                                <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Actions -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted">Lọc theo:</span>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    Tất cả trạng thái
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Tất cả</a></li>
                                    <li><a class="dropdown-item" href="#">Tồn kho cao</a></li>
                                    <li><a class="dropdown-item" href="#">Tồn kho trung bình</a></li>
                                    <li><a class="dropdown-item" href="#">Sắp hết hàng</a></li>
                                    <li><a class="dropdown-item" href="#">Hết hàng</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="d-flex justify-content-md-end gap-2">
                            <button class="btn btn-outline-secondary d-flex align-items-center">
                                <i class="bi bi-download me-1"></i> Xuất Excel
                            </button>
                            <button class="btn btn-outline-secondary d-flex align-items-center">
                                <i class="bi bi-printer me-1"></i> In báo cáo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="80" class="ps-4">ID</th>
                                <th>Tên sản phẩm</th>
                                <th width="150" class="text-end">Giá</th>
                                <th width="180">Số lượng tồn</th>
                                <th width="120" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">#{{ $product->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="product-icon bg-light rounded p-2 me-3">
                                                    <i class="bi bi-box text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-medium">{{ $product->proname }}</div>
                                                <div class="text-muted small">SKU:
                                                    PROD{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end fw-semibold">{{ number_format($product->price, 0, ',', '.') }}₫
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-semibold">{{ $product->stock_quantity }}</span>
                                            @if ($product->stock_quantity > 50)
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Tồn kho cao
                                                </span>
                                            @elseif($product->stock_quantity >= 10)
                                                <span
                                                    class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                    <i class="bi bi-exclamation-circle me-1"></i>
                                                    Tồn kho trung bình
                                                </span>
                                            @elseif($product->stock_quantity > 0)
                                                <span
                                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                                    Sắp hết hàng
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Hết hàng
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                title="Xem chi tiết">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                title="Chỉnh sửa">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success"
                                                title="Nhập hàng">
                                                <i class="bi bi-plus-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-muted">
                                Hiển thị {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} của
                                {{ $products->total() }} sản phẩm
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Pagination Links -->
                            @if ($products->hasPages())
                                <nav aria-label="Page navigation" class="d-flex justify-content-end">
                                    <ul class="pagination mb-0">
                                        <!-- Previous Page Link -->
                                        @if ($products->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <i class="bi bi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        <!-- Pagination Elements -->
                                        @foreach (range(1, $products->lastPage()) as $i)
                                            @if ($i == $products->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $i }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                            @endif
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if ($products->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
