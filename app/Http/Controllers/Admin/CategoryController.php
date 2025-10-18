<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $list = Category::with('products')
            ->orderByRaw("CASE WHEN LOWER(TRIM(catename)) = 'tất cả danh mục' THEN 1 ELSE 0 END, catename ASC")
            ->paginate(6);

        if ($request->ajax()) {
            return view("admin.categories.list", compact("list"));
        }
        return view("admin.categories.index", compact("list"));
    }

    public function create()
    {
        return view("admin.categories.create");
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename',
            ],
            [
                'catename.required' => ':attribute không được để trống',
                'catename.min' => ':attribute có ít nhất :min ký tự',
                'catename.max' => ':attribute không vượt quá :max ký tự',
                'catename.unique' => ':attribute đã tồn tại trong hệ thống',
            ],
            [
                'catename' => 'Tên loại sản phẩm/danh mục',
            ]
        );

        try {
            Category::create($request->only(['catename', 'description']));
            $message = 'Thêm thành công';
        } catch (Throwable $th) {
            $message = 'Thêm thất bại - Lỗi: ' . $th->getMessage();
        }

        return redirect()->route('ad.cate.create')->withInput()->with('message', $message);
    }

    public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.categories.edit', compact('category'));
}


public function update(Request $request, Category $category)
{
    $request->validate(
        [
            'catename' => 'required|min:3|max:100|unique:categories,catename,' . $category->cateid . ',cateid',
        ],
        [
            'catename.required' => ':attribute không được để trống',
            'catename.min' => ':attribute có ít nhất :min ký tự',
            'catename.max' => ':attribute không vượt quá :max ký tự',
            'catename.unique' => ':attribute đã tồn tại trong hệ thống',
        ],
        [
            'catename' => 'Tên loại sản phẩm/danh mục',
        ]
    );

    try {
        $category->update($request->only(['catename', 'description']));
    } catch (\Throwable $th) {
        return back()->with('error', 'Cập nhật thất bại - ' . $th->getMessage());
    }

    // ✅ Đây là dòng quan trọng — phải dùng đúng 'id' => $category->cateid
 return redirect()->route('ad.cate.edit', $category)
    ->with('success', 'Cập nhật danh mục thành công!');

}






    public function delete(Category $category)
    {
        try {
            $category->delete();
            $message = 'Xóa thành công';
        } catch (Throwable $th) {
            $message = 'Xóa thất bại - Lỗi: ' . $th->getMessage();
        }

        return redirect()->route('ad.cate.index')->with('message', $message);
    }
}
