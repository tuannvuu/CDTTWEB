<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use App\Models\Category;

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
        // ✅ Ép Laravel sử dụng HTTPS khi ở production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Share biến $categories cho tất cả view với caching
        View::composer('*', function ($view) {
            $categories = Cache::remember('categories', 3600, function () { // Cache 1 giờ
                return Category::orderBy('catename', 'asc')->get();
            });

            $view->with('categories', $categories);
        });
    }
}