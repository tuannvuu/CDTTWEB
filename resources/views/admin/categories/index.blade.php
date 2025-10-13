@extends('layout.admin')

@section('title', 'Quản lý Danh mục')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header bg-gradient-primary rounded-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title text-white mb-2">
                        <i class="fas fa-folder-tree me-3"></i>Quản lý Danh mục
                    </h1>
                    <p class="page-subtitle text-white-50 mb-0">Quản lý danh mục sản phẩm và sản phẩm trong hệ thống</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('ad.cate.create') }}" class="btn btn-light btn-lg shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Thêm Danh mục
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert -->
        <x-alert></x-alert>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $list->total() }}</div>
                    <div class="stats-label">Tổng số danh mục</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $list->total() }}</div>
                    <div class="stats-label">Đang hoạt động</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">0</div>
                    <div class="stats-label">Đã ẩn</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $list->total() }}</div>
                    <div class="stats-label">Mới tháng này</div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-list me-2"></i>Danh sách Danh mục</h3>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">STT</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th width="200" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($list) > 0)
                            @foreach ($list as $item)
                                <tr class="position-relative">
                                    <td class="text-center fw-bold text-primary">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-folder text-warning me-2 fs-5"></i>
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $item->catename }}</div>
                                                <small class="text-muted">{{ $item->products->count() }} sản phẩm</small>
                                            </div>
                                            <button class="btn btn-sm btn-outline-secondary ms-auto"
                                                data-bs-toggle="collapse" data-bs-target="#r{{ $loop->index }}"
                                                aria-expanded="false" aria-controls="r{{ $loop->index }}">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 300px;"
                                            title="{{ $item->description }}">
                                            {{ $item->description ?: 'Chưa có mô tả' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('ad.cate.edit', $item->cateid) }}"
                                                class="btn btn-warning btn-sm px-3 py-2 rounded-pill" title="Sửa danh mục">
                                                <i class="fas fa-edit me-1"></i>Sửa
                                            </a>
                                            <form action="{{ route('ad.cate.delete', $item->cateid) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm px-3 py-2 rounded-pill"
                                                    onclick="return confirm('Bạn có chắc muốn xóa danh mục {{ $item->catename }}?')"
                                                    title="Xóa danh mục">
                                                    <i class="fas fa-trash me-1"></i>Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="r{{ $loop->index }}" class="collapse">
                                    <td colspan="4" class="bg-light">
                                        <div class="p-3">
                                            <h6 class="fw-semibold mb-3 text-primary">
                                                <i class="fas fa-boxes me-2"></i>Danh sách sản phẩm trong
                                                "{{ $item->catename }}"
                                            </h6>
                                            @if ($item->products->count() > 0)
                                                <div class="row g-2">
                                                    @foreach ($item->products as $pro)
                                                        <div class="col-md-6 col-lg-4">
                                                            <div
                                                                class="bg-white rounded p-2 border d-flex align-items-center">
                                                                <i class="fas fa-cube text-success me-2"></i>
                                                                <span class="text-truncate">{{ $pro->proname }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-4 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                                    <p class="mb-0">Không có sản phẩm nào trong danh mục này</p>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-folder-open"></i>
                                        <h5>Chưa có danh mục nào</h5>
                                        <p class="mb-3">Hãy thêm danh mục đầu tiên để bắt đầu quản lý</p>
                                        <a href="{{ route('cate.create') }}" class="btn btn-primary-custom">
                                            <i class="fas fa-plus me-2"></i>Thêm danh mục đầu tiên
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($list->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị {{ $list->firstItem() }} - {{ $list->lastItem() }} của {{ $list->total() }} kết quả
                </div>
                <nav>
                    {{ $list->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-color: #6c757d;
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

        .page-title {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
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
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--secondary-color);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
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
        }

        .table-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 1.25rem 1rem;
            font-size: 0.95rem;
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

        .btn {
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            color: #2d3436;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(250, 177, 160, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 118, 117, 0.4);
        }

        .btn-outline-secondary {
            border: 1px solid #dee2e6;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .rounded-pill {
            border-radius: 20px !important;
        }

        .bg-light {
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%) !important;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.7;
        }

        .empty-state h5 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #495057;
        }

        .btn-primary-custom {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
                text-align: center;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .stats-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hiệu ứng toggle button
            const toggleButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (this.getAttribute('aria-expanded') === 'true') {
                        icon.className = 'fas fa-chevron-down';
                    } else {
                        icon.className = 'fas fa-chevron-up';
                    }
                });
            });

            // Hiệu ứng loading khi xóa
            const deleteForms = document.querySelectorAll('form[action*="delete"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang xóa...';
                    button.disabled = true;
                });
            });

            // Hiệu ứng hover cho các hàng trong bảng
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.transition = 'transform 0.3s ease';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
@endsection
