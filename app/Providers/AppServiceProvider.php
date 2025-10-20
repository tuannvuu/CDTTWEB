<?php

namespace App\Providers;

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
        // Share biến $categories cho tất cả view với caching
        View::composer('*', function ($view) {
            $categories = Cache::remember('categories', 3600, function () { // Cache 1 giờ
                return Category::orderBy('catename', 'asc')->get();
            });

            $view->with('categories', $categories);
        });
    }
}