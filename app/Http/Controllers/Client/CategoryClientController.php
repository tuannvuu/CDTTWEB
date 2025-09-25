<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryClientController extends Controller
{
    // Hiển thị các sản phẩm thuộc danh mục
 public function detail($id)
{
    if ($id == 12) { // 12 là cateid của "Tất cả danh mục"
        // Lấy tất cả sản phẩm
        $products = Product::paginate(20); // hoặc all()
        $category = (object)[
            'catename' => 'Tất cả danh mục'
        ];
    } else {
        // Lấy sản phẩm theo danh mục
        $category = Category::with('products')->findOrFail($id);
        $products = $category->products()->paginate(20); // hoặc $category->products nếu không paginate
    }
    $categories = Category::orderBy('catename', 'asc')->get();

    return view('client.categories.detail', compact('category', 'categories', 'products'));
}
    public function all()
    {
        $categoryList = Category::orderBy('catename', 'asc')->paginate(12);
    
        return view('client.categories.all', compact('categoryList'));
    }
    

}
