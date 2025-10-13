@extends('layout.admin')

@section('title', 'Thêm Loại sản phẩm')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-1 fw-bold text-dark">
                    <i class="fas fa-folder-plus text-primary me-2"></i>Thêm Loại sản phẩm mới
                </h2>
                <p class="text-muted mb-0">Tạo danh mục sản phẩm mới cho hệ thống</p>
            </div>
            <a href="{{ route('cate.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>

        <!-- Alert -->
        <x-alert></x-alert>

        <!-- Card Form -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit text-primary me-2"></i>Thông tin loại sản phẩm
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <h6 class="mb-0">Vui lòng kiểm tra lại thông tin đã nhập</h6>
                                </div>
                                <ul class="mt-2 mb-0 ps-3">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form -->
                        <form method="POST" action="{{ route('cate.store') }}" id="categoryForm">
                            @csrf

                            <div class="mb-4">
                                <label for="f-catename" class="form-label fw-semibold">
                                    Tên loại sản phẩm <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-tag text-primary"></i>
                                    </span>
                                    <input type="text" name="catename"
                                        class="form-control @error('catename') is-invalid @enderror" id="f-catename"
                                        placeholder="Nhập tên loại sản phẩm" value="{{ old('catename') }}" maxlength="100"
                                        autofocus>
                                </div>
                                @error('catename')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="text-muted small mt-1">
                                    <span id="catename-count">0</span>/100 ký tự
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="f-des" class="form-label fw-semibold">Mô tả</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light align-items-start">
                                        <i class="fas fa-file-alt text-primary mt-1"></i>
                                    </span>
                                    <textarea name="description" id="f-des" class="form-control @error('description') is-invalid @enderror"
                                        rows="4" placeholder="Nhập mô tả về loại sản phẩm" maxlength="500">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="text-muted small mt-1">
                                    <span id="description-count">0</span>/500 ký tự
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="{{ route('cate.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i> Hủy bỏ
                                </a>
                                <button type="submit" class="btn btn-primary btn-gradient">
                                    <i class="fas fa-plus-circle me-2"></i> Thêm loại sản phẩm
                                </button>
                            </div>
                        </form>
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
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            border-bottom: 1px solid #eaeaea;
            border-radius: 15px 15px 0 0 !important;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            transform: translateY(-1px);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border-right: none;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        .text-muted small {
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const catenameInput = document.getElementById('f-catename');
            const descriptionInput = document.getElementById('f-des');
            const catenameCount = document.getElementById('catename-count');
            const descriptionCount = document.getElementById('description-count');
            const form = document.getElementById('categoryForm');

            // Cập nhật số ký tự ban đầu
            catenameCount.textContent = catenameInput.value.length;
            descriptionCount.textContent = descriptionInput.value.length;

            // Theo dõi sự thay đổi của trường tên loại
            catenameInput.addEventListener('input', function() {
                catenameCount.textContent = this.value.length;
            });

            // Theo dõi sự thay đổi của trường mô tả
            descriptionInput.addEventListener('input', function() {
                descriptionCount.textContent = this.value.length;
            });

            // Hiệu ứng loading khi submit form
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
                submitBtn.disabled = true;
            });

            // Tự động focus vào trường đầu tiên
            if (catenameInput.value === '') {
                catenameInput.focus();
            }

            // Hiệu ứng real-time validation
            const inputs = [catenameInput, descriptionInput];
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '' && this.hasAttribute('required')) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
@endsection
