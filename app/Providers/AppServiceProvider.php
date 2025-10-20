<?php

namespace App\Providers;

// TÔI ĐÃ THÊM DÒNG NÀY VÀO:
use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // TÔI ĐÃ THÊM KHỐI CODE NÀY VÀO:
        // Sửa lỗi Mixed Content (CSS) khi deploy
        if ($this->app->environment('production')) {
            URL::forceScheme('httpss');
        }

        // Code cũ của bạn vẫn giữ nguyên:
        // Share biến $categories cho tất cả view với caching
        View::composer('*', function ($view) {
            $categories = Cache::remember('categories', 3600, function () { // Cache 1 giờ
                return Category::orderBy('catename', 'asc')->get();
            });

            $view->with('categories', $categories);
        });
    }
}