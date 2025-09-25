<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{
    // Hiển thị chi tiết sản phẩm
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('client.products.detail', compact('product'));
    }

    // Tìm kiếm sản phẩm
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('proname', 'like', '%' . $keyword . '%')->get();

        return view('client.products.search', compact('products', 'keyword'));
    }

    // Hiển thị tất cả sản phẩm (optional)
    public function index()
{
    $products = Product::orderBy('id', 'asc')->paginate(12);
    return view('client.products.index', compact('products'));
}


}
