<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function login(Request $request)
    {
        // Validate dữ liệu nhập
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Thử đăng nhập
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Nếu là admin
            if ((int) $user->role === 1) {
                return redirect()
                    ->route('ad.dashboard')
                    ->with('success', 'Chào mừng Admin!');
            }

            // Nếu là user thường
            return redirect()
                ->route('homepage')
                ->with('success', 'Đăng nhập thành công!');
        }

        // Nếu sai thông tin
        return back()
            ->withErrors(['email' => 'Thông tin đăng nhập không đúng.'])
            ->withInput();
    }

    /**
     * Đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất.');
    }
}
