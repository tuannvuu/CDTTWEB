@extends('layout.client')

@section('content')
    <div class="container my-5">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center mb-3 fw-bold text-primary">🚀 Sản Phẩm Mới Nhất 🚀</h2>
                <p class="text-center text-muted">Khám phá những sản phẩm công nghệ mới nhất với thiết kế hiện đại và tính
                    năng vượt trội</p>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card product-card h-100 border-0 shadow-sm">
                        <!-- Product Image -->
                        <div class="position-relative overflow-hidden">
                        <img class="product-image" src="{{ asset('storage/products/' . $product->fileName) }}"
                        alt="{{ $product->proname }}" />

                            <!-- Badge New -->
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-danger">MỚI</span>
                            </div>

                            <!-- Hover Overlay -->
                            <div class="card-img-overlay d-flex align-items-end justify-content-center product-overlay">
                                <a href="{{ route('client.products.detail', $product->id) }}"
                                    class="btn btn-primary btn-sm opacity-0 translate-y-100">
                                    <i class="bi bi-eye me-1"></i> Xem nhanh
                                </a>
                            </div>
                        </div>

                        <!-- Product Body -->
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold text-dark mb-2 line-clamp-2" style="min-height: 48px;">
                                {{ $product->proname }}
                            </h6>

                            <!-- Price -->
                            <div class="mb-2">
                                <span class="h5 text-danger fw-bold">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </span>
                                @if ($product->old_price)
                                    <span class="text-muted text-decoration-line-through ms-2">
                                        {{ number_format($product->old_price, 0, ',', '.') }} đ
                                    </span>
                                @endif
                            </div>

                            <!-- Short Description -->
                            @if ($product->short_description)
                                <p class="card-text text-muted small mb-3 line-clamp-2">
                                    {{ $product->short_description }}
                                </p>
                            @endif

                            <!-- Rating (if available) -->
                            @if ($product->rating)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="text-warning small">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $product->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <small class="text-muted ms-2">({{ $product->review_count ?? 0 }})</small>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="mt-auto">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('client.products.detail', $product->id) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i> Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inboxes display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">Chưa có sản phẩm mới nào</h4>
                        <p class="text-muted mb-4">Các sản phẩm mới sẽ được cập nhật sớm nhất</p>
                        <a href="{{ route('client.products.index') }}" class="btn btn-primary">
                            <i class="bi bi-grid me-1"></i> Xem tất cả sản phẩm
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    {{ $products->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>

    

    <script>
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const btn = this;

                // Hiệu ứng khi click
                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Đã thêm';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-secondary');

                // Gửi request AJAX để thêm vào giỏ hàng
                fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật số lượng trong giỏ hàng
                            updateCartCount(data.cart_count);
                        } else {
                            alert(data.message || "Có lỗi xảy ra");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Khôi phục trạng thái nút
                        btn.innerHTML = '<i class="bi bi-cart-plus me-1"></i> Thêm giỏ hàng';
                        btn.classList.remove('btn-secondary');
                        btn.classList.add('btn-success');
                    });
            });
        });

        function updateCartCount(count) {
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = count;
            }
        }
    </script>

@endsection
