<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        // Hiển thị danh sách người dùng
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Hiển thị form tạo user mới (admin)
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'fullname' => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|integer',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->role     = $request->role;
        $user->save();

        // Nếu là admin tạo user thì quay về danh sách
        return redirect()->route('ad.users.index')
            ->with('success', 'Tạo người dùng thành công.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'fullname' => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email    = $request->email;
        $user->role     = $request->role;

        if ($request->password) {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('ad.users.index')
            ->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('ad.users.index')
            ->with('success', 'Xóa người dùng thành công.');
    }

    // ---------------------- LOGIN / LOGOUT ----------------------

    public function login()
    {
        return view('admin.users.login');
    }

    public function loginpost(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ], [
            'email'    => 'Email',
            'password' => 'Mật khẩu',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('ad.login')
                ->with('message', 'Email không tồn tại')
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('ad.login')
                ->with('message', 'Mật khẩu không đúng')
                ->withInput();
        }

        $remember = $request->boolean('remember');
        Auth::login($user, $remember);

        // Phân quyền
        if ((int) $user->role === 1) {
            return redirect()->intended(route('ad.dashboard'));
        }

        return redirect()->route('user.profile');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user && $user->role == 1) {
            return redirect()->route('ad.login')
                ->with('message', 'Đăng xuất thành công');
        }

        return redirect()->route('homepage')
            ->with('message', 'Đăng xuất thành công');
    }

    // ---------------------- ĐỔI MẬT KHẨU ----------------------

    public function changepass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }

    public function showChangePassForm()
    {
        return view('admin.users.changepass');
    }

    // ---------------------- QUÊN MẬT KHẨU ----------------------

    public function forgotpassform()
    {
        return view('admin.users.forgotpassform');
    }

    public function forgotpass(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('ad.forgotpass')
                ->with('message', 'Email không tồn tại trong hệ thống.')
                ->withInput();
        }

        $passrandom = Str::random(10);
        $passencrypte = Hash::make($passrandom);
        $user->update(['password' => $passencrypte]);

        $html = "<h2>Mật khẩu mới của bạn là: $passrandom. 
                 Vui lòng đổi mật khẩu sau khi đăng nhập.</h2>";

        Mail::html($html, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Đặt lại mật khẩu');
        });

        return redirect()->route('ad.forgotpass')
            ->with('message', 'Mật khẩu mới đã được gửi đến email của bạn.');
    }

    // ---------------------- PROFILE ----------------------

    public function profile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ((int) $user->role === 1) {
            return redirect()->route('ad.dashboard');
        }

        // load quan hệ nếu user tồn tại
        $user->load('orders.items');

        return view('client.users.profile', compact('user'));
    }
}
