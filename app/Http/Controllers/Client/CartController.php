<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    // 🛒 Hiển thị giỏ hàng
    public function show()
    {
        $cart = session()->get('cart', []);

        $total = 0;
        $totalQuantity = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $totalQuantity += $item['quantity'];
        }

        return view('client.cart.cartshow', compact('cart', 'total', 'totalQuantity'));
    }

    // ➕ Thêm sản phẩm vào giỏ hàng
   public function add(Request $req)
    {
        $auth = auth();

        if (!$auth->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }

        $id = $req->route('id');
        $product = Product::findOrFail($id);

        // ✅ Lấy giỏ hàng hiện tại (nếu có)
        $cart = Session::get('cart', []);

        // ✅ Nếu sản phẩm đã có thì tăng số lượng
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            // ✅ Nếu chưa có, thêm mới vào giỏ hàng
            $cart[$product->id] = [
                'productid' => $product->id,
                'proname'   => $product->proname,
                'quantity'  => 1,
                'price'     => $product->price,
                'fileName'  => $product->image ?? 'no-image.png',
            ];
        }

        // ✅ Lưu lại giỏ hàng mới
        Session::put('cart', $cart);

        return redirect()->back()->with('mess', 'Đã thêm sản phẩm vào giỏ hàng');
    }
    // ❌ Xoá sản phẩm khỏi giỏ hàng
    public function del($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('mess', 'Đã xoá sản phẩm khỏi giỏ hàng');
    }

    // 🧾 Trang thanh toán (checkout)
   // 🧾 Trang thanh toán (checkout)
public function checkout()
{
    // ✅ Lấy giỏ hàng hiện tại
    $cart = session()->get('cart', []);

    // Nếu giỏ hàng trống → quay lại
    if (empty($cart)) {
        return redirect()->route('cart.show')->with('error', 'Giỏ hàng trống, vui lòng thêm sản phẩm.');
    }

    // ✅ Tính tổng tiền và số lượng
    $total = 0;
    $totalQuantity = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
        $totalQuantity += $item['quantity'];
    }

    // ✅ Trả ra view với toàn bộ giỏ hàng
    return view('client.cart.checkout', compact('cart', 'total', 'totalQuantity'));
}


    // 💾 Lưu đơn hàng vào DB
    public function save(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cartshow')->with('error', 'Giỏ hàng trống, không thể đặt hàng.');
        }

        // ✅ Tính tổng tiền
        $total = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        // ✅ Tạo đơn hàng
        $order = Order::create([
            'customerid'     => auth()->check() ? auth()->id() : 0,
            'fullname'       => $request->fullname,
            'tel'            => $request->tel,
            'address'        => $request->address,
            'description'    => $request->description ?? 'Không có ghi chú',
            'payment_method' => $request->payment_method,
            'total'          => $total,
        ]);

        // ✅ Lưu từng sản phẩm vào bảng order_items
        foreach ($cart as $item) {
            OrderItem::create([
                'orderid'  => $order->id,
                'productid'=> $item['productid'],
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // ✅ Xoá giỏ hàng sau khi đặt hàng
        session()->forget('cart');

        // ✅ Điều hướng theo phương thức thanh toán
        return match ($request->payment_method) {
            'bank'  => redirect()->route('payment.bank', ['order_id' => $order->id]),
            'momo'  => redirect()->route('payment.momo', ['order_id' => $order->id]),
            'vnpay' => redirect()->route('payment.vnpay', ['order_id' => $order->id]),
            default => redirect()->route('order.success', ['order_id' => $order->id])
                ->with('success', 'Đặt hàng thành công, thanh toán khi nhận hàng.'),
        };
    }

    // 💳 Thanh toán qua ngân hàng
    public function bank($order_id)
    {
        $order = Order::findOrFail($order_id);

        $bankData = [
            'bank_name'    => 'Vietcombank',
            'account_no'   => '0796573363',
            'account_name' => 'Nguyễn Tuấn Vũ',
            'amount'       => $order->total,
            'qr_image'     => asset('storage/payments/qr-bank.png'),
        ];

        return view('client.payment.bank', compact('bankData', 'order_id', 'order'));
    }

    // 📱 Thanh toán qua Momo
    public function momo($order_id)
    {
        $order = Order::with('items')->findOrFail($order_id);

        $momoData = [
            'phone'        => '0796573363',
            'wallet_name'  => 'Nguyễn Tuấn Vũ',
            'amount'       => $order->total,
            'qr_image'     => asset('storage/payments/qr-momo.png'),
        ];

        return view('client.payment.momo', compact('momoData', 'order_id', 'order'));
    }

    // 💰 Thanh toán qua VNPay
    public function vnpay($order_id)
    {
        return view('client.payment.vnpay', compact('order_id'));
    }

    // ✅ Trang thông báo đặt hàng thành công
    public function success($order_id)
    {
        return view('client.payment.success', compact('order_id'));
    }

    // 🔄 Cập nhật số lượng giỏ hàng
   public function updateCart(Request $request)
{
    $cart = session()->get('cart', []);
    $id = $request->id; // phải là product_id
    $quantity = (int) $request->quantity;

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = max(1, $quantity);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.show')->with('mess', 'Đã cập nhật số lượng');
}



}
