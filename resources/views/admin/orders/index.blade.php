@extends('layout.admin')

@section('title', 'Quản lý Đơn hàng')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header bg-gradient-primary rounded-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title text-white mb-2">
                        <i class="fas fa-shopping-cart me-3"></i>Quản lý Đơn hàng
                    </h1>
                    <p class="page-subtitle text-white-50 mb-0">Quản lý và theo dõi tất cả đơn hàng trong hệ thống</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="btn-group">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-2"></i>Xuất dữ liệu
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel me-2 text-success"></i>Excel (.xlsx)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="exportToPDF()">
                                    <i class="fas fa-file-pdf me-2 text-danger"></i>PDF (.pdf)
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="printTable()">
                                    <i class="fas fa-print me-2 text-secondary"></i>In danh sách
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $orders->total() }}</div>
                    <div class="stats-label">Tổng số đơn hàng</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $orders->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                    <div class="stats-label">Đơn hàng mới</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $orders->sum(fn($order) => $order->items->count()) }}</div>
                    <div class="stats-label">Tổng sản phẩm</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $orders->unique('customer_id')->count() }}</div>
                    <div class="stats-label">Khách hàng</div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Tìm kiếm đơn hàng..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="filterStatus">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending">Chờ xử lý</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="shipping">Đang giao</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" id="filterDate" placeholder="Lọc theo ngày">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="sortBy">
                            <option value="newest">Mới nhất</option>
                            <option value="oldest">Cũ nhất</option>
                            <option value="most_items">Nhiều sản phẩm</option>
                            <option value="least_items">Ít sản phẩm</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill" id="applyFilters">
                                <i class="fas fa-filter me-2"></i>Áp dụng
                            </button>
                            <button class="btn btn-outline-secondary" id="resetFilters">
                                <i class="fas fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-list me-2"></i>Danh sách Đơn hàng</h3>
                <span class="badge bg-light text-dark">{{ $orders->total() }} đơn hàng</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="100" class="text-center">MÃ ĐƠN</th>
                            <th>THÔNG TIN ĐƠN HÀNG</th>
                            <th width="120" class="text-center">SẢN PHẨM</th>
                            <th width="150" class="text-center">TRẠNG THÁI</th>
                            <th width="120" class="text-center">THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="order-row">
                                <td class="text-center">
                                    <div class="fw-bold text-primary">#{{ $order->id }}</div>
                                    <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="avatar bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; font-size: 1.1rem;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-dark mb-1">
                                                {{ $order->customer->fullname ?? 'Khách vãng lai' }}
                                            </div>
                                            <div class="text-muted small">
                                                <i class="fas fa-phone me-1"></i>{{ $order->customer->tel ?? 'N/A' }}
                                            </div>
                                            <div class="text-muted small">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                                    {{ $order->customer->address ?? 'Chưa cập nhật' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="badge bg-primary rounded-pill fs-6 mb-1">
                                            {{ $order->items->count() }} sp
                                        </span>
                                        <small class="text-muted">
                                            {{ $order->items->sum('quantity') }} cái
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['bg-warning', 'Chờ xử lý', 'clock'],
                                            'confirmed' => ['bg-info', 'Đã xác nhận', 'check-circle'],
                                            'shipping' => ['bg-primary', 'Đang giao', 'shipping-fast'],
                                            'completed' => ['bg-success', 'Hoàn thành', 'check-double'],
                                            'cancelled' => ['bg-danger', 'Đã hủy', 'times-circle'],
                                        ];
                                        $status = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                    @endphp
                                    <span class="badge {{ $status[0] }} text-white">
                                        <i class="fas fa-{{ $status[2] }} me-1"></i>{{ $status[1] }}
                                    </span>
                                    <div class="mt-1">
                                        <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('ad.orders.show', $order->id) }}"
                                            class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-warning"
                                            onclick="editOrder({{ $order->id }})" title="Cập nhật trạng thái">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDelete({{ $order->id }}, 'Đơn hàng #{{ $order->id }}')"
                                            title="Hủy đơn hàng">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                        <h5>Chưa có đơn hàng nào</h5>
                                        <p class="mb-0">Hiện tại chưa có đơn hàng nào trong hệ thống</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($orders->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị {{ $orders->firstItem() }} - {{ $orders->lastItem() }} của {{ $orders->total() }} đơn hàng
                </div>
                <nav>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalTitle">Xuất dữ liệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center py-3">
                        <i class="fas fa-download fa-3x text-primary mb-3"></i>
                        <p id="exportModalMessage">Đang chuẩn bị dữ liệu để xuất...</p>
                    </div>
                    <div class="progress mb-3 d-none" id="exportProgress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary d-none" id="exportDownloadBtn">
                        <i class="fas fa-download me-2"></i>Tải xuống
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .page-header {
            background: var(--primary-gradient);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .table-container:hover {
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        .table-header {
            background: var(--primary-gradient);
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .table thead th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 1.25rem 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
            border-left: 3px solid #667eea;
            transform: translateX(5px);
        }

        .table tbody td {
            border-color: #f0f0f0;
            padding: 1.25rem 1rem;
            vertical-align: middle;
        }

        .avatar {
            font-weight: 600;
        }

        .badge.rounded-pill {
            padding: 0.5rem 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-sm:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const applyFilters = document.getElementById('applyFilters');
            const resetFilters = document.getElementById('resetFilters');
            const searchInput = document.getElementById('searchInput');
            const filterStatus = document.getElementById('filterStatus');
            const filterDate = document.getElementById('filterDate');
            const sortBy = document.getElementById('sortBy');
            const orderRows = document.querySelectorAll('.order-row');

            applyFilters.addEventListener('click', function() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = filterStatus.value;
                const dateValue = filterDate.value;

                orderRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const status = row.querySelector('.badge').textContent.toLowerCase();
                    const date = row.querySelector('small.text-muted').textContent;

                    let show = true;

                    // Search filter
                    if (searchTerm && !text.includes(searchTerm)) {
                        show = false;
                    }

                    // Status filter
                    if (statusValue && !status.includes(statusValue)) {
                        show = false;
                    }

                    // Date filter
                    if (dateValue && !date.includes(dateValue)) {
                        show = false;
                    }

                    row.style.display = show ? '' : 'none';
                });
            });

            resetFilters.addEventListener('click', function() {
                searchInput.value = '';
                filterStatus.value = '';
                filterDate.value = '';
                sortBy.value = 'newest';
                orderRows.forEach(row => row.style.display = '');
            });
        });

        function exportToExcel() {
            showExportModal('excel');
        }

        function exportToPDF() {
            showExportModal('pdf');
        }

        function printTable() {
            window.print();
        }

        function showExportModal(format) {
            const modal = new bootstrap.Modal(document.getElementById('exportModal'));
            modal.show();

            // Simulate export process
            setTimeout(() => {
                alert(`Chức năng xuất ${format.toUpperCase()} đang được phát triển`);
                modal.hide();
            }, 1500);
        }

        function editOrder(id) {
            alert('Chức năng cập nhật đơn hàng #' + id);
        }

        function confirmDelete(id, name) {
            if (confirm(`Bạn có chắc muốn hủy ${name}?`)) {
                alert('Đã hủy: ' + name);
            }
        }
    </script>
@endsection
