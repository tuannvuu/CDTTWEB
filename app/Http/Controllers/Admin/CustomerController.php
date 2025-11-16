<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// SỬA: Bỏ "Customer" và dùng "User"
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != 1) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang admin.');
        }

        // SỬA: Lấy dữ liệu từ Model "User" thay vì "Customer"
        // Chúng ta cũng lọc để chỉ lấy user không phải là admin (role != 1)
        $customers = User::where('role', '!=', 1)
            ->with('orders') // Giữ lại 'orders' để đếm
            ->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }
}