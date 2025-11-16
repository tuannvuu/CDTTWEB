<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class InventoryController extends Controller
{
    public function index()
    {
         if (auth()->user()->role != 1) {
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang admin.');
    }
        $products = Product::select('id', 'proname', 'stock_quantity', 'price')
            ->paginate(10); // mỗi trang 10 sản phẩm
        return view('admin.inventory.index', compact('products'));
    }
}