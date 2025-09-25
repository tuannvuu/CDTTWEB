<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy 5 sản phẩm mới nhất
        $latestProducts = Product::orderByDesc('id')->take(5)->get();

        // Truyền dữ liệu qua view
        return view('admin.dashboard', ['products' => $latestProducts]);
    }

    public function getData()
    {
        $users = \App\Models\User::all(); // giữ nguyên nếu cần cho mục đích khác
        return response()->json($users);
    }
}
