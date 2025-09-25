<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $listpro = Product::orderByDesc("id")->limit(12)->get();
        $categories = Category::orderBy("catename", "asc")->get();

        return view("client.index", [
            "listpro" => $listpro,
            "categories" => $categories
        ]);
    }
}
