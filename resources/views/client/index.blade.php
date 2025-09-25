@extends('layout.client')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($listpro as $item)
                    <div class="col mb-3">
                        <div class="card h-100 position-relative">

                            <!-- ✅ Link bao phủ toàn bộ card -->
                            <a href="{{ route('client.products.detail', $item->id) }}"
                                class="stretched-link text-decoration-none text-dark">

                                <div>
                                    <img class="card-img-top" src="{{ asset('storage/products/' . $item->fileName) }}"
                                        alt="{{ $item->proname }}" style="max-height:300px; object-fit:contain;" />
                                </div>

                                <!-- Product details-->
                                <div class="card-body p-2">
                                    <div class="text-center">
                                        <h4 class="fw-bolder">{{ $item->proname }}</h4>
                                    </div>
                                </div>
                            </a>

                            <!-- ✅ Footer: hiển thị giá + mô tả -->
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
                @endforeach
            </div>
        </div>
    </section>
@endsection
