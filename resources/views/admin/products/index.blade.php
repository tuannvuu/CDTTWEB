@extends('layout.admin')

@section('title', 'Sản phẩm')

@section('content')
    <link href="{{ asset('css/ad.index.pro.css') }}" rel="stylesheet" />

    <div class="container-fluid py-4">
        <div class="header-actions">
            <h3><i class="fas fa-boxes me-2"></i>Quản lý Sản phẩm</h3>
        </div>

        <x-alert></x-alert>

        <!-- Thống kê -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-1 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number">{{ $list->total() }}</div>
                                <div class="stat-label">TỔNG SỐ SẢN PHẨM</div>
                            </div>
                            <i class="fas fa-box stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-2 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number">{{ $list->count() }}</div>
                                <div class="stat-label">HIỂN THỊ TRANG NÀY</div>
                            </div>
                            <i class="fas fa-eye stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number">{{ $list->where('price', '>', 1000000)->count() }}</div>
                                <div class="stat-label">SẢN PHẨM CAO CẤP</div>
                            </div>
                            <i class="fas fa-crown stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stat card-stat-4 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-number">8</div>
                                <div class="stat-label">MỚI THÁNG NÀY</div>
                            </div>
                            <i class="fas fa-calendar-alt stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút thêm sản phẩm -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="h4 mb-0">Danh sách Sản phẩm</h4>
            <a href="{{ route('ad.pro.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Thêm sản phẩm
            </a>
        </div>

        <!-- Bảng danh sách -->
        @if ($list->count() > 0)
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Loại</th>
                                <th width="15%">Thương hiệu</th>
                                <th width="20%">Tên sản phẩm</th>
                                <th width="15%">Giá</th>
                                <th width="10%">Ảnh</th>
                                <th width="20%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="category-badge">{{ $item->category->catename ?? 'Chưa có danh mục' }}</span>

                                    </td>
                                    <td>
                                        <span
                                            class="brand-badge">{{ $item->brand->brandname ?? 'Chưa có thương hiệu' }}</span>

                                    </td>
                                    <td>
                                        <div class="product-name" title="{{ $item->productname }}">
                                            {{ $item->productname }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price">{{ number_format($item->price, 0, ',', '.') }} ₫</span>
                                    </td>
                                    <td>
                                        @php
                                            $imagePath = $item->fileName;
                                            if ($imagePath && !Str::startsWith($imagePath, 'products/')) {
                                                $imagePath = 'products/' . $imagePath;
                                            }
                                        @endphp

                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $item->proname }}"
                                            style="max-height:100px; object-fit:contain;">

                                    </td>

                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('ad.pro.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i>Sửa
                                            </a>
                                            <form action="{{ route('ad.pro.delete', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash me-1"></i>Xóa
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    {{ $list->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        @else
            <div class="table-container">
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>Chưa có sản phẩm nào</h3>
                    <p class="mb-4">Hãy thêm sản phẩm đầu tiên để bắt đầu quản lý</p>
                    <a href="{{ route('ad.pro.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                    </a>
                </div>
            </div>
        @endif
    </div>

    <x-modal></x-modal>
@endsection
