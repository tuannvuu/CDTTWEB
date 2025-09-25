@extends('layout.client')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">Tất cả danh mục</h2>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
        @foreach ($categories as $item)
            <div class="col">
                <a href="{{ route('category', ['id' => $item->cateid]) }}" 
                   class="text-decoration-none text-center d-block p-3 shadow-sm rounded-4 h-100">
                    @php
                        $imagePath = 'storage/categories/' . $item->cateimage;
                    @endphp
                    @if ($item->cateimage && file_exists(public_path($imagePath)))
                        <img src="{{ asset($imagePath) }}" 
                             alt="{{ $item->catename }}" 
                             class="img-fluid mb-2 rounded-3" 
                             style="max-height:80px; object-fit:contain;">
                    @else
                        <img src="{{ asset('storage/categories/default.jpg') }}" 
                             alt="Ảnh mặc định" 
                             class="img-fluid mb-2 rounded-3" 
                             style="max-height:80px; object-fit:contain;">
                    @endif

                    <span class="fw-bold text-dark">{{ $item->catename }}</span>
                </a>
            </div>
        @endforeach
    </div>

    <!-- ✅ Phân trang -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}      
    </div>
</div>
@endsection
