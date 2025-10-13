<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

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
    public function index(Request $request)
    {
        // Mỗi lần load sẽ random lại danh sách
        $randomProducts = Product::all()->shuffle()->values();

        // Lấy số trang hiện tại
        $page = $request->input('page', 1);
        $perPage = 12;

        // Cắt dữ liệu theo trang
        $pagedData = $randomProducts->slice(($page - 1) * $perPage, $perPage);

        // Tạo pagination thủ công
        $products = new LengthAwarePaginator(
            $pagedData,
            $randomProducts->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('client.products.index', compact('products'));
    }
    public function newProducts(Request $request)
    {
        // Lấy sản phẩm mới nhất, sắp xếp theo created_at (mới thêm vào DB)
        $products = Product::orderBy('created_at', 'desc')
            ->paginate(12); // mỗi trang 12 sản phẩm

        return view('client.products.new', compact('products'));
    }
}