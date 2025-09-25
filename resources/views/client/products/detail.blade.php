@extends('layout.client')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Cột trái: hình ảnh -->
                <div class="col-md-5">

                    <img class="card-img-top" src="{{ asset('storage/products/' . $product->fileName) }}"
                        alt="{{ $product->proname }}" style="max-height:300px; object-fit:contain;" />

                </div>


                <!-- Cột phải: thông tin sản phẩm -->
                <div class="col-md-7">
                    <h2 class="fw-bold mb-3">{{ $product->proname }}</h2>
                    <h4 class="text-danger mb-3">{{ number_format($product->price) }}đ</h4>

                    <p class="mb-4"><strong>Mô tả:</strong> {{ $product->description }}</p>

                    <form action="{{ route('cartadd', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
