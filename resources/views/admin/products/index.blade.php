@extends('layout.admin')

@section('title', 'Sản phẩm')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Danh sách sản phẩm</h3>
        <x-alert></x-alert>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pro.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>

            <div class="d-flex align-items-center">
                <label for="perPageSelect" class="me-2 mb-0">Số bản ghi trên trang:</label>
                <select id="perPageSelect" class="form-select" style="width: auto;"
                    onchange="window.location.href=this.value">
                    <option value="{{ route('pro.index', 5) }}" {{ $perpage == 5 ? 'selected' : '' }}>5</option>
                    <option value="{{ route('pro.index', 10) }}" {{ $perpage == 10 ? 'selected' : '' }}>10</option>
                    <option value="{{ route('pro.index', 15) }}" {{ $perpage == 15 ? 'selected' : '' }}>15</option>
                    <option value="{{ route('pro.index', 100) }}" {{ $perpage == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Loại</th>
                        <th>Thương hiệu</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->catename }}</td>
                            <td>{{ $item->brand->brandname }}</td>
                            <td>{{ $item->productname }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                            <td>
                                @php
                                    $imagePath = 'storage/products/h' . $item->id . '.jpg';
                                @endphp
                                @if (file_exists(public_path($imagePath)))
                                    <img src="{{ asset($imagePath) }}" alt="{{ $item->productname }}"
                                        class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                                @else
                                    <img src="{{ asset('storage/products/default.jpg') }}" alt="Ảnh mặc định"
                                        class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pro.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                                    <form action="{{ route('pro.delete', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>

                                    {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#confirmdelete" data-info="{{ $item->productname }}"
                                        data-action="{{ route('pro.delete', $item->id) }}">
                                        Xóa (modal)
                                    </button> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $list->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <x-modal></x-modal>
@endsection
