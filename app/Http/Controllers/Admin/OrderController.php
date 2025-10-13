<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function show($id)
    {
        // Chỉ truyền $order, không truyền $orders
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function index()
    {
        // Trang danh sách mới cần $orders
        $orders = Order::with(['customer', 'items'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('ad.orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}
