<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer; // ✅ ĐÃ THÊM: Cần thiết để sử dụng trong hàm save

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

        $requestedQuantity = (int) $req->input('quantity', 1);

        if ($requestedQuantity <= 0) {
            $requestedQuantity = 1;
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $requestedQuantity;
        } else {
            $cart[$product->id] = [
                'productid' => $product->id,
                'proname' => $product->proname,
                'quantity' => $requestedQuantity,
                'price' => $product->price,
                'fileName' => $product->fileName ? $product->fileName : 'no-image.jpg',
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('mess', 'Đã thêm ' . $requestedQuantity . ' sản phẩm vào giỏ hàng');
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
    // HÀM MỚI ĐÃ SỬA:
    public function checkout()
    {
        // ✅ THÊM: Đảm bảo user đã đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cartshow')->with('error', 'Giỏ hàng trống, vui lòng thêm sản phẩm.');
        }

        $total = 0;
        $totalQuantity = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $totalQuantity += $item['quantity'];
        }

        // ✅ THÊM: Lấy thông tin user
        $user = auth()->user();

        // ✅ SỬA: Truyền 'user' vào view
        return view('client.cart.checkout', compact('cart', 'total', 'totalQuantity', 'user'));
    }


    // 💾 Lưu đơn hàng vào DB
    // app/Http/Controllers/Client/CartController.php

    public function save(Request $request)
    {
        try {

            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return redirect()->back()->with('error', 'Giỏ hàng trống!');
            }

            // Validate
            $request->validate([
                'fullname' => 'required|string|max:255',
                'tel' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'payment_method' => 'required|string',
                'description' => 'nullable|string'
            ]);

            // Tính tổng
            $total = collect($cart)->reduce(
                fn($carry, $item) =>
                $carry + ($item['price'] * $item['quantity']),
                0
            );

            // ⭐ Tạo đơn hàng
            $order = Order::create([
                'customerid' => auth()->id(),

                // SỬA LẠI CÁC DÒNG NÀY
                'fullname' => $request->fullname,   // <-- Sửa từ 'shipping_name'
                'tel' => $request->tel,           // <-- Sửa từ 'shipping_phone'
                'address' => $request->address,       // <-- Sửa từ 'shipping_address'

                'payment_method' => $request->payment_method,
                'total' => $total,
                'description' => $request->description ?? 'Không có ghi chú',
                'status' => 'pending',
                'orderdate' => now()
            ]);

            // ⭐ Lưu từng sản phẩm vào orderitems
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'orderid' => $order->id,
                    'productid' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
            // Xóa giỏ
            session()->forget('cart');
            return redirect()->route('cart.thankyou')
                ->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            \Log::error('Order creation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    // 💳 Thanh toán qua ngân hàng
    public function bank($order_id)
    {
        $order = Order::findOrFail($order_id);

        $bankData = [
            'bank_name' => 'Vietcombank',
            'account_no'  => '0796573363',
            'account_name' => 'Nguyễn Tuấn Vũ',
            'amount'  => $order->total, // ✅ GIỮ NGUYÊN $order->total
            'qr_image' => asset('storage/payments/qr-bank.png'),
        ];

        return view('client.payment.bank', compact('bankData', 'order_id', 'order'));
    }

    // 📱 Thanh toán qua Momo
    public function momo($order_id)
    {
        $order = Order::with('items')->findOrFail($order_id);

        $momoData = [
            'phone' => '0796573363',
            'wallet_name' => 'Nguyễn Tuấn Vũ',
            'amount'  => $order->total, // ✅ GIỮ NGUYÊN $order->total
            'qr_image' => asset('storage/payments/qr-momo.png'),
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
            'productid' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->productid;
        $quantity = (int) $request->quantity;

        // 2. Kiểm tra và cập nhật Session
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);

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
                'message' => 'Cập nhật giỏ hàng thành công!',
                'subtotal_formatted' => number_format($subtotal) . ' ₫',
                'total_formatted' => number_format($total) . ' ₫',
                'totalQuantity' => $totalQuantity,
            ]);
        }

        // Nếu không tìm thấy
        return response()->json(['error' => 'Sản phẩm không tìm thấy.'], 404);
    }
}