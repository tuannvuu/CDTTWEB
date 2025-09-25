<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        // Share biến $categories cho tất cả view
        View::composer('*', function ($view) {
            $view->with('categories', Category::orderBy('catename', 'asc')->get());
        });
    }
}
