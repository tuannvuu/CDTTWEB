<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->shippingAddresses()->get();
        $defaultAddress = Auth::user()->defaultAddress;
        
        return view('client.profile.shipping-addresses', compact('addresses', 'defaultAddress'));
    }

    public function create()
    {
        return view('client.profile.add-address');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'is_default' => 'sometimes|boolean'
        ]);

        // Nếu đánh dấu là mặc định, bỏ mặc định của các address khác
        if ($request->is_default) {
            Auth::user()->shippingAddresses()->update(['is_default' => false]);
        }

        // Nếu đây là address đầu tiên, tự động đặt làm mặc định
        $isFirstAddress = Auth::user()->shippingAddresses()->count() === 0;

        Auth::user()->shippingAddresses()->create([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_default' => $isFirstAddress || $request->is_default
        ]);

        return redirect('/account')->with('success', 'Đã thêm địa chỉ thành công!');
    }

    public function edit(ShippingAddress $shippingAddress)
    {
        // Kiểm tra quyền sở hữu
        if ($shippingAddress->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa địa chỉ này.');
        }

        return view('client.profile.edit-address', compact('shippingAddress'));
    }

    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        // Kiểm tra quyền sở hữu
        if ($shippingAddress->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật địa chỉ này.');
        }

        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'is_default' => 'sometimes|boolean'
        ]);

        // Nếu đánh dấu là mặc định, bỏ mặc định của các address khác
        if ($request->is_default) {
            Auth::user()->shippingAddresses()->where('id', '!=', $shippingAddress->id)->update(['is_default' => false]);
        }

        $shippingAddress->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_default' => $request->is_default ?? $shippingAddress->is_default
        ]);

        return redirect('/account')->with('success', 'Đã cập nhật địa chỉ thành công!');
    }

    public function destroy(ShippingAddress $shippingAddress)
    {
        // Kiểm tra quyền sở hữu
        if ($shippingAddress->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa địa chỉ này.');
        }

        // Không cho phép xóa nếu chỉ còn 1 địa chỉ
        $addressCount = Auth::user()->shippingAddresses()->count();
        if ($addressCount <= 1) {
            return redirect('/account')->with('error', 'Không thể xóa địa chỉ cuối cùng.');
        }

        $wasDefault = $shippingAddress->is_default;
        
        $shippingAddress->delete();

        // Nếu xóa address mặc định, chọn một address khác làm mặc định
        if ($wasDefault) {
            $newDefault = Auth::user()->shippingAddresses()->first();
            if ($newDefault) {
                $newDefault->update(['is_default' => true]);
            }
        }

        return redirect('/account')->with('success', 'Đã xóa địa chỉ thành công!');
    }

    public function setDefault(ShippingAddress $shippingAddress)
    {
        // Kiểm tra quyền sở hữu
        if ($shippingAddress->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền thay đổi địa chỉ mặc định.');
        }

        // Bỏ mặc định của tất cả address
        Auth::user()->shippingAddresses()->update(['is_default' => false]);
        
        // Đặt address này làm mặc định
        $shippingAddress->update(['is_default' => true]);

        return redirect('/account')->with('success', 'Đã đặt địa chỉ mặc định thành công!');
    }
}