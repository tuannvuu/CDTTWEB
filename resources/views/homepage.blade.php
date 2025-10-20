@extends('layout.client')

@section('title', 'Trang chủ')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <h2 class="fw-bold">Sản phẩm mới nhất</h2>
    {{-- List sản phẩm --}}

    {{-- 👇 BẠN CẦN THÊM CODE HIỂN THỊ SẢN PHẨM Ở ĐÂY 👇 --}}
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                {{-- Giả sử biến chứa sản phẩm mới tên là $newProducts --}}
                @foreach ($newProducts as $product)
                    <div class="col mb-3">
                        <div class="card h-100 position-relative">
                            <a href="{{ route('client.products.detail', $product->id) }}"
                                class="stretched-link text-decoration-none text-dark">
                                <div>
                                    {{-- ✅ THẺ IMG ĐÚNG PHẢI NHƯ THẾ NÀY --}}
                                    <img class="card-img-top" src="{{ asset('storage/products/' . $product->fileName) }}"
                                        alt="{{ $product->proname }}" style="max-height:300px; object-fit:contain;" />
                                </div>
                                <div class="card-body p-2">
                                    <div class="text-center">
                                        <h4 class="fw-bolder">{{ $product->proname }}</h4>
                                    </div>
                                </div>
                            </a>
                            <div class="card-footer p-3 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <span class="text-danger fw-bold d-block mb-1">
                                        {{ number_format($product->price) }}đ
                                    </span>
                                    {{-- (Có thể thêm nút Add to Cart ở đây nếu muốn) --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{-- (Có thể thêm nút Xem thêm nếu cần) --}}
        </div>
    </section>

@endsection

@section('footer')
    @include('partials.footer')
@endsection
