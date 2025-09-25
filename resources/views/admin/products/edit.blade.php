@extends('layout.admin')

@section('title', 'Sản phẩm - Cập nhật')

@section('content')
    <div class="container mt-4">
        <h2>Cập nhật sản phẩm</h2>

        <x-alert></x-alert>

        <form action="{{ route('pro.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $item)
                        {{ $item }} <br>
                    @endforeach
                </div>
            @endif

            <div class="mb-3">
                <label for="proname" class="form-label">Tên sản phẩm</label>
                <input type="text" name="proname" class="form-control" value="{{ old('proname', $product->proname) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                    required step="0.01" min="0">
            </div>

            <div class="mb-3">
                <label for="brandid" class="form-label">Thương hiệu</label>
                <select name="brandid" class="form-select" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $product->brandid == $brand->id ? 'selected' : '' }}>
                            {{ $brand->brandname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="cateid" class="form-label">Loại sản phẩm</label>
                <select name="cateid" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->cateid }}"
                            {{ $product->cateid == $category->cateid ? 'selected' : '' }}>
                            {{ $category->catename }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="f-des" class="form-label">Mô tả</label>
                <textarea name="description" id="f-des" rows="3" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- ✅ Phần ảnh đã sửa --}}
            <div class="mb-3">
                <label for="fileName" class="form-label">Ảnh sản phẩm:</label>
                <input type="file" name="fileName" class="form-control">

                @php
                    $imagePath = null;

                    if ($product->fileName && file_exists(public_path('storage/products/' . $product->fileName))) {
                        $imagePath = 'storage/products/' . $product->fileName;
                    } else {
                        // Ẩn ảnh nếu không có file thật sự (không dùng ảnh mặc định)
                        $imagePath = null;
                    }
                @endphp

                @if ($imagePath)
                    <div class="mt-2">
                        <img src="{{ asset($imagePath) }}" alt="{{ $product->proname }}" class="img-thumbnail"
                            style="max-width: 150px; max-height: 150px;">
                    </div>
                @endif

            </div>

            <a href="{{ route('pro.index') }}" class="btn btn-success">← Quay lại</a>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
