@extends('layout.client')

@section('title', 'Trang chủ')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <h2 class="fw-bold">Sản phẩm mới nhất</h2>
    {{-- List sản phẩm --}}
@endsection

@section('footer')
    @include('partials.footer')
@endsection
