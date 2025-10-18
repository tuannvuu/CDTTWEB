<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductController extends Controller
{
    public function index($perpage = 5)
    {
        $list = Product::with(['category', 'brand'])
            ->select('id', 'proname as productname', 'price', 'cateid', 'brandid', 'description', 'fileName') // ✅ Bỏ 'fileName'
            ->orderBy('id', 'asc')
            ->paginate($perpage);

        return view('admin.products.index', compact('list', 'perpage'));
    }

    public function create()
    {
        $categories = Category::orderBy('catename')->get();
        $brands = Brand::orderBy('brandname')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proname' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brandid' => 'required|integer',
            'cateid' => 'required|integer',
            'description' => 'nullable|string',
            'fileName' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);
        $file = $request->file('fileName');
        $fileName = Str::slug($request->proname) . '-' . time() . '.' . $file->getClientOriginalExtension();
        // ✅ Cách lưu chắc chắn hoạt động trên mọi hệ điều hành
        $destinationPath = storage_path('app/public/products');
        $file->move($destinationPath, $fileName);
        $product = new Product();
        $product->proname = $request->proname;
        $product->price = $request->price;
        $product->brandid = $request->brandid;
        $product->cateid = $request->cateid;
        $product->description = $request->description;
        // ✅ Lưu đúng đường dẫn cho asset('storage/...') dùng được
        $product->fileName = 'products/' . $fileName;
        $product->save();
        return redirect()->route('ad.pro.index')->with('success', 'Thêm sản phẩm thành công!');
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'proname' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brandid' => 'required|integer',
            'cateid' => 'required|integer',
            'description' => 'nullable|string',
            'fileName' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);

        $filePath = $product->fileName; // Giữ ảnh cũ

        if ($request->hasFile('fileName')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $file = $request->file('fileName');
            $fileName = Str::slug($request->proname) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $fileName, 'public');
            $filePath = 'products/' . $fileName;
        }

        $product->update([
            'proname' => $request->proname,
            'price' => $request->price,
            'cateid' => $request->cateid,
            'brandid' => $request->brandid,
            'description' => $request->description,
            'fileName' => $filePath,
        ]);

        return redirect()->route('ad.pro.edit', $id)->with('success', 'Cập nhật sản phẩm thành công!');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('catename')->get();
        $brands = Brand::orderBy('brandname')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }


    public function delete($id)
    {
        $message = null;
        try {
            $product = Product::findOrFail($id);

            // ✅ Xóa ảnh nếu tồn tại
            if ($product->fileName && Storage::disk('public')->exists($product->fileName)) {
                Storage::disk('public')->delete($product->fileName);
            }

            $product->delete();
            $message = 'Xóa thành công';
        } catch (Throwable $th) {
            $message = 'Xóa thất bại - Lỗi: ' . $th->getMessage();
        }

        return redirect()->route('ad.pro.index')->with('message', $message);
    }
}