<?php $__env->startSection('title', 'Quản lý Khách hàng'); ?>

<?php $__env->startSection('content'); ?>
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
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="exportToCSV()">
                                    <i class="fas fa-file-csv me-2 text-info"></i>CSV (.csv)
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
                    <div class="stats-number"><?php echo e($customers->total()); ?></div>
                    <div class="stats-label">Tổng số khách hàng</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e($customers->where('created_at', '>=', now()->startOfMonth())->count()); ?>

                    </div>
                    <div class="stats-label">Khách hàng mới</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number"><?php echo e($customers->sum(fn($customer) => $customer->orders->count())); ?></div>
                    <div class="stats-label">Tổng số đơn hàng</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?php echo e($customers->filter(fn($customer) => $customer->orders->count() > 0)->count()); ?></div>
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
                            <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng..."
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
                <span class="badge bg-light text-dark"><?php echo e($customers->total()); ?> khách hàng</span>
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
                            <th width="120" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="customer-row">
                                <td class="text-center fw-bold text-primary">#<?php echo e($customer->id); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px; font-size: 1.1rem;">
                                            <?php echo e(strtoupper(substr($customer->fullname, 0, 1))); ?>

                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark"><?php echo e($customer->fullname); ?></div>
                                            <small class="text-muted">Đăng ký:
                                                <?php echo e($customer->created_at->format('d/m/Y')); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-info">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="fas fa-phone text-success me-2"></i>
                                            <span><?php echo e($customer->tel); ?></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <small class="text-truncate" style="max-width: 200px;"
                                                title="<?php echo e($customer->address); ?>">
                                                <?php echo e($customer->address ?: 'Chưa cập nhật'); ?>

                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill fs-6">
                                        <?php echo e($customer->orders->count()); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if($customer->orders->count() > 0): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Đã mua hàng
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>Chưa mua hàng
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-sm btn-outline-primary view-details"
                                            data-customer-id="<?php echo e($customer->id); ?>" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning"
                                            onclick="editCustomer(<?php echo e($customer->id); ?>)" title="Sửa thông tin">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDelete(<?php echo e($customer->id); ?>, '<?php echo e($customer->fullname); ?>')"
                                            title="Xóa khách hàng">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-users-slash"></i>
                                        <h5>Chưa có khách hàng nào</h5>
                                        <p class="mb-0">Hiện tại chưa có khách hàng nào đăng ký trong hệ thống</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php if($customers->hasPages()): ?>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị <?php echo e($customers->firstItem()); ?> - <?php echo e($customers->lastItem()); ?> của <?php echo e($customers->total()); ?>

                    khách hàng
                </div>
                <nav>
                    <?php echo e($customers->links('pagination::bootstrap-5')); ?>

                </nav>
            </div>
        <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
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
        }

        .avatar {
            font-weight: 600;
        }

        .customer-row:hover {
            background-color: #f8f9ff;
            transform: translateX(5px);
            transition: all 0.3s ease;
        }

        .badge.rounded-pill {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
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

        .contact-info i {
            width: 16px;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
        }

        .dropdown-menu-end {
            right: 0;
            left: auto;
        }

        /* Print styles */
        @media print {

            .page-header,
            .stats-card,
            .card,
            .btn-group,
            .pagination,
            .table-header .badge,
            .action-buttons,
            .dropdown-menu {
                display: none !important;
            }

            .table-container {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                margin: 0 !important;
            }

            .table thead th {
                background: #f8f9fa !important;
                color: #000 !important;
                border: 1px solid #ddd !important;
                padding: 8px !important;
            }

            .table td {
                padding: 8px !important;
                border: 1px solid #ddd !important;
            }

            body {
                background: white !important;
                font-size: 12px !important;
                padding: 20px !important;
            }

            .container-fluid {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }

            .avatar,
            .fa-icon {
                display: none !important;
            }
        }

        /* Export table styles */
        .export-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .export-table th {
            background-color: #2c3e50;
            color: white;
            padding: 10px;
            border: 1px solid #34495e;
            text-align: left;
            font-weight: bold;
        }

        .export-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .export-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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

        function downloadExport(format) {
            // Tạo bảng đơn giản cho export
            let content = '';

            if (format === 'csv') {
                // CSV format
                content = 'ID,Họ tên,SĐT,Địa chỉ,Số đơn hàng,Ngày đăng ký,Trạng thái\n';
                document.querySelectorAll('.customer-row').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const id = cells[0].textContent.replace('#', '');
                    const name = cells[1].querySelector('.fw-semibold').textContent.replace(/,/g, ' ');
                    const phone = cells[2].querySelector('span').textContent;
                    const address = cells[2].querySelector('small').textContent.replace(/,/g, ' ');
                    const orders = cells[3].querySelector('.badge').textContent;
                    const date = cells[1].querySelector('.text-muted').textContent.replace('Đăng ký: ', '');
                    const status = cells[4].querySelector('.badge').textContent.replace(/,/g, ' ');

                    content += `"${id}","${name}","${phone}","${address}","${orders}","${date}","${status}"\n`;
                });
            } else {
                // HTML format for Excel/PDF
                content = `
                    <table class="export-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
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
                            <td>${cells[2].querySelector('small').textContent}</td>
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
                type: format === 'csv' ? 'text/csv' : 'text/html'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `khach_hang_${new Date().toISOString().split('T')[0]}.${format}`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function printTable() {
            const printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Danh sách Khách hàng</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        h1 { color: #2c3e50; text-align: center; margin-bottom: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
                        th { background: #2c3e50; color: white; padding: 10px; border: 1px solid #34495e; }
                        td { padding: 8px; border: 1px solid #ddd; }
                        tr:nth-child(even) { background: #f8f9fa; }
                        .summary { margin: 20px 0; padding: 15px; background: #e9ecef; border-radius: 5px; }
                    </style>
                </head>
                <body>
                    <h1>DANH SÁCH KHÁCH HÀNG</h1>
                    <div class="summary">
                        <strong>Ngày xuất:</strong> ${new Date().toLocaleDateString('vi-VN')} | 
                        <strong>Tổng số:</strong> ${document.querySelectorAll('.customer-row').length} khách hàng
                    </div>
                    ${document.querySelector('.table-responsive').innerHTML}
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\c#+CĐTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>