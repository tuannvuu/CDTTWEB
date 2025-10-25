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
         if (auth()->user()->role != 1) {
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang admin.');
    }
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
    try {
        // Debug
        \Log::info('=== STORE PRODUCT START ===');
        \Log::info('Request data:', $request->all());
        \Log::info('Has file: ' . ($request->hasFile('fileName') ? 'YES' : 'NO'));

        $request->validate([
            'proname' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brandid' => 'required|integer|exists:brands,id',
            'cateid' => 'required|integer|exists:categories,cateid',
            'description' => 'nullable|string',
            'fileName' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'stock_quantity' => 'required|integer|min:0', // ✅ THÊM VALIDATION NÀY
        ]);

        // Xử lý file
        $file = $request->file('fileName');
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        \Log::info('File name: ' . $fileName);
        
        // Lưu file
        $file->storeAs('products', $fileName, 'public');
        
        \Log::info('File stored successfully');

        // Tạo sản phẩm
        $product = Product::create([
            'proname' => $request->proname,
            'price' => $request->price,
            'brandid' => $request->brandid,
            'cateid' => $request->cateid,
            'description' => $request->description,
            'fileName' => $fileName,
            'stock_quantity' => $request->stock_quantity, // ✅ THÊM DÒNG NÀY
        ]);

        \Log::info('Product created with ID: ' . $product->id);
        \Log::info('=== STORE PRODUCT END ===');

        return redirect()->route('ad.pro.index')
            ->with('success', 'Thêm sản phẩm thành công!');

    } catch (\Exception $e) {
        \Log::error('STORE PRODUCT ERROR: ' . $e->getMessage());
        return back()
            ->with('error', 'Lỗi: ' . $e->getMessage())
            ->withInput();
    }
}


   public function update(Request $request, $id)
{
    try {
        \Log::info('=== UPDATE PRODUCT START ===');
        \Log::info('Product ID: ' . $id);
        \Log::info('Request data:', $request->all());

        $product = Product::findOrFail($id);

        $request->validate([
            'proname' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brandid' => 'required|integer|exists:brands,id',
            'cateid' => 'required|integer|exists:categories,cateid',
            'description' => 'nullable|string',
            'fileName' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
            'stock_quantity' => 'required|integer|min:0', // ✅ THÊM VALIDATION NÀY
        ]);

        $data = [
            'proname' => $request->proname,
            'price' => $request->price,
            'brandid' => $request->brandid,
            'cateid' => $request->cateid,
            'description' => $request->description,
            'stock_quantity' => $request->stock_quantity, // ✅ THÊM DÒNG NÀY
        ];

        // Xử lý ảnh mới
        if ($request->hasFile('fileName')) {
            \Log::info('Has new file');
            
            // Xóa ảnh cũ
            if ($product->fileName && Storage::disk('public')->exists('products/' . $product->fileName)) {
                Storage::disk('public')->delete('products/' . $product->fileName);
            }

            $file = $request->file('fileName');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('products', $fileName, 'public');
            
            $data['fileName'] = $fileName;
            \Log::info('New file name: ' . $fileName);
        }

        $product->update($data);

        \Log::info('Product updated successfully');
        \Log::info('=== UPDATE PRODUCT END ===');

        return redirect()->route('ad.pro.edit', $id)
            ->with('success', 'Cập nhật sản phẩm thành công!');

    } catch (\Exception $e) {
        \Log::error('UPDATE PRODUCT ERROR: ' . $e->getMessage());
        return back()
            ->with('error', 'Lỗi: ' . $e->getMessage())
            ->withInput();
    }
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
            if ($product->fileName && Storage::disk('public')->exists('products/' . $product->fileName)) {
                Storage::disk('public')->delete('products/' . $product->fileName);
            }

            $product->delete();
            $message = 'Xóa thành công';
        } catch (Throwable $th) {
            $message = 'Xóa thất bại - Lỗi: ' . $th->getMessage();
        }

        return redirect()->route('ad.pro.index')->with('message', $message);
    }
}