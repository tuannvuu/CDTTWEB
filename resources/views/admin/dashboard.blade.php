@extends('layout.admin')

@section('title', 'My Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h1>
        <div class="text-muted">Hôm nay: {{ date('d/m/Y') }}</div>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng sản phẩm
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Đơn hàng mới
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $newOrders ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Khách hàng
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomers ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Doanh thu tháng
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}đ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sản phẩm mới nhất -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-boxes me-2"></i>5 Sản phẩm mới nhất
                    </h6>
                    <a href="{{ route('ad.pro.index') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th width="120">Giá</th>
                                    <th width="120">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge bg-secondary">#{{ $product->id }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}" class="rounded me-3" width="40"
                                                        height="40">
                                                @else
                                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $product->name }}</div>
                                                    <small
                                                        class="text-muted">{{ $product->category->catename ?? 'Chưa phân loại' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-success fw-bold">{{ number_format($product->price, 0, ',', '.') }}đ
                                        </td>
                                        <td>
                                            <span class="badge {{ $product->status ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê nhanh -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie me-2"></i>Thống kê nhanh
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Đơn hàng hoàn thành</span>
                            </div>
                            <span class="badge bg-success rounded-pill">{{ $completedOrders ?? 0 }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-clock text-warning me-2"></i>
                                <span>Đang xử lý</span>
                            </div>
                            <span class="badge bg-warning rounded-pill">{{ $pendingOrders ?? 0 }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-times-circle text-danger me-2"></i>
                                <span>Đơn hủy</span>
                            </div>
                            <span class="badge bg-danger rounded-pill">{{ $cancelledOrders ?? 0 }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-star text-info me-2"></i>
                                <span>Đánh giá mới</span>
                            </div>
                            <span class="badge bg-info rounded-pill">{{ $newReviews ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hoạt động gần đây -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history me-2"></i>Hoạt động gần đây
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @if (isset($recentActivities) && count($recentActivities) > 0)
                            @foreach ($recentActivities as $activity)
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-circle text-primary" style="font-size: 8px;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="small text-muted">{{ $activity->time }}</div>
                                        <div class="fw-bold">{{ $activity->description }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Chưa có hoạt động nào gần đây
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border: none;
            border-radius: 10px;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
            border-radius: 10px 10px 0 0 !important;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .shadow {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        }
    </style>
@endsection
