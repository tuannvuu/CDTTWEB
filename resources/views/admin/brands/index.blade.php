@extends('layout.admin')

@section('title', 'Thương hiệu')

@section('content')
    <div class="container mt-4">
        <x-alert></x-alert>

        <!-- Header với nút thêm mới -->

        <div id="list">
            @include('admin.brands.list')
        </div>
    </div>

    <!-- Chỉ giữ lại components cần thiết -->
    <x-ajax-pagination></x-ajax-pagination>
@endsection
