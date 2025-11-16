@extends('layout.app')

@section('title', 'Thêm Địa Chỉ Mới')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="glass-card">
                <div class="card-header bg-transparent border-0 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="section-title mb-0">
                            <i class="fas fa-plus me-2"></i>
                            Thêm Địa Chỉ Mới
                        </h2>
                        <a href="/account" class="btn-action btn-outline">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại Profile
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('client.shipping-addresses.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên *</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" 
                                   id="fullname" name="fullname" 
                                   value="{{ old('fullname', Auth::user()->name ?? '') }}" required>
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1"
                                   {{ Auth::user()->shippingAddresses()->count() === 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_default">
                                Đặt làm địa chỉ mặc định
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn-action btn-primary">
                                <i class="fas fa-save me-2"></i>Lưu Địa Chỉ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection