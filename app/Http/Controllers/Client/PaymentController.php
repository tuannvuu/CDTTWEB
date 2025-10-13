<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PaymentController extends Controller
{
    public function bank($order_id)
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        $bankData = [
            'bank_name' => 'Vietcombank',
            'account_no' => '0123456789',
            'account_name' => 'Công ty ABC',
            'amount' => $total,
            'qr_image' => asset('storage/payments/qr-bank.png'), // đảm bảo ảnh tồn tại
        ];

        return view('client.payment.bank', compact('bankData', 'order_id'));
    }

    public function momo($order_id)
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        $momoData = [
            'phone' => '0909123456',
            'wallet_name' => 'Công ty ABC',
            'amount' => $total,
            'qr_image' => asset('storage/payments/qr-momo.png'), // đảm bảo ảnh tồn tại
        ];

        return view('client.payment.momo', compact('momoData', 'order_id'));
    }


    public function vnpay($order_id)
    {
        $order = Order::findOrFail($order_id);

        $vnpayData = [
            'payment_url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
            'amount' => $order->total,
            'order_id' => $order_id,
        ];

        return view('client.payment.vnpay', compact('vnpayData'));
    }
}