<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu user đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('ad.login')->with('error', 'Vui lòng đăng nhập.');
        }

        // Kiểm tra nếu user có role = 1 (admin)
        // User ID 19 đang có role khác 1 nên bị từ chối
        if (Auth::user()->role != 1) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang admin.');
        }

        return $next($request);
    }
}