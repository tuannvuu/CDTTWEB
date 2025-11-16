@extends('layout.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header với gradient tinh tế -->
        <div class="page-header rounded-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-white rounded-circle p-3 me-3 shadow-sm">
                            <i class="fas fa-receipt text-primary fs-4"></i>
                        </div>
                        <div>
                            <h1 class="page-title text-white mb-1">Chi tiết Đơn hàng #{{ $order->id }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('ad.orders.index') }}" class="btn btn-light rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Badge trạng thái đơn hàng -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span
                            class="badge status-badge 
                            @if ($order->status == 'pending') bg-warning
                            @elseif($order->status == 'confirmed') bg-info
                            @elseif($order->status == 'shipping') bg-primary
                            @elseif($order->status == 'completed') bg-success
                            @elseif($order->status == 'cancelled') bg-danger @endif rounded-pill px-3 py-2 fs-6">
                            @if ($order->status == 'pending')
                                Chờ xử lý
                            @elseif($order->status == 'confirmed')
                                Đã xác nhận
                            @elseif($order->status == 'shipping')
                                Đang giao
                            @elseif($order->status == 'completed')
                                Hoàn thành
                            @elseif($order->status == 'cancelled')
                                Đã hủy
                            @endif
                        </span>
                    </div>
                    <div class="text-muted">
                        <small>Đơn hàng tạo lúc:
                            {{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->format('H:i:s d/m/Y') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Thông tin khách hàng -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-primary text-white rounded-top"
                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle me-2 fs-5"></i>
                            <h5 class="card-title mb-0">Thông tin khách hàng</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="info-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="info-icon bg-light-primary rounded-circle p-2 me-3">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Họ tên</div>
                                    <div class="fw-semibold">{{ $order->fullname ?? 'Khách vãng lai' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="info-icon bg-light-primary rounded-circle p-2 me-3">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Số điện thoại</div>
                                    <div class="fw-semibold">{{ $order->tel ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="info-icon bg-light-primary rounded-circle p-2 me-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Email</div>
                                    <div class="fw-semibold">{{ $order->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="d-flex align-items-start">
                                <div class="info-icon bg-light-primary rounded-circle p-2 me-3 mt-1">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Địa chỉ giao hàng</div>
                                    <div class="fw-semibold">{{ $order->address ?? 'Chưa cập nhật' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header rounded-top"
                        style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clipboard-list me-2 fs-5"></i>
                            <h5 class="card-title mb-0 text-white">Thông tin đơn hàng</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="info-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="info-icon bg-light-success rounded-circle p-2 me-3">
                                    <i class="fas fa-hashtag text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Mã đơn hàng</div>
                                    <div class="fw-semibold">#{{ $order->id }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="info-icon bg-light-success rounded-circle p-2 me-3">
                                    <i class="fas fa-calendar-plus text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Ngày tạo</div>
                                    <div class="fw-semibold">
                                        {{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->format('H:i:s d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="info-icon bg-light-success rounded-circle p-2 me-3">
                                    <i class="fas fa-calendar-check text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Cập nhật lần cuối</div>
                                    <div class="fw-semibold">
                                        {{ $order->updated_at->timezone('Asia/Ho_Chi_Minh')->format('H:i:s d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="d-flex align-items-start">
                                <div class="info-icon bg-light-success rounded-circle p-2 me-3 mt-1">
                                    <i class="fas fa-sticky-note text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Ghi chú</div>
                                    <div class="fw-semibold">{{ $order->description ?? 'Không có ghi chú' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sản phẩm trong đơn hàng -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header rounded-top" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-box-open me-2 fs-5"></i>
                    <h5 class="card-title mb-0 text-white">Sản phẩm trong đơn hàng</h5>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end pe-4">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($order->items as $index => $item)
                                @php
                                    $lineTotal = $item->price * $item->quantity;
                                    $total += $lineTotal;
                                @endphp
                                <tr>
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item->product && $item->product->fileName)
                                                <img src="{{ asset('storage/products/' . $item->product->fileName) }}"
                                                    alt="{{ $item->product->proname }}" class="rounded me-3 product-img">
                                            @else
                                                <div
                                                    class="product-placeholder rounded d-flex align-items-center justify-content-center me-3">
                                                    <i class="fas fa-box text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">
                                                    {{ optional($item->product)->proname ?? 'Sản phẩm không tồn tại' }}
                                                </div>
                                                <small class="text-muted">ID:
                                                    {{ optional($item->product)->id ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="quantity-badge">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-end">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                    <td class="text-end fw-semibold pe-4">{{ number_format($lineTotal, 0, ',', '.') }} đ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <td colspan="4" class="text-end fw-bold border-0 ps-4">Tổng cộng:</td>
                                <td class="text-end fw-bold text-primary fs-5 border-0 pe-4">
                                    {{ number_format($order->total, 0, ',', '.') }} đ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('ad.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>

            @if (in_array($order->status, ['completed', 'cancelled']))
                <button class="btn btn-outline-warning rounded-pill px-4" disabled>
                    <i class="fas fa-edit me-2"></i>Cập nhật trạng thái
                </button>
                <button class="btn btn-outline-danger rounded-pill px-4" disabled>
                    <i class="fas fa-times me-2"></i>Hủy đơn hàng
                </button>
            @else
                <button class="btn btn-warning rounded-pill px-4" onclick="editOrder({{ $order->id }})">
                    <i class="fas fa-edit me-2"></i>Cập nhật trạng thái
                </button>
                <button class="btn btn-danger rounded-pill px-4"
                    onclick="confirmDelete({{ $order->id }}, 'Đơn hàng #{{ $order->id }}')">
                    <i class="fas fa-times me-2"></i>Hủy đơn hàng
                </button>
            @endif
        </div>
    </div>

    <!-- Modal cập nhật trạng thái -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white rounded-top">
                    <h5 class="modal-title" id="statusModalLabel">
                        <i class="fas fa-sync-alt me-2"></i>Cập nhật trạng thái Đơn hàng #{{ $order->id }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="updateStatusForm" action="{{ route('ad.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Chọn trạng thái mới:</label>
                            <select class="form-select rounded-pill py-2 px-3" id="status" name="status">
                                <option value="pending" @if ($order->status == 'pending') selected @endif>🟡 Chờ xử lý
                                </option>
                                <option value="confirmed" @if ($order->status == 'confirmed') selected @endif>🔵 Đã xác nhận
                                </option>
                                <option value="shipping" @if ($order->status == 'shipping') selected @endif>🚚 Đang giao
                                </option>
                                <option value="completed" @if ($order->status == 'completed') selected @endif>✅ Hoàn thành
                                </option>
                                <option value="cancelled" @if ($order->status == 'cancelled') selected @endif>❌ Đã hủy
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Form hủy đơn hàng (ẩn) -->
    <form id="delete-order-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ad.show.order.css') }}">
    <style>
        .page-header {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.1);
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-light-primary {
            background-color: rgba(77, 124, 254, 0.1);
        }

        .bg-light-success {
            background-color: rgba(67, 233, 123, 0.1);
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 1px solid #e9ecef;
        }

        .product-placeholder {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        .quantity-badge {
            display: inline-block;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 600;
        }

        .status-badge {
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.5rem;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .icon-container {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .modal-content {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('scripts')
    <script>
        function editOrder(id) {
            var statusModal = new bootstrap.Modal(document.getElementById('statusModal'), {
                keyboard: false
            });
            statusModal.show();
        }

        function confirmDelete(id, name) {
            if (confirm(`Bạn có chắc muốn hủy ${name}? Hành động này không thể hoàn tác.`)) {
                let form = document.getElementById('delete-order-form');
                form.action = '{{ route('ad.orders.destroy', ['id' => ':id']) }}'.replace(':id', id);
                form.submit();
            }
        }

        // Thêm hiệu ứng khi trang tải xong
        document.addEventListener('DOMContentLoaded', function() {
            // Thêm hiệu ứng fade-in cho các phần tử
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endsection
