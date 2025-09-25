@extends('layout.client')
@section('content')
    @php
        // get giỏ hàng từ session
        $cart = Session::get('cart', []);
        $total = 0;
    @endphp
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <h3>Thông tin giỏ hàng</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <td>STT</td>
                    <td>Sản phẩm</td>
                    <td>Số lượng</td>
                    <td>Giá </td>
                    <td>Thành tiền</td>
                    <td></td>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        @php
                            $total += $item['price'] * $item['quantity'];
                        @endphp
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            {{-- do $cart là kiểu mảng nên để get dữ liệu sử dụng ['key'] --}}
                            <td>{{ $item['proname'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price']) }}</td>
                            <td>{{ number_format($item['price'] * $item['quantity']) }}</td>
                            <td><a href="{{ route('cartdel', ['id' => $item['productid']]) }}">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">Tổng tiền</td>
                        <td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><a href="{{ route('checkout') }}" class="btn btn-warning">Đặt hàng</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
