<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Random + phân trang (12 sp / trang)
        $listpro = Product::inRandomOrder()->paginate(12);

        // Danh mục
        $categories = Category::orderBy("catename", "asc")->get();

        return view("client.index", [
            "listpro" => $listpro,
            "categories" => $categories
        ]);
    }
}
