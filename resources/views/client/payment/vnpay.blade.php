@extends('layout.client')

@section('content')
    <div class="container py-4">
        <h3 class="mb-3">Thanh toán qua VNPAY</h3>

        <p>Bạn sẽ được chuyển đến cổng thanh toán VNPAY để hoàn tất giao dịch.</p>

        <form action="https://sandbox.vnpayment.vn/paymentv2/vpcpay.html" method="POST">
            <!-- Demo: chỗ này bạn cần cấu hình thêm nếu tích hợp VNPAY thật -->
            <input type="hidden" name="order_id" value="{{ $order_id }}">
            <button type="submit" class="btn btn-primary">Thanh toán với VNPAY</button>
        </form>
    </div>
@endsection
