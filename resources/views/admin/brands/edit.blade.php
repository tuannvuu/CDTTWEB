@extends('layout.admin')

@section('title', 'Cập nhật Thương hiệu')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Cập nhật Thương hiệu</h2>
                <p class="text-muted mb-0">Chỉnh sửa thông tin thương hiệu "{{ $brand->brandname }}"</p>
            </div>
            <a href="{{ route('ad.brand.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
        </div>

        <!-- Alert -->
        <x-alert></x-alert>

        <!-- Card Form -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit text-primary me-2"></i>Thông tin thương hiệu
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
                        <form method="POST" action="{{ route('ad.brand.update', $brand->id) }}">
                            @csrf

                            <div class="mb-4">
                                <label for="f-brandname" class="form-label fw-semibold">
                                    Tên thương hiệu <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="brandname"
                                    class="form-control @error('brandname') is-invalid @enderror" id="f-brandname"
                                    placeholder="Nhập tên thương hiệu" value="{{ old('brandname', $brand->brandname) }}"
                                    maxlength="100">
                                @error('brandname')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-muted small mt-1">
                                    <span id="brandname-count">{{ strlen(old('brandname', $brand->brandname)) }}</span>/100
                                    ký tự
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="f-des" class="form-label fw-semibold">Mô tả</label>
                                <textarea name="description" id="f-des" class="form-control @error('description') is-invalid @enderror"
                                    rows="4" placeholder="Nhập mô tả về thương hiệu" maxlength="500">{{ old('description', $brand->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-muted small mt-1">
                                    <span
                                        id="description-count">{{ strlen(old('description', $brand->description)) }}</span>/500
                                    ký tự
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="{{ route('ad.brand.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i> Hủy bỏ
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Cập nhật
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandnameInput = document.getElementById('f-brandname');
            const descriptionInput = document.getElementById('f-des');
            const brandnameCount = document.getElementById('brandname-count');
            const descriptionCount = document.getElementById('description-count');

            // Cập nhật số ký tự ban đầu
            brandnameCount.textContent = brandnameInput.value.length;
            descriptionCount.textContent = descriptionInput.value.length;

            // Theo dõi sự thay đổi của trường tên thương hiệu
            brandnameInput.addEventListener('input', function() {
                brandnameCount.textContent = this.value.length;
            });

            // Theo dõi sự thay đổi của trường mô tả
            descriptionInput.addEventListener('input', function() {
                descriptionCount.textContent = this.value.length;
            });

            // Tự động focus vào trường đầu tiên
            if (brandnameInput.value === '') {
                brandnameInput.focus();
            }
        });
    </script>
@endsection

<link rel="stylesheet" href="{{ asset('css/edit.brands.css') }}">

