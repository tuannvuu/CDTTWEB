@extends('layout.admin')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-users me-2"></i>Danh sách người dùng
                        </h4>
                        <span class="badge bg-light text-dark fs-6">
                            Tổng: {{ $users->count() }} người dùng
                        </span>
                    </div>

                    <div class="card-body">
                        {{-- Hiển thị thông báo khi đăng ký thành công --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="60">ID</th>
                                        <th>Tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th width="120">Vai trò</th>
                                        <th width="150">Ngày tạo</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td class="fw-bold text-primary">#{{ $user->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar-sm bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center text-white fw-bold">
                                                        {{ strtoupper(substr($user->fullname, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->fullname }}</h6>
                                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">
                                                    <i class="fas fa-user me-1"></i>{{ $user->username }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                                    <i class="fas fa-envelope me-1 text-primary"></i>{{ $user->email }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($user->role == 1)
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-crown me-1"></i>Quản trị
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-user me-1"></i>Người dùng
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $user->created_at ? $user->created_at->format('H:i') : 'N/A' }}
                                                </small>
                                            </td>
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <div class="empty-state">
                                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">Không có người dùng nào</h5>
                                                    <p class="text-muted">Hãy thêm người dùng mới để bắt đầu</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Phân trang --}}
                        @if ($users->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                                <div class="text-muted">
                                    Hiển thị <span class="fw-bold">{{ $users->firstItem() ?? 0 }}</span> -
                                    <span class="fw-bold">{{ $users->lastItem() ?? 0 }}</span>
                                    trong tổng số <span class="fw-bold">{{ $users->total() }}</span> người dùng
                                </div>
                                <nav>
                                    <ul class="pagination pagination-sm mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($users->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                            @if ($page == $users->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($users->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .avatar-sm {
            width: 40px;
            height: 40px;
            font-size: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #2c3e50;
            color: white;
            padding: 1rem 0.75rem;
        }

        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        .empty-state {
            padding: 2rem 0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.08);
            transform: translateY(-1px);
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-group .btn {
            border-radius: 6px;
            margin: 0 2px;
            padding: 0.375rem 0.5rem;
        }

        /* Pagination Styles */
        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: #495057;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .page-link:hover {
            color: #0056b3;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
        }

        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 8px;
                border: 1px solid #dee2e6;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .btn-group {
                display: flex;
                justify-content: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Khởi tạo tooltip
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Thêm hiệu ứng cho các hàng trong bảng
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endpush
