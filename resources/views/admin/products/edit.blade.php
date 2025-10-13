@extends('layout.admin')

@section('title', 'Sản phẩm - Cập nhật')

@section('content')

<link href="{{ asset('css/edit.pro.css') }}" rel="stylesheet" />
    <div class="container-fluid py-4">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-edit"></i>Cập nhật sản phẩm</h2>
                <span class="product-id">ID: {{ $product->id }}</span>
            </div>

            <x-alert></x-alert>

            <!-- Thông tin sản phẩm -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Ngày tạo</div>
                    <div class="info-value">
                        {{ $product->created_at ? $product->created_at->format('d/m/Y H:i') : 'N/A' }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Lần cập nhật cuối</div>
                    <div class="info-value">
                        {{ $product->updated_at ? $product->updated_at->format('d/m/Y H:i') : 'N/A' }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Danh mục</div>
                    <div class="info-value">{{ $product->category->catename ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Thương hiệu</div>
                    <div class="info-value">{{ $product->brand->brandname ?? 'N/A' }}</div>
                </div>
            </div>

            <form action="{{ route('pro.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                id="productForm">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle"></i>Vui lòng kiểm tra lại thông tin</h5>
                        @foreach ($errors->all() as $item)
                            <div class="mb-1">• {{ $item }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Thông tin cơ bản -->
                <div class="form-section">
                    <h5><i class="fas fa-info-circle"></i>Thông tin cơ bản</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="proname" class="form-label required">Tên sản phẩm</label>
                            <input type="text" name="proname" class="form-control" id="proname"
                                value="{{ old('proname', $product->proname) }}" required placeholder="Nhập tên sản phẩm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label required">Giá sản phẩm (VND)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control" id="price"
                                    value="{{ old('price', $product->price) }}" required step="1000" min="0"
                                    placeholder="Nhập giá sản phẩm">
                                <span class="input-group-text">₫</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="brandid" class="form-label required">Thương hiệu</label>
                            <select name="brandid" id="brandid" class="form-select" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brandid', $product->brandid) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brandname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cateid" class="form-label required">Danh mục</label>
                            <select name="cateid" id="cateid" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->cateid }}"
                                        {{ old('cateid', $product->cateid) == $category->cateid ? 'selected' : '' }}>
                                        {{ $category->catename }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="form-section">
                    <h5><i class="fas fa-align-left"></i>Mô tả sản phẩm</h5>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả chi tiết</label>
                        <textarea name="description" id="description" rows="5" class="form-control"
                            placeholder="Nhập mô tả chi tiết về sản phẩm">{{ old('description', $product->description) }}</textarea>
                        <div class="form-text">Mô tả giúp khách hàng hiểu rõ hơn về sản phẩm của bạn.</div>
                    </div>
                </div>

                <!-- Hình ảnh sản phẩm -->
                <div class="form-section">
                    <h5><i class="fas fa-image"></i>Hình ảnh sản phẩm</h5>

                    <!-- Ảnh hiện tại -->
                    @php
                        $imagePath = null;
                        if ($product->fileName && file_exists(public_path('storage/products/' . $product->fileName))) {
                            $imagePath = 'storage/products/' . $product->fileName;
                        }
                    @endphp

                    @if ($imagePath)
                        <div class="current-image">
                            <div class="image-badge">Ảnh hiện tại</div>
                            <img src="{{ asset($imagePath) }}" alt="{{ $product->proname }}">
                            <div class="mt-2 text-muted">Kích thước:
                                {{ round(filesize(public_path($imagePath)) / 1024, 1) }} KB</div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Sản phẩm chưa có hình ảnh
                        </div>
                    @endif

                    <!-- Upload ảnh mới -->
                    <div class="file-upload mb-3">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h5>Chọn ảnh mới để thay thế (tùy chọn)</h5>
                        <p class="text-muted">Hỗ trợ: JPG, PNG, GIF - Kích thước tối đa: 5MB</p>
                        <input type="file" name="fileName" id="fileName" class="d-none" accept="image/*">
                        <button type="button" class="btn btn-warning"
                            onclick="document.getElementById('fileName').click()">
                            <i class="fas fa-sync-alt me-2"></i>Chọn ảnh mới
                        </button>
                    </div>

                    @error('fileName')
                        <div class="alert alert-danger mt-2">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                        </div>
                    @enderror

                    <div class="preview-container">
                        <img id="imagePreview" class="preview-image" alt="Xem trước hình ảnh mới">
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="action-buttons">
                    <div>
                        <a href="{{ route('pro.index') }}" class="btn btn-success">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-redo me-2"></i>Đặt lại
                        </button>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Xem trước hình ảnh mới
        document.getElementById('fileName').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });

        // Format giá tiền khi nhập
        document.getElementById('price').addEventListener('input', function(e) {
            const value = e.target.value;
            if (value) {
                const formatted = new Intl.NumberFormat('vi-VN').format(value);
                e.target.value = formatted.replace(/,/g, '');
            }
        });

        // Reset form
        function resetForm() {
            if (confirm('Bạn có chắc muốn đặt lại tất cả thay đổi?')) {
                document.getElementById('productForm').reset();
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('fileName').value = '';
            }
        }

        // Hiển thị giá trị đã format khi load trang
        window.addEventListener('load', function() {
            const priceInput = document.getElementById('price');
            if (priceInput.value) {
                const value = priceInput.value;
                const formatted = new Intl.NumberFormat('vi-VN').format(value);
                priceInput.value = formatted.replace(/,/g, '');
            }
        });
    </script>
@endsection
