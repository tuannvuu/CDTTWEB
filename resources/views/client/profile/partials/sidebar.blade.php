<!-- resources/views/client/profile/partials/sidebar.blade.php -->
<div class="card shadow-sm">
    <div class="card-body p-3">
        <div class="list-group list-group-flush">
            <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action border-0">
                <i class="fas fa-user me-2"></i>Thông tin cá nhân
            </a>
            <a href="{{ route('client.shipping-addresses.index') }}" class="list-group-item list-group-item-action active border-0">
                <i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng
            </a>
            <a href="{{ route('ad.changepass.form') }}" class="list-group-item list-group-item-action border-0">
                <i class="fas fa-key me-2"></i>Đổi mật khẩu
            </a>
            <a href="#" class="list-group-item list-group-item-action border-0">
                <i class="fas fa-shopping-bag me-2"></i>Lịch sử đơn hàng
            </a>
        </div>
    </div>
</div>