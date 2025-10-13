@extends('layout.client')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($products as $item)
                    <div class="col mb-3">
                        <div class="card h-100 position-relative">

                            <!-- ✅ Link bao toàn bộ card -->
                            <a href="{{ route('client.products.detail', $item->id) }}"
                                class="stretched-link text-decoration-none text-dark">
                                <div>
                                    <img class="card-img-top" src="{{ asset('storage/products/' . $item->fileName) }}"
                                        alt="{{ $item->proname }}" style="max-height:300px; object-fit:contain;" />
                                </div>

                                <div class="card-body p-2">
                                    <div class="text-center">
                                        <h4 class="fw-bolder">{{ $item->proname }}</h4>
                                    </div>
                                </div>
                            </a>

                            <!-- Footer: giá + mô tả -->
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
                    </div>
                @empty
                    <p>Không có sản phẩm nào trong danh mục này.</p>
                @endforelse
            </div>

            {{-- Phân trang --}}
            @if ($products->hasPages())
                <style>
                    .pagination-wrapper {
                        display: flex;
                        justify-content: center;
                        margin-top: 20px;
                    }

                    .pagination {
                        display: flex;
                        list-style: none;
                        gap: 6px;
                        padding: 0;
                        margin: 0;
                    }

                    .pagination li {
                        display: inline-flex;
                    }

                    .pagination a,
                    .pagination span {
                        padding: 8px 14px;
                        border: 1px solid #ddd;
                        border-radius: 6px;
                        font-size: 14px;
                        text-decoration: none;
                        color: #007bff;
                        background: #fff;
                        transition: all 0.2s ease;
                    }

                    .pagination a:hover {
                        background: #f0f8ff;
                        border-color: #007bff;
                    }

                    .pagination .active span {
                        background: #007bff;
                        border-color: #007bff;
                        color: #fff;
                        font-weight: bold;
                    }

                    .pagination .disabled span {
                        color: #aaa;
                        background: #f9f9f9;
                        cursor: not-allowed;
                    }
                </style>

                <div class="pagination-wrapper">
                    <ul class="pagination">
                        {{-- Previous --}}
                        @if ($products->onFirstPage())
                            <li class="disabled"><span>‹</span></li>
                        @else
                            <li><a href="{{ $products->previousPageUrl() }}">‹</a></li>
                        @endif

                        {{-- Các số trang --}}
                        @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $products->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($products->hasMorePages())
                            <li><a href="{{ $products->nextPageUrl() }}">›</a></li>
                        @else
                            <li class="disabled"><span>›</span></li>
                        @endif
                    </ul>
                </div>
            @endif

        </div>
    </section>
@endsection
