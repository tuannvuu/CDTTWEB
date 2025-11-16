<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // <-- QUAN TRỌNG: Phải import Order
use App\Models\ShippingAddress; // <-- QUAN TRỌNG: Phải import ShippingAddress
use App\Models\User;

class UserClientController extends Controller
{
    /**
     * Hiển thị form đăng nhập.
     */
    public function login()
    {
        // Giữ nguyên code đã sửa cho trang login
        return view('admin.users.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function loginpost(Request $request)
    {
        // (Đây là code ví dụ, bạn nên có logic của riêng mình)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('homepage'); // Chuyển hướng về trang chủ
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }


    /**
     * Hiển thị trang hồ sơ người dùng VÀ lịch sử đơn hàng.
     * ĐÂY LÀ HÀM ĐÃ SỬA ĐỂ GIẢI QUYẾT LỖI
     */
    public function profile()
    {
        // 1. Lấy user đang đăng nhập
        $user = Auth::user();

        // 2. Lấy TẤT CẢ đơn hàng của user này
        // (Sử dụng khóa ngoại 'customerid' như trong Model Order)
        $orders = Order::where('customerid', $user->id)
            ->with('items') // Tải 'items' để đếm
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Lấy TẤT CẢ địa chỉ của user này
        // (Sử dụng khóa ngoại 'user_id' như trong tệp profile.blade.php)
        $shippingAddresses = [];
        try {
            // Thử lấy địa chỉ
            $shippingAddresses = ShippingAddress::where('user_id', $user->id)
                ->orderBy('is_default', 'desc')
                ->get();
        } catch (\Exception $e) {
            // Nếu có lỗi (ví dụ: bảng shipping_addresses không tồn tại),
            // cứ để là mảng rỗng và báo lỗi ra log
            \Log::error("Không thể lấy địa chỉ giao hàng: " . $e->getMessage());
        }


        // 4. Truyền cả 3 biến sang view
        // Dòng này sẽ sửa lỗi "Undefined variable $orders"
        return view('client.users.profile', compact('user', 'orders', 'shippingAddresses'));
    }

    /**
     * Hiển thị form reset mật khẩu
     */
    public function showResetForm($id)
    {
        $user = User::findOrFail($id);
        // (Đảm bảo bạn có view 'client.users.resetpass')
        // return view('client.users.resetpass', compact('user'));
    }

    /**
     * Xử lý reset mật khẩu
     */
    public function handleReset(Request $request, $id)
    {
        // $request->validate(['password' => 'required|confirmed|min:6']);
        // $user = User::findOrFail($id);
        // $user->password = bcrypt($request->password);
        // $user->save();
        // return redirect()->route('user.profile')->with('success', 'Đổi mật khẩu thành công!');
    }
}