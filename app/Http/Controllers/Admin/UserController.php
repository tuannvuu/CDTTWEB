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
        if (auth()->user()->role != 1) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang admin.');
        }
        // Hiển thị danh sách người dùng
        $users = User::paginate(10);
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
        // ... validation ...

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('ad.login')
                ->with('error', 'Email không tồn tại') // ✅ SỬA THÀNH 'error'
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('ad.login')
                ->with('error', 'Mật khẩu không đúng') // ✅ SỬA THÀNH 'error'
                ->withInput(['email']); // Giữ lại email, bỏ password
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
                ->with('message', 'Log out successfully');
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
            return back()->with('error',  'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
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
                ->with('message', 'Email does not exist in the system.')
                ->withInput();
        }

        $passrandom = Str::random(10);
        $passencrypte = Hash::make($passrandom);
        $user->update(['password' => $passencrypte]);

        $html = "<h2>Your new password is: $passrandom. 
                Please change your password after logging in..</h2>";

        Mail::html($html, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password');
        });

        return redirect()->route('ad.forgotpass')
            ->with('message', 'A new password has been sent to your email.');
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