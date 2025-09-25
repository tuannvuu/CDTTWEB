@extends('layout.client')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Kết quả tìm kiếm cho: "<strong>{{ $keyword }}</strong>"</h2>

        @if ($products->isEmpty())
            <p class="text-center text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 justify-content-center">
                @foreach ($products as $item)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            {{-- Product image --}}
                            @php
                                $imagePath = 'storage/products/h' . $item->id . '.jpg';
                            @endphp
                            <img src="{{ file_exists(public_path($imagePath)) ? asset($imagePath) : asset('storage/products/default.jpg') }}"
                                 class="card-img-top"
                                 alt="{{ $item->proname }}">

                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2">{{ $item->proname }}</h5>
                                <p class="card-text text-danger fw-semibold">{{ number_format($item->price) }}đ</p>
                            </div>

                            <div class="card-footer bg-transparent border-0 d-flex justify-content-center gap-2 mb-3">
                                <a href="{{ route('client.products.detail', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                    Xem
                                </a>
                                <form action="{{ route('cartadd', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
