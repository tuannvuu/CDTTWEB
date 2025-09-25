<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;


class CartController extends Controller
{
public function show()
{
    // Lấy dữ liệu giỏ hàng từ session
    $cart = session()->get('cart', []);
    // Truyền dữ liệu sang view (client/cart/cartshow.blade.php)
    return view('client.cart.cartshow', compact('cart'));
}
    public function add(Request $req)
    {
        // lấy id từ URL (Xem đường dẫn -> devtool)
        $id = $req->route('id');
        // Lấy product trong db
        $product = Product::where("id", $id)->first();
        // lấy giỏ hàng từ session, nếu chưa tồn tại trả về mảng rỗng
        $cart = Session::get('cart', []);
        // kiểm tra xem giỏ hàng có id sản phẩm chưa
        if (isset($cart[$id])) {
            // nếu tồn tại rồi - tăng số lượng
            $cart[$id]['quantity'] += 1;
        } else {
            // nếu chưa tồn tại - tạo thêm sản phẩm
            $cart[$id] = [
                'productid' => $product->id,
                'proname' => $product->proname,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }
        // lưu lại vào session
        Session::put('cart', $cart);
        // điều hướng về trang trước
        return redirect()->back();
    }

    public function del($id)
    {
        // lấy giỏ hàng từ session, nếu chưa tồn tại trả về mảng rỗng
        $cart = Session::get('cart', []);
        // kiểm tra xem giỏ hàng có id sản phẩm chưa
        if (isset($cart[$id])) {
            // nếu tồn tại rồi - tăng số lượng
            unset($cart[$id]);
        }
        // lưu lại vào session
        Session::put('cart', $cart);
        // điều hướng về trang trước
        return redirect()->back();
    }

    public function save(Request $req)
    {
        // kiểm tra dữ liệu đầu vào dùng validate
        // lấy giỏ hàng từ session,
        $cart = Session::get('cart');
        // kiểm tra giỏ hàng có tồn tại không
        if (empty($cart)) {
            // điều hướng về trang trước với mess
            return redirect()->back()->with('mess', 'Không tồn tại giỏ hàng');
        }
        // kiểm tra bảng customer có tồn tại số điện thoại chưa
        $customer = Customer::where('tel', $req->tel)->first();
        $customerid = null;
        if (empty($customer)) {
            // nếu chưa thì thêm vào DB
            $cusafterinsert = Customer::create(
                [
                    'fullname' => $req->fullname,
                    'tel' => $req->tel,
                    'address' => $req->address
                ]
            );
            $customerid = $cusafterinsert->id;
        } else $customerid = $customer->id;
        // lưu vào bảng orders
        $order = Order::create(
            [
                'customerid' => $customerid,
                'description' => $req->description ?? '',
            ]
        );
        $orderid = $order->id;
        // lưu vào bảng orderitems
        foreach ($cart as $item) {
            OrderItem::create([
                'orderid' => $orderid,
                'productid' => $item['productid'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }
        // xóa giỏ hàng trong sess
        Session::forget('cart');
        // điều hướng về trang trước với mess (session)
        return redirect()->back()
            ->withInput()->with('mess', 'Đặt hàng thành công. Anh/chị vui lòng đợi nhân viên liên hệ để xác nhận');
    }
}
