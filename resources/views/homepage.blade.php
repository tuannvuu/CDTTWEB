@extends('layout.client')

@section('title', 'Trang chủ')

@section('content')
    <h2 class="fw-bold mb-4">Sản phẩm mới nhất</h2>

    <section class="py-5">
        <div class="container">
            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-4">
                @foreach ($newProducts as $product)
                    <div class="col">
                        <div class="card h-100">
                            <a href="{{ route('client.products.detail', $product->id) }}">
                                <img src="{{ asset('storage/products/' . $product->fileName) }}" class="card-img-top"
                                    alt="{{ $product->proname }}" style="height: 200px; object-fit: contain;">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $product->proname }}</h5>
                                <p class="text-danger fw-semibold">{{ number_format($product->price) }}đ</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
