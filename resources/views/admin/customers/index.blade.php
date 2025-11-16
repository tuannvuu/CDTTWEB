@extends('layout.admin')

@section('title', 'Quản lý Khách hàng')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header bg-gradient-primary rounded-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title text-white mb-2">
                        <i class="fas fa-users me-3"></i>Quản lý Khách hàng
                    </h1>
                    <p class="page-subtitle text-white-50 mb-0">Quản lý thông tin khách hàng và lịch sử mua hàng</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $customers->total() }}</div>
                    <div class="stats-label">Tổng số khách hàng</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $customers->where('created_at', '>=', now()->startOfMonth())->count() }}
                    </div>
                    <div class="stats-label">Khách hàng mới</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $customers->sum(fn($customer) => $customer->orders->count()) }}</div>
                    <div class="stats-label">Tổng số đơn hàng</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">
                        {{ $customers->filter(fn($customer) => $customer->orders->count() > 0)->count() }}</div>
                    <div class="stats-label">Đã mua hàng</div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng (tên, email)..."
                                id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterOrders">
                            <option value="">Tất cả đơn hàng</option>
                            <option value="has_orders">Có đơn hàng</option>
                            <option value="no_orders">Chưa có đơn hàng</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="sortBy">
                            <option value="newest">Mới nhất</option>
                            <option value="oldest">Cũ nhất</option>
                            <option value="most_orders">Nhiều đơn nhất</option>
                            <option value="least_orders">Ít đơn nhất</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100" id="resetFilters">
                            <i class="fas fa-refresh me-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-list me-2"></i>Danh sách Khách hàng</h3>
                <span class="badge bg-light text-dark">{{ $customers->total() }} khách hàng</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">ID</th>
                            <th>Thông tin khách hàng</th>
                            <th>Liên hệ</th>
                            <th width="120" class="text-center">Số đơn hàng</th>
                            <th width="150" class="text-center">Trạng thái</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr class="customer-row">
                                <td class="text-center fw-bold text-primary">#{{ $customer->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; font-size: 1.1rem;">
                                            {{-- SỬA: Dùng 'name' --}}
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            {{-- SỬA: Dùng 'name' --}}
                                            <div class="fw-semibold text-dark">{{ $customer->name }}</div>
                                            <small class="text-muted">Đăng ký:
                                                {{ $customer->created_at->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-info">
                                        {{-- SỬA: Dùng 'email' và đổi icon --}}
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-envelope text-info me-2"></i>
                                            <span>{{ $customer->email }}</span>
                                        </div>
                                        {{-- SỬA: Xóa bỏ dòng địa chỉ --}}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill fs-6">
                                        {{ $customer->orders->count() }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($customer->orders->count() > 0)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Đã mua hàng
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>Chưa mua hàng
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-users-slash fa-3x mb-3"></i> <!-- Thay đổi icon một chút -->
                                        <h5>Chưa có khách hàng nào</h5>
                                        <p class="mb-0">Hiện tại chưa có khách hàng nào đăng ký trong hệ thống</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($customers->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị {{ $customers->firstItem() }} - {{ $customers->lastItem() }} của {{ $customers->total() }}
                    khách hàng
                </div>
                <nav>
                    {{ $customers->links('pagination::bootstrap-5') }}
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
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const customerRows = document.querySelectorAll('.customer-row');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                customerRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });

            // Filter by orders
            const filterOrders = document.getElementById('filterOrders');
            filterOrders.addEventListener('change', function() {
                const value = this.value;
                customerRows.forEach(row => {
                    const orderCount = parseInt(row.querySelector('.badge.bg-primary').textContent);
                    if (value === 'has_orders') {
                        row.style.display = orderCount > 0 ? '' : 'none';
                    } else if (value === 'no_orders') {
                        row.style.display = orderCount === 0 ? '' : 'none';
                    } else {
                        row.style.display = '';
                    }
                });
            });

            // Reset filters
            document.getElementById('resetFilters').addEventListener('click', function() {
                searchInput.value = '';
                filterOrders.value = '';
                document.getElementById('sortBy').value = 'newest';
                customerRows.forEach(row => row.style.display = '');
            });
        });

        function showExportModal(format) {
            const modal = new bootstrap.Modal(document.getElementById('exportModal'));
            const title = document.getElementById('exportModalTitle');
            const message = document.getElementById('exportModalMessage');
            const progress = document.getElementById('exportProgress');
            const downloadBtn = document.getElementById('exportDownloadBtn');

            title.textContent = `Xuất dữ liệu ${format.toUpperCase()}`;
            message.textContent = 'Đang chuẩn bị dữ liệu để xuất...';
            progress.classList.remove('d-none');
            downloadBtn.classList.add('d-none');

            // Simulate progress
            let progressValue = 0;
            const progressInterval = setInterval(() => {
                progressValue += 10;
                progress.querySelector('.progress-bar').style.width = progressValue + '%';

                if (progressValue >= 100) {
                    clearInterval(progressInterval);
                    message.textContent = `Dữ liệu ${format.toUpperCase()} đã sẵn sàng để tải xuống!`;
                    downloadBtn.classList.remove('d-none');
                    downloadBtn.onclick = () => {
                        downloadExport(format);
                        modal.hide();
                    };
                }
            }, 200);

            modal.show();
        }

        function exportToExcel() {
            showExportModal('excel');
        }

        function exportToPDF() {
            showExportModal('pdf');
        }

        function exportToCSV() {
            showExportModal('csv');
        }

        // SỬA: Cập nhật hàm downloadExport để khớp với cột mới
        function downloadExport(format) {
            let content = '';

            if (format === 'csv') {
                // CSV format
                content = 'ID,Họ tên,Email,Số đơn hàng,Ngày đăng ký,Trạng thái\n';
                document.querySelectorAll('.customer-row').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const id = cells[0].textContent.replace('#', '');
                    const name = cells[1].querySelector('.fw-semibold').textContent.replace(/,/g, ' ');
                    const email = cells[2].querySelector('span').textContent; // Sửa: Lấy email
                    const orders = cells[3].querySelector('.badge').textContent;
                    const date = cells[1].querySelector('.text-muted').textContent.replace('Đăng ký: ', '');
                    const status = cells[4].querySelector('.badge').textContent.replace(/,/g, ' ');

                    content +=
                    `"${id}","${name}","${email}","${orders}","${date}","${status}"\n`; // Sửa: Thêm email
                });
            } else {
                // HTML format for Excel/PDF
                content = `
                    <style>
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #ddd; padding: 8px; }
                        th { background-color: #f2f2f2; }
                    </style>
                    <table class="export-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số đơn hàng</th>
                                <th>Ngày đăng ký</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                document.querySelectorAll('.customer-row').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    content += `
                            <tr>
                                <td>${cells[0].textContent.replace('#', '')}</td>
                                <td>${cells[1].querySelector('.fw-semibold').textContent}</td>
                                <td>${cells[2].querySelector('span').textContent}</td> 
                                <td>${cells[3].querySelector('.badge').textContent}</td>
                                <td>${cells[1].querySelector('.text-muted').textContent.replace('Đăng ký: ', '')}</td>
                                <td>${cells[4].querySelector('.badge').textContent}</td>
                            </tr>
                        `;
                });

                content += '</tbody></table>';
            }

            // Tạo file và tải xuống
            const blob = new Blob([content], {
                type: format === 'csv' ? 'text/csv;charset=utf-8;' : 'application/vnd.ms-excel'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;

            let extension = format;
            if (format === 'excel') extension = 'xls'; // Excel thích .xls cho kiểu HTML

            a.download = `khach_hang_${new Date().toISOString().split('T')[0]}.${extension}`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        // SỬA: Cập nhật printTable để khớp với cột mới
        function printTable() {
            const tableHtml = document.querySelector('.table-responsive').innerHTML;

            // Cần thay thế HTML của bảng để loại bỏ cột không mong muốn (nếu cần)
            // Tuy nhiên, vì chúng ta đã sửa view, tableHtml đã ĐÚNG

            const printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Danh sách Khách hàng</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        h1 { color: #2c3e50; text-align: center; margin-bottom: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
                        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
                        tr:nth-child(even) { background: #f8f9fa; }
                        th { background: #f2f2f2; color: #333; }
                        .summary { margin: 20px 0; padding: 15px; background: #e9ecef; border-radius: 5px; }
                        /* Ẩn các nút bấm khi in */
                        @media print {
                            .btn, .btn-group { display: none !important; }
                        }
                    </style>
                </head>
                <body>
                    <h1>DANH SÁCH KHÁCH HÀNG</h1>
                    <div class="summary">
                        <strong>Ngày xuất:</strong> ${new Date().toLocaleDateString('vi-VN')} | 
                        <strong>Tổng số:</strong> ${document.querySelectorAll('.customer-row').length} khách hàng
                    </div>
                    ${tableHtml}
                </body>
                </html>
            `;

            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

        function editCustomer(id) {
            alert('Chức năng sửa khách hàng #' + id);
        }

        function confirmDelete(id, name) {
            if (confirm(`Bạn có chắc muốn xóa khách hàng "${name}"?`)) {
                alert('Đã xóa khách hàng: ' + name);
            }
        }
    </script>
@endsection
