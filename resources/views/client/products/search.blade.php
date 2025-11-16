@extends('layout.productdetails')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Kết quả tìm kiếm cho: "<strong>{{ $keyword }}</strong>"</h2>

        @if ($products->isEmpty())
            <p class="text-center text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 justify-content-center">
                @foreach ($products as $item)
                    <div class="col">
                        {{-- ✅ Thêm thẻ <a> bao toàn bộ card --}}
                       <a href="{{ route('client.products.detail', $item->id) }}"
                                class="stretched-link text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0 hover-shadow" style="cursor:pointer;">
                                <div>
                                    <img class="card-img-top" 
                                         src="{{ asset('storage/products/' . $item->fileName) }}"
                                         alt="{{ $item->proname }}" 
                                         style="max-height:300px; object-fit:contain;" />
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold mb-2">{{ $item->proname }}</h5>
                                </div>

                                <div class="card-footer p-3 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <span class="text-danger fw-bold d-block mb-1">
                                            {{ number_format($item->price) }}đ
                                        </span>
                                        <small class="text-muted">
                                            {{ Str::limit($item->description, 50, '...') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
