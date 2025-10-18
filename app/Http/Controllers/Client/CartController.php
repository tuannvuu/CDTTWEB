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
    // ➕ Thêm sản phẩm vào giỏ hàng (ĐÃ SỬA ĐỂ LẤY SỐ LƯỢNG)
    public function add(Request $req) // Giữ nguyên Request $req
    {
        $auth = auth();
        if (!$auth->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }

        $id = $req->route('id'); // Lấy id sản phẩm từ route
        $product = Product::findOrFail($id);

        // 👇 Lấy số lượng từ form gửi lên (name="quantity"), mặc định là 1 nếu không có
        $requestedQuantity = (int) $req->input('quantity', 1);
        // Đảm bảo số lượng không âm
        if ($requestedQuantity <= 0) {
            $requestedQuantity = 1;
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            // ✅ ĐÚNG: Cộng thêm số lượng yêu cầu
            $cart[$product->id]['quantity'] += $requestedQuantity;
        } else {
            // ✅ ĐÚNG: Thêm mới với số lượng yêu cầu
            $cart[$product->id] = [
                'productid' => $product->id,
                'proname'   => $product->proname,
                'quantity'  => $requestedQuantity, // <-- Dùng số lượng yêu cầu
                'price'     => $product->price,
                'fileName'  => $product->fileName ? $product->fileName : 'no-image.jpg',
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('mess', 'Đã thêm ' . $requestedQuantity . ' sản phẩm vào giỏ hàng'); // Thêm thông báo số lượng
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
                'productid' => $item['productid'],
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
        // 1. Validate dữ liệu
        $request->validate([
            'productid' => 'required', // Tên key phải là 'productid'
            'quantity'  => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->productid; // Lấy 'productid'
        $quantity = (int) $request->quantity;

        // 2. Kiểm tra và cập nhật Session
        if (isset($cart[$productId])) { // Dùng $productId làm key
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart); // Lưu lại session

            // 3. Tính toán lại giá trị mới
            $subtotal = $cart[$productId]['price'] * $quantity;

            $total = 0;
            $totalQuantity = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
                $totalQuantity += $item['quantity'];
            }

            // 4. Trả về JSON cho JavaScript
            return response()->json([
                'message'            => 'Cập nhật giỏ hàng thành công!',
                'subtotal_formatted' => number_format($subtotal) . ' ₫',
                'total_formatted'    => number_format($total) . ' ₫',
                'totalQuantity'      => $totalQuantity,
            ]);
        }

        // Nếu không tìm thấy
        return response()->json(['error' => 'Sản phẩm không tìm thấy.'], 404);
    }
}