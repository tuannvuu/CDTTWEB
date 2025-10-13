@extends('layout.admin')

@section('title', 'Sản phẩm - Thêm')

@section('content')
    
<link href="{{ asset('css/create.pro.css') }}" rel="stylesheet" />
    <div class="container-fluid py-4">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-plus-circle"></i>Thêm sản phẩm mới</h2>
            </div>

            <x-alert></x-alert>

            <form action="{{ route('pro.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

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
                            <label for="f-proname" class="form-label required">Tên sản phẩm</label>
                            <input type="text" name="proname" class="form-control" id="f-proname"
                                value="{{ old('proname') }}" required placeholder="Nhập tên sản phẩm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="f-price" class="form-label required">Giá sản phẩm (VND)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control" id="f-price"
                                    value="{{ old('price') }}" required step="1000" min="0"
                                    placeholder="Nhập giá sản phẩm">
                                <span class="input-group-text">₫</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="f-brandid" class="form-label required">Thương hiệu</label>
                            <select name="brandid" id="f-brandid" class="form-select" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brandid') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brandname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="f-cateid" class="form-label required">Danh mục</label>
                            <select name="cateid" id="f-cateid" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->cateid }}"
                                        {{ old('cateid') == $category->cateid ? 'selected' : '' }}>
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
                        <label for="f-des" class="form-label">Mô tả chi tiết</label>
                        <textarea name="description" id="f-des" rows="5" class="form-control"
                            placeholder="Nhập mô tả chi tiết về sản phẩm">{{ old('description') }}</textarea>
                        <div class="form-text">Mô tả giúp khách hàng hiểu rõ hơn về sản phẩm của bạn.</div>
                    </div>
                </div>

                <!-- Hình ảnh sản phẩm -->
                <div class="form-section">
                    <h5><i class="fas fa-image"></i>Hình ảnh sản phẩm</h5>

                    <div class="file-upload mb-3">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h5>Kéo thả hình ảnh hoặc click để chọn</h5>
                        <p class="text-muted">Hỗ trợ: JPG, PNG, GIF - Kích thước tối đa: 5MB</p>
                        <input type="file" name="fileName" id="f-path" class="d-none" accept="image/*">
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('f-path').click()">
                            <i class="fas fa-folder-open me-2"></i>Chọn hình ảnh
                        </button>
                    </div>

                    @error('fileName')
                        <div class="alert alert-danger mt-2">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                        </div>
                    @enderror

                    <div class="preview-container">
                        <img id="imagePreview" class="preview-image" alt="Xem trước hình ảnh">
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="action-buttons">
                    <a href="{{ route('pro.index') }}" class="btn btn-success">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Xem trước hình ảnh
        document.getElementById('f-path').addEventListener('change', function(e) {
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
        document.getElementById('f-price').addEventListener('input', function(e) {
            const value = e.target.value;
            if (value) {
                const formatted = new Intl.NumberFormat('vi-VN').format(value);
                e.target.value = formatted.replace(/,/g, '');
            }
        });

        // Hiển thị giá trị đã format khi load trang
        window.addEventListener('load', function() {
            const priceInput = document.getElementById('f-price');
            if (priceInput.value) {
                const value = priceInput.value;
                const formatted = new Intl.NumberFormat('vi-VN').format(value);
                priceInput.value = formatted.replace(/,/g, '');
            }
        });
    </script>
@endsection
