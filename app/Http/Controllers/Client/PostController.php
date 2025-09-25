<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class PostController extends Controller
{
    public function create()
    {
        // lấy danh mục để user chọn khi đăng tin
        $categories = Category::all();
        return view('client.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'required|string',
            'cateid'      => 'required|integer',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // lưu ảnh
        $imagePath = $request->file('image')->store('products', 'public');

        // lưu sản phẩm vào db
        Product::create([
            'name'        => $request->title,
            'price'       => $request->price,
            'description' => $request->description,
            'cateid'      => $request->cateid,
            'proimage'    => $imagePath,
        ]);

        return redirect()->route('homepage')->with('success', 'Tin đã được đăng!');
    }
}
