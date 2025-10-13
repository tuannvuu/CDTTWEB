<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandClientController extends Controller
{
    public function index()
    {
        // Lấy thương hiệu và phân trang
        $brands = Brand::paginate(8); // 8 thương hiệu mỗi trang
        return view('client.brands.index', compact('brands'));
    }
}